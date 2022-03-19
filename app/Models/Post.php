<?php

namespace App\Models;

use App\Models\Division;
use App\Models\Main_Model;

class Post extends Main_Model
{
    protected $fillable = [
        'title', 'slug', 'hero_image', 'article',
        'division_id', 'viewed'
    ];

    //relations
    public function division(){
        return $this->belongsTo(Division::class);
    }

    //functions
    public function get12monthsBack($latest){
        return $this::where('created_at', '<=', $latest)
                    ->whereRaw('created_at >= DATE_SUB("' .$latest. '", INTERVAL 1 YEAR)');
    }

    public function getCount12monthsBack($latest){
        return $this->get12monthsBack($latest)
                    ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as date')
                    ->selectRaw('count(created_at) as total')
                    ->groupBy('date')
                    ->get();
    }
}
