<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Airline;

class FetchAirline extends Command
{
    protected $signature = 'airline:fetch {icao} {iata?}';
    protected $description = 'Fetch airline data from RapidAPI and seed into DB with CSV fallback';

    public function handle()
    {
        $icao = $this->argument('icao');
        $iata = $this->argument('iata') ?? null;

        $this->info("Fetching airline data for ICAO: {$icao}");
        $response = Http::withHeaders([
            'x-rapidapi-host' => 'airlines-by-api-ninjas.p.rapidapi.com',
            'x-rapidapi-key' => env('RAPIDAPI_KEY'),
        ])->get('https://airlines-by-api-ninjas.p.rapidapi.com/v1/airlines', [
            'icao' => $icao,
            'iata' => $iata,
        ]);

        $apiData = $response->json();
        $meta = $apiData[0] ?? [];
        $fleet = [];

        foreach ($apiData as $record) {
            if (!empty($record['fleet'])) {
                $fleet = $record['fleet'];
                break;
            }
        }

        // Define $file early so it's always available
        $file = database_path("seeders/csv/airlines.csv");

        if (!empty($meta)) {
            // --- DB update ---
            Airline::updateOrCreate(
                ['icao' => $meta['icao']],
                [
                    'name'          => $meta['name'] ?? null,
                    'iata'          => $meta['iata'] ?? null,
                    'icao'          => $meta['icao'] ?? null,
                    'country'       => $meta['country'] ?? null,
                    'year_created'  => $meta['year_created'] ?? null,
                    'base'          => $meta['base'] ?? null,
                    'fleet'         => json_encode($fleet),
                    'logo_url'      => $meta['logo_url'] ?? null,
                    'brandmark_url' => $meta['brandmark_url'] ?? null,
                    'tail_logo_url' => $meta['tail_logo_url'] ?? null,
                ]
            );

            // --- CSV setup ---
            if (!is_dir(dirname($file))) {
                mkdir(dirname($file), 0755, true);
            }
            if (!file_exists($file)) {
                $handle = fopen($file, 'w');
                fputcsv($handle, [
                    'id',
                    'name',
                    'iata',
                    'icao',
                    'country',
                    'year_created',
                    'base',
                    'fleet',
                    'logo_url',
                    'brandmark_url',
                    'tail_logo_url'
                ]);
                fclose($handle);
            }

            // --- Next ID ---
            $nextId = 1;
            if (($handle = fopen($file, 'r')) !== false) {
                $lastRow = null;
                while (($row = fgetcsv($handle)) !== false) {
                    $lastRow = $row;
                }
                fclose($handle);
                if ($lastRow && is_numeric($lastRow[0])) {
                    $nextId = (int)$lastRow[0] + 1;
                }
            }

            // --- Duplicate check ---
            $exists = false;
            if (($handle = fopen($file, 'r')) !== false) {
                while (($row = fgetcsv($handle)) !== false) {
                    if (isset($row[3]) && $row[3] === $meta['icao']) {
                        $exists = true;
                        break;
                    }
                }
                fclose($handle);
            }

            // --- Append if not duplicate ---
            if (!$exists) {
                $handle = fopen($file, 'a');
                fputcsv($handle, [
                    $nextId,
                    $meta['name'] ?? null,
                    $meta['iata'] ?? null,
                    $meta['icao'] ?? null,
                    $meta['country'] ?? null,
                    $meta['year_created'] ?? null,
                    $meta['base'] ?? null,
                    json_encode($fleet),
                    $meta['logo_url'] ?? null,
                    $meta['brandmark_url'] ?? null,
                    $meta['tail_logo_url'] ?? null,
                ]);
                fclose($handle);

                $this->info("Airline {$icao} saved to DB and appended to CSV with ID {$nextId}.");
            } else {
                $this->info("Airline {$icao} already exists in CSV, skipping append.");
            }
        } else {
            // <-- close curly bracket for if (!empty($meta)) is here
            $this->error("No data found for ICAO {$icao}");
        }
    }
}
