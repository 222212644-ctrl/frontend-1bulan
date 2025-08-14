<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riset4q2 extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'provinsi',
        'kabupaten_kota',
        'kecamatan',
        'klasifikasi_wilayah',
        'nomor_blok_sensus',
        'kode_sls',
        'nama_sls',
        'pcl_nama',
        'pcl_nim',
        'pcl_jenis_kelamin',
        'kortim_nama',
        'kortim_nim',
        'kortim_jenis_kelamin',
        'kd_peta',
        'kd_daftar_sls',
        'kd_daftar_sampel_sls',
        'kd_bukped_listing',
        'kd_surat_tugas',
        'kd_surat_izin',
        'kelengkapan_instrumen',
        'salam_pembuka',
        'kesediaan_responden',
        'perkenalan',
        'tujuan_wawancara',
        'surat_tugas',
        'jaminan_kerahasiaan',
        'kondisi_lingkungan',
        'probing',
        'konfirmasi_ulang',
        'pemahaman_konsep_dan_definisi',
        'leading',
        'pertanyaan_interogatif',
        'pengulangan_pertanyaan',
        'metode_bertanya',
        'pengisian_kuesioner',
        'kewajaran',
        'pemberitahuan_revisit',
        'penutup_wawancara',
        'waktu',
    ];

    protected function setMetodeBertanyaAttribute($value)
    {
        $this->attributes['metode_bertanya'] = is_array($value) ? implode(', ', $value) : $value;
    }

// Accessor untuk mengubah string kembali menjadi array
    protected function getMetodeBertanyaAttribute($value)
    {
        return explode(', ', $value);
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
}
