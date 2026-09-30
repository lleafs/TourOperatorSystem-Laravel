<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AirportSeeder extends Seeder
{
    public function run()
    {
        $path = database_path('seeders/csv/airports.csv');
        $file = fopen($path, 'r');

        // Read header row
        $headers = fgetcsv($file);

        while (($row = fgetcsv($file)) !== false) {
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
                'created_at' => $data['created_at'],
                'updated_at' => $data['updated_at'],
            ]);
        }

        fclose($file);
    }
}
