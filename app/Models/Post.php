<?php

namespace App\Models;

use App\Models\Division;
use App\Models\Article_Image;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'slug', 'hero_image', 'article',
        'division_id', 'viewed', 'created_at'
    ];

    //relations
    public function division(){
        return $this->belongsTo(Division::class);
    }

    public function article_image(){
        return $this->hasMany(Article_Image::class, 'posts_id', 'id');
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
