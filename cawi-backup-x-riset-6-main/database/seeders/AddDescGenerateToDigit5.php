<?php

namespace Database\Seeders;

use App\Models\Kode5Digit;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class AddDescGenerateToDigit5 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = fopen(base_path("database/seeders/data/kode5digitfixni.csv"), "r");

        $firstLine = true;
        while (($data = fgetcsv($csvFile, 1000, ";")) !== false) {
            if (!$firstLine) {
                Log::info('Row data: ' . json_encode($data));
                if (count($data) > 6) {
                    Kode5Digit::updateOrCreate(
                        ['id' => $data[0]],
                        ['description_generate' => $data[6]]
                    );
                } else {
                    Log::warning('Skipping row due to insufficient columns: ' . json_encode($data));
                }
            }
            $firstLine = false;
        }


        fclose($csvFile);
    }
}
