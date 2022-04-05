<?php

namespace App\Models;

use App\Models\Commitee;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = ['position'];

    //relations
    public function commitee(){
        return $this->hasMany(Commitee::class);
    }
}
