<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_Price extends Model
{
    protected $fillable = [
        'shop__items_id', 'price'
    ];

    public function shop_item(){
        return $this->belongsTo(Shop_Item::class, 'shop__items_id', 'id');
    }
}
