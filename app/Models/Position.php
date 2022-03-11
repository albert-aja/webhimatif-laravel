<?php

namespace App\Models;

use App\Models\Commitee;
use App\Models\Main_Model;

class Position extends Main_Model
{
    protected $fillable = ['position'];

    //relations
    public function commitee(){
        return $this->hasMany(Commitee::class);
    }
}
