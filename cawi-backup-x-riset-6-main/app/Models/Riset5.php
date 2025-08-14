<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Riset5 extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'jenis_kelamin',
        'kelas',
        'pengalaman_capi/papi',
        'informasi_relevan',
        'informasi_up_to_date',
        'progress_pencacahan',
        'output_tidak_ambigu',
        'fitur_mendukung',
        'mudah_digunakan',
        'respon_cepat',
        'pengisian_mudah',
        'help_desk',
        'petunjuk_jelas',
        'kenyamanan',
        'isi_lengkap',
        'informasi_benar',
        'informasi_presisi',
        'mudah_dipahami',
        'desain_menarik',
        'tata_letak_baik',
        'menu_teratur',
        'puas_data',
        'puas_efektivitas',
        'puas_efisiensi',
        'puas_umum',
        'kinerja_lebih_baik',
        'lebih_mudah',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
}
