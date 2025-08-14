<?php

namespace Database\Seeders;

use App\Models\Kode4Digit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Kode4DigitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $csvFile = fopen(base_path("database/seeders/data/KodeKBLI4Digit.csv"), "r");

        $firstLine = true;
        while (($data = fgetcsv($csvFile, 1000, ",")) !== false) {
            if (!$firstLine) {
                Kode4Digit::create([
                    "id" => $data[0],
                    "kode_3_digit_id" => $data[1],
                    'kode_4_digit' => $data[2],
                    "judul" => $data[3],
                    "deskripsi" => $data[4],
                ]);
            }
            $firstLine = false;
        }

        fclose($csvFile);
    }
}
