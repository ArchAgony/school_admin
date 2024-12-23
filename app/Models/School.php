<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    //
    protected $fillable = [
        'name',
        'city_id'
    ];

    public function cities(){
        return $this->belongsTo(City::class,'city_id');
    }
}
