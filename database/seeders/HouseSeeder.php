<?php

namespace Database\Seeders;

use App\Models\House;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class HouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (($dump_csv = fopen(database_path() . '/dump/csv/property-data.csv', 'r')) !== FALSE) {
            $skip_first = true;
            while (($row = fgetcsv($dump_csv, 0, ',')) !== FALSE) {
                if ( $skip_first ) { $skip_first = false; continue; }
                DB::table('houses')->insert([
                    'name' => $row[0],
                    'price' => (double)$row[1],
                    'bedroom' => (int)$row[2],
                    'bathroom' => (int)$row[3],
                    'storey' => (int)$row[4],
                    'garage' => (int)$row[5],
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);
            }
        }
    }
}
