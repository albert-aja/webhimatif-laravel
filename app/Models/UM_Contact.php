<?php

namespace App\Models;

use App\Models\Main_Model;

class UM_Contact extends Main_Model
{    
    protected $fillable = [
        'social', 'link', 'icon', 'color'
    ];

    public function getExistedContact(){
        return $this->select('icon')
                    ->get();
    }
}
