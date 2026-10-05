<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AirportSeeder extends Seeder
{
    public function run()
    {
        DB::table('airports')->delete();

        $path = database_path('seeders/csv/nacional/airports.csv');
        $file = fopen($path, 'r');

        $headers = fgetcsv($file);

        while (($row = fgetcsv($file)) !== false) {
            // Trim whitespace
            $row = array_map('trim', $row);

            if (count($headers) !== count($row)) {
                Log::warning('Skipping malformed CSV row', [
                    'expected' => count($headers),
                    'got'      => count($row),
                    'row'      => $row,
                ]);
                continue;
            }

            $data = array_combine($headers, $row);

            DB::table('airports')->insert([
                'id'         => $data['id'],
                'name'       => $data['name'],
                'iata'       => $data['iata'],
                'icao'       => $data['icao'],
                'city'       => $data['city'],
                'state'      => $data['state'],
                'county'     => $data['county'],
                'country'    => $data['country'],
                'city_code'  => $data['city_code'],
                'latitude'   => $data['latitude'],
                'longitude'  => $data['longitude'],
                'elevation'  => $data['elevation'],
                'time_zone'  => $data['time_zone'],
                'url'        => $data['url'],
                'type'       => $data['type'],
                'city_id' => !empty($data['city_id']) ? (int)$data['city_id'] : null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        fclose($file);
    }
}