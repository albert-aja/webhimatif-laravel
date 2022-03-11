<?php

namespace App\Models;

use App\Models\Product_Price;
use App\Models\Product_Gallery;
use App\Models\Product_Category;
use App\Models\Product_With_Color;

use Illuminate\Database\Eloquent\Model;

class Shop_Item extends Model
{
    protected $fillable = [
        'item', 'slug', 'photos', 'description',
        'product__categories_id', 'product_color',
        'price'
    ];

    //relations
    public function product_category(){
        return $this->belongsTo(Product_Category::class, 'product__categories_id', 'id');
    }

    public function product_with_color(){
        return $this->hasMany(Product_With_Color::class, 'shop__items_id', 'id');
    }

    public function product_gallery(){
        return $this->hasMany(Product_Gallery::class, 'shop__items_id', 'id');
    }

    public function product_price(){
        return $this->hasMany(Product_Price::class, 'shop__items_id', 'id');
    }
}
