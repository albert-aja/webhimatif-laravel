<?php

namespace App\Models;

use App\Models\Shop_Item;
use Illuminate\Database\Eloquent\Model;

class Product_Category extends Model
{
    protected $fillable = [
        'category', 'slug', 'photo'
    ];

    //relations
    public function shop_item(){
        return $this->hasMany(Shop_Item::class);
    }

    //function
    public function count_category(){
        return $this->select('product__categories.category', 'product__categories.slug')
                    ->selectRaw('count(shop__items.product__categories_id) as total_count')
                    ->join('shop__items', 'shop__items.product__categories_id', 'product__categories.id')
                    ->groupBy('product__categories.category')
                    ->orderBy('product__categories.id', 'ASC')
                    ->get();
    }
}