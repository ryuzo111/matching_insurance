<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InterestedInsurance extends Model
{
    protected $guarded = ['id'];
    use SoftDeletes;

    public function post()
    {
        return $this->hasOne('App\Models\Post');
    }

    public function getInterestedInsuranceByPostId($id)
    {
        $interested_insurance = $this->where('post_id', $id)->firstOrFail();
        return $interested_insurance;
        
    }
}
