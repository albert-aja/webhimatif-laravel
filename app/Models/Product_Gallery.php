<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_Gallery extends Model
{
    protected $fillable = ['shop__items_id', 'photo', 'photo_order'];

    public function shop_item(){
        return $this->belongsTo(Shop_Item::class, 'shop__items_id', 'id');
    }
}
