<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riset4q1 extends Model
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
        'kd_kuesioner_listing',
        'kd_bukped_listing',
        'kd_surat_tugas',
        'kd_surat_izin',
        'kelengkapan_instrumen',
        'koordinasi_ketua_sls',
        'proses_penelusuran_wilayah',
        'cakupan_listing',
        'geotagging',
    ];
}
