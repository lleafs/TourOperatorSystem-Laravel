<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Airport;

class FetchAirport extends Command
{
    // Usage: php artisan airport:fetch LHR
    protected $signature = 'airport:fetch {iata}';
    protected $description = 'Fetch airport data from RapidAPI using IATA code and seed into DB with CSV fallback';

    public function handle()
    {
        $iata = strtoupper($this->argument('iata'));
        $this->info("Fetching airport data for IATA: {$iata}");

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://iata-airports.p.rapidapi.com/airports/{$iata}/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTPHEADER => [
                "accept: application/json",
                "x-rapidapi-host: iata-airports.p.rapidapi.com",
                "x-rapidapi-key: " . env('RAPIDAPI_KEY'),
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            $this->error("cURL Error: {$err}");
            return;
        }

        $meta = json_decode($response, true);

        if (empty($meta)) {
            $this->error("Empty response for IATA {$iata}: " . $response);
            return;
        }

        // Use 'code' as the IATA identifier
        $identifier = $meta['iata'] ?? $meta['code'] ?? null;
        if (!$identifier) {
            $this->error("No IATA/code key found in response: " . json_encode($meta));
            return;
        }
        $file = database_path("seeders/csv/airports.csv");
        // Ensure directory exists
        if (!is_dir(dirname($file))) {
            mkdir(dirname($file), 0755, true);
        }

        // If file is missing OR empty, write header
        if (!file_exists($file) || filesize($file) === 0) {
            $handle = fopen($file, 'w');
            fputcsv($handle, [
                'id',
                'name',
                'code',
                'icao',
                'city',
                'state',
                'county',
                'country',
                'city_code',
                'latitude',
                'longitude',
                'elevation',
                'time_zone',
                'url',
                'type'
            ]);
            fclose($handle);
        }
        // ✅ Collect existing codes and last ID
        $existingCodes = [];
        $lastId = 0;
        if (($handle = fopen($file, 'r')) !== false) {
            while (($row = fgetcsv($handle)) !== false) {
                // Skip header row
                if ($row[0] === 'id') continue;
                if (!isset($row[1])) continue;

                $lastId = max($lastId, (int)$row[0]);
                $existingCodes[] = $row[1]; // column 1 = IATA code
            }
            fclose($handle);
        }

        // ✅ Skip duplicates
        if (in_array($identifier, $existingCodes)) {
            $this->warn("⚠️ Airport {$identifier} already exists in airports.csv. Skipping append.");
            return;
        }

        // ✅ Next ID
        $newId = $lastId + 1;
        $handle = fopen($file, 'a');
        fputcsv($handle, [
            $newId,
            $meta['name'] ?? null,
            $identifier,
            $meta['icao'] ?? null,
            $meta['city'] ?? null,
            $meta['state'] ?? null,
            $meta['county'] ?? null,
            $meta['country'] ?? null,
            $meta['city_code'] ?? null,
            $meta['latitude'] ?? null,
            $meta['longitude'] ?? null,
            $meta['elevation'] ?? null,
            $meta['time_zone'] ?? null,
            $meta['url'] ?? null,
            $meta['type'] ?? null,
        ]);
        fclose($handle);

        $this->info("✅ Airport {$identifier} appended to airports.csv.");
    }
}
