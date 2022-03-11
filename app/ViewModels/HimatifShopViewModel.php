<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use App\Helpers\General;

class HimatifShopViewModel extends ViewModel
{
    public $items;

    public function __construct($items){
        $this->items = $items;
    }

    public function shop_items(){
        $delay = 150;

        for($i=0;$i<count($this->items);$i++){
            $this->items[$i]['delay'] = $delay;

            $delay = ($delay >= 450) ? 150 : $delay += 150;
        }

        return collect($this->items)->map(function($item){
            $category_slug = $item->product_category['slug'];
            $img_loc = 'img/shop/' .$category_slug. '/' .$item['slug'];
            $img = $item->product_gallery->first()['photo'];

            $final_price = [];

            foreach($item->product_price as $price){
                array_push($final_price, General::convert_money($price['price']));
            }

            return collect($item)->merge([
                'category_slug' => $category_slug,
                'image-l'       => $img_loc. '/' .$img. '/3x_' .$img,
                'image-m'       => $img_loc. '/' .$img. '/2x_' .$img,
                'price'         => implode(' ~ ', $final_price),
            ]);
        });
    }
}
