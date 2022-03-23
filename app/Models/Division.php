<?php

namespace App\Models;

use App\Models\Post;
use App\Models\Commitee;
use App\Models\Main_Model;
use App\Models\Work_Program;

class Division extends Main_Model
{
    protected $fillable = [
        'division', 'slug', 'alias'
    ];

    //relations
    public function commitee(){
        return $this->hasMany(Commitee::class);
    }

    public function post(){
        return $this->hasMany(Post::class);
    }

    public function work_program(){
        return $this->hasMany(Work_Program::class);
    }
}
