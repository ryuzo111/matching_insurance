<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InterestedInsurance extends Model
{
    public function post()
    {
        return $this->hasOne('App\Models\Post');
    }
}
