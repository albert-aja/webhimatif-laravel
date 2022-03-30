<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shop_Item;
use App\Models\Product_Gallery;

use Illuminate\Http\Request;

class ProductGalleryController extends AdminController
{
	public function rearrangeModal(Request $request){
		$this->data['item'] = Shop_Item::with(['product_category', 'product_gallery'])->where('id', $request->id)->first();
        $this->data['img_path'] = 'img/shop/' .$this->data['item']->product_category->slug. '/' .$this->data['item']->slug;

		return view('v_admin.shop.item.rearrange_modal', $this->data);
	}

	public function updateOrder(Request $request){
        $this->order = 1;

		foreach(explode(',', $request->photo) as $photo_id){
            Product_Gallery::where('id', $photo_id)
                            ->update(['photo_order' => $this->order]);

            $this->order++;
        }
	}
}
