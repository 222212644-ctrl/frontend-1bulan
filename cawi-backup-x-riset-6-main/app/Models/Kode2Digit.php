<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kode2Digit extends Model
{
    //
    protected $table = 'kode2_digit';

    public function sektor()
    {
        return $this->belongsTo(Sektor::class, 'kode_sektor_id', 'id');
    }

    public function kode3digit()
    {
        return $this->hasMany(Kode3Digit::class, 'kode_2_digit_id', 'id');
    }
}
