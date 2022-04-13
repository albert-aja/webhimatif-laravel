<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;

class Article_Image extends Model
{
    protected $fillable = [
        'posts_id', 'photo'
    ];

    public function shop_item(){
        return $this->belongsTo(Post::class, 'posts_id', 'id');
    }
}
