<?php

namespace Database\Seeders;

use App\Models\Kode5Digit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Kode5DigitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $csvFile = fopen(base_path("database/seeders/data/KodeKBLI5Digit.csv"), "r");

        $firstLine = true;
        while (($data = fgetcsv($csvFile, 1000, ",")) !== false) {
            if (!$firstLine) {
                Kode5Digit::create([
                    "id" => $data[0],
                    "kode_4_digit_id" => $data[1],
                    'kode_5_digit' => $data[2],
                    "judul" => $data[3],
                    "deskripsi" => $data[4],
                ]);
            }
            $firstLine = false;
        }
        fclose($csvFile);
    }
}
