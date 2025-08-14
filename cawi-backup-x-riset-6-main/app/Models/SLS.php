<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SLS extends Model
{
    protected $table = 'sls';
    public function pcl()
    {
        return $this->hasOne(User::class)->whereHas('roles', function ($query) {
            $query->where('name', 'pcl');
        });
    }

    public function kortim()
    {
        return $this->hasOne(User::class)->whereHas('roles', function ($query) {
            $query->where('name', 'kortim');
        });
    }
}
