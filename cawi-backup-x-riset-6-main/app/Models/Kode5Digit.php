<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kode5Digit extends Model
{
    //
    protected $table = 'kode5_digit';

    public function kode4digit()
    {
        return $this->belongsTo(Kode4Digit::class, 'kode_4_digit_id', 'id');
    }
}
