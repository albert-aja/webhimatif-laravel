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

    public function sort_byView(){
        return $this->orderBy('viewed', 'DESC');
    }

    public function selectNewest(){
        return $this->selectMax('created_at')
                    ->first();
    }
    
    // public function getDataByTags($id){
    //     return $this->where('FIND_IN_SET('.$id.', tag)');
    // }
    
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

    public function getCountLast12Months($from){
        return $this->select('created_at')
                    ->selectCount('created_at', 'total')
                    ->getLast12Months($from)
                    ->groupBy('DATE_FORMAT(created_at, "%Y%m")')
                    ->findAll();
    }
}
