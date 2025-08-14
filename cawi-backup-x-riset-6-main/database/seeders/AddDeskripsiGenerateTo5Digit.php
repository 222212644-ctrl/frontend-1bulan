<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kode5Digit;

class AddDeskripsiGenerateTo5Digit extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = fopen(base_path("database/seeders/data/deskripsi.csv"), "r");

        $firstLine = true;
        while (($data = fgetcsv($csvFile, 0, ";")) !== false) {
            if (!$firstLine) {
                // Validasi apakah kolom data sesuai
                if (!isset($data[0]) || !isset($data[1])) {
                    // Tampilkan data yang tidak valid dan hentikan eksekusi
                    dd("Baris tidak valid: ", $data);
                }

                // Lanjutkan jika data valid
                Kode5Digit::updateOrCreate(
                    ['id' => $data[0]], // Kriteria untuk menemukan record yang ada
                    ['description_generate' => $data[1]], // Data untuk diupdate atau dibuat
                );
            }
            $firstLine = false;
        }

        fclose($csvFile);
    }
}
