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
        return $this->hasOne(Division::class);
    }

    public function fetchData($limit, $offset = ''){
        return $this->sort_byDate()
                    ->findAll($limit, $offset);
    }

    // public function getRelated($tag, $id, $limit){
    //     return $this->sort_byView()
    //                 ->where('tag', $tag)
    //                 ->whereNotIn('id', [$id])
    //                 ->findAll($limit);
    // }

    public function leastViewer(){
        return $this->orderBy('viewed', 'ASC');
    }

    public function getLast12Months($from){
        return $this->where('created_at >', '"' .$from. '" - INTERVAL 11 MONTH');
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
