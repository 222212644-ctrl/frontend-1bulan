<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Listing extends Model
{
    //
    protected $fillable = [
        'provinsi',
        'kab_kota',
        'kecamatan',
        'kel_des',
        'nomor_sls',
        'nama_sls',
        'no_sub_sls',
        'no_bangunan_fisik',
        'no_bangunan_sensus',
        'nama_KRT',
        'alamat_bangunan_sensus',
        'jumlah_usaha',
        'is_eligible',
        'is_ekonomi_lingkungan_eligible',
        'is_ekonomi_digital_eligible',
        'is_ekonomi_kreatif_eligible',
        'titik_Lokasi',
        'gambar_rumah',
        'catatan'
    ];

    public function getNamaProvinsiAttribute()
    {
        if (!$this->provinsi) {
            return null;
        }
        return Cache::remember("provinsi_{$this->provinsi}", 3600, function () {
            $response = Http::get("https://melpyyhh.github.io/api-wilayah-indonesia/api/provinces.json");
            if ($response->successful()) {
                $data = $response->json(); // Data API berupa array
                foreach ($data as $item) {
                    if ($item['id'] == $this->provinsi) {
                        return $item['name']; // Ambil nama kabupaten/kota
                    }
                }
                return 'Kode provinsi tidak ditemukan'; // Jika id tidak cocok
            }

            return 'API tidak tersedia'; // Jika respons gagal
        });
    }

    public function getNamaKabupatenAttribute()
    {
        //
        if (!$this->kab_kota) {
            return null;
        }
        return Cache::remember("provinsi_{$this->kab_kota}", 3600, function () {
            $response = Http::get("https://melpyyhh.github.io/api-wilayah-indonesia/api/regencies/{$this->provinsi}.json");
            if ($response->successful()) {
                $data = $response->json(); // Data API berupa array
                foreach ($data as $item) {
                    if ($item['id'] == $this->kab_kota) {
                        return $item['name']; // Ambil nama kabupaten/kota
                    }
                }
                return 'Kode kabupaten tidak ditemukan'; // Jika id tidak cocok
            }

            return 'API tidak tersedia'; // Jika respons gagal
        });
    }

    public function getNamaKecamatanAttribute()
    {
        if (!$this->kecamatan) {
            return null; // Jika kode kecamatan tidak ada
        }

        // Caching berdasarkan kode kecamatan
        return Cache::remember("kecamatan_{$this->kecamatan}", 3600, function () {
            $response = Http::get("https://melpyyhh.github.io/api-wilayah-indonesia/api/districts/{$this->kab_kota}.json");

            if ($response->successful()) {
                $data = $response->json(); // Data API berupa array
                foreach ($data as $item) {
                    if ($item['id'] == $this->kecamatan) {
                        return $item['name']; // Ambil nama kecamatan
                    }
                }
                return 'Kode kecamatan tidak ditemukan'; // Jika id tidak cocok
            }

            return 'API tidak tersedia'; // Jika respons gagal
        });
    }
    public function getNamaKelurahanAttribute()
    {
        if (!$this->kel_des) {
            return null; // Jika kode kecamatan tidak ada
        }

        // Caching berdasarkan kode kecamatan
        return Cache::remember("kelurahan_{$this->kel_des}", 3600, function () {
            $response = Http::get("https://melpyyhh.github.io/api-wilayah-indonesia/api/villages/{$this->kecamatan}.json");

            if ($response->successful()) {
                $data = $response->json(); // Data API berupa array
                foreach ($data as $item) {
                    if ($item['id'] == $this->kel_des) {
                        return $item['name']; // Ambil nama kecamatan
                    }
                }
                return 'Kode kelurahan tidak ditemukan'; // Jika id tidak cocok
            }

            return 'API tidak tersedia'; // Jika respons gagal
        });
    }
}
