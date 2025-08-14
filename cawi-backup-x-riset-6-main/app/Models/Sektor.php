<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sektor extends Model
{
    //
    protected $table = "sektor";

    public function kode2digit()
    {
        return $this->hasMany(Kode2Digit::class, 'kode_sektor_id', 'id');
    }
}
