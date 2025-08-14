<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kode4Digit extends Model
{
    //
    protected $table = 'kode4_digit';

    public function kode3digit()
    {
        return $this->belongsTo(Kode3Digit::class, 'kode_3_digit_id', 'id');
    }

    public function kode5digit()
    {
        return $this->hasMany(Kode5Digit::class, 'kode_4_digit_id', 'id');
    }
}
