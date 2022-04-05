<?php

namespace App\Models;

use App\Models\Shop_Item;
use App\Models\Product_Color;

use Illuminate\Database\Eloquent\Model;

class Product_With_Color extends Model
{
    protected $fillable = ['shop__items_id', 'product__colors_id'];

    public function shop_item(){
        return $this->belongsTo(Shop_Item::class, 'shop__items_id', 'id');
    }

    public function product_color(){
        return $this->belongsTo(Product_Color::class, 'product__colors_id', 'id');
    }
}
