<?php

namespace App\Models;

use App\Models\Product_With_Color;
use Illuminate\Database\Eloquent\Model;

class Product_Color extends Model
{
    protected $fillable = [
        'color', 'hex_code'
    ];

    public function product_with_color(){
        return $this->hasMany(Product_With_Color::class);
    }
}
