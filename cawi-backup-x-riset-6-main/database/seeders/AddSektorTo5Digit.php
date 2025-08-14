<?php

namespace Database\Seeders;

use App\Models\Kode5Digit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddSektorTo5Digit extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { {
            //
            $csvFile = fopen(base_path("database/seeders/data/kode5digitfixni.csv"), "r");

            $firstLine = true;
            while (($data = fgetcsv($csvFile, 0, ";")) !== false) {
                if (!$firstLine) {
                    Kode5Digit::updateOrCreate(
                        ['id' => $data[0]], // criteria to find existing record
                        ['sektor' => $data[5]], // data to update or create
                    );
                }
                $firstLine = false;
            }

            fclose($csvFile);
        }
    }
}
