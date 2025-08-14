<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kode3Digit extends Model
{
    //
    protected $table = 'kode3_digit';

    public function kode2digit()
    {
        return $this->belongsTo(Kode2Digit::class, 'kode_2_digit_id', 'id');
    }

    public function kode4digit()
    {
        return $this->hasMany(Kode4Digit::class, 'kode_3_digit_id', 'id');
    }
}
