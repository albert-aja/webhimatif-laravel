<?php

namespace App\ViewModels;

use App\Helpers\General;
use App\Models\Product_Color;
use Spatie\ViewModels\ViewModel;

class ItemModalViewModel extends ViewModel
{
    public $item;
    public $price;
    public $contacts;

    public function __construct($item, $price, $contacts){
        $this->item     = $item;
        $this->price    = $price;
        $this->contacts = $contacts;
    }

    public function shop_item(){
        $img_loc = 'img/shop/' .$this->item->product_category['slug']. '/' .$this->item['slug'];

        $final_price = [];

        foreach($this->item->product_price as $price){
            array_push($final_price, General::convert_money($price['price']));
        }

        return collect($this->item)->merge([
            'price'     => implode(' ~ ', $final_price),
            'photo'     => $this->item_images($this->item->product_gallery, $img_loc),
            'category'  => $this->item->product_category['category']
        ]);
    }

    public function item_images($images, $folder){
        $this->folder = $folder;
        return collect($images)->map(function($image){
            return collect($image)->merge([
                'photo' => $this->folder. '/' .$image['photo']. '/1x_' .$image['photo']
            ]);
        });
    }

    public function um_contacts(){
        return collect($this->contacts)->map(function($contact){
            if(strtolower($contact['social']) === 'whatsapp'){
                $item_name = explode(' ', $this->item['item']);

                for($i=0;$i<count($item_name);$i++){
                    $item_name[$i] = '%20' .$item_name[$i];
                }

                $text = implode('', $item_name);
                $link = $contact['link'].$text;
            }

            return collect($contact)->merge([
                'link' => ($link) ?? $contact['link'],
            ]);
        });
    }
}
