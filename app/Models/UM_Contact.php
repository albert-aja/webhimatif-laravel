<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UM_Contact extends Model
{    
    protected $fillable = [
        'social', 'link', 'icon', 'color'
    ];
}
