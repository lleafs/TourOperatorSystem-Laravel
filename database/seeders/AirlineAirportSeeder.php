<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AirlineAirportSeeder extends Seeder
{
    public function run()
    {
        $path = database_path('seeders/csv/airline_airport.csv');
        $file = fopen($path, 'r');

        // Read header row
        $headers = fgetcsv($file);

        while (($row = fgetcsv($file)) !== false) {
            $data = array_combine($headers, $row);

            DB::table('airline_airport')->insert([
                'id'         => $data['id'],
                'airline_id' => $data['airline_id'],
                'airport_id' => $data['airport_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        fclose($file);
    }
}
