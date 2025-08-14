<?php

namespace Database\Seeders;

use App\Models\Sektor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SektorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = fopen(base_path("database/seeders/data/KodeKBLISektor.csv"), "r");

        $firstLine = true;
        while (($data = fgetcsv($csvFile, 1000, ",")) !== false) {
            if (!$firstLine) {
                Sektor::create([
                    "id" => $data[0],
                    "kode_sektor" => $data[1],
                    "judul" => $data[2],
                    "deskripsi" => $data[3],
                ]);
            }
            $firstLine = false;
        }

        fclose($csvFile);
    }
}
