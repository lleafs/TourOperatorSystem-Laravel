<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AirlineSeeder extends Seeder
{
    public function run()
    {
        $path = database_path('seeders/csv/airlines.csv');
        $file = fopen($path, 'r');

        // Read header row
        $headers = fgetcsv($file);

        while (($row = fgetcsv($file)) !== false) {
            $data = array_combine($headers, $row);

            DB::table('airlines')->insert([
                'id'            => $data['id'],
                'name'          => $data['name'],
                'iata'          => $data['iata'],
                'icao'          => $data['icao'],
                'country'       => $data['country'],
                'year_created'  => $data['year_created'],
                'base'          => $data['base'],
                'fleet'         => $data['fleet'],
                'logo_url'      => $data['logo_url'],
                'brandmark_url' => $data['brandmark_url'],
                'tail_logo_url' => $data['tail_logo_url'],
                'created_at'    => $data['created_at'],
                'updated_at'    => $data['updated_at'],
            ]);
        }

        fclose($file);
    }
}
