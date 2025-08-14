<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function kortim()
    {
        return $this->hasOne(User::class)->whereHas('roles', function ($query) {
            $query->where('name', 'kortim');
        });
    }

    public function pcl()
    {
        return $this->hasMany(User::class)->whereHas('roles', function ($query) {
            $query->where('name', 'pcl');
        });
    }

    public function sls()
    {
        return $this->belongsTo(Sls::class);
    }
}
