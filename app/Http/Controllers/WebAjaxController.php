<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Shop_Item;
use App\Models\UM_Contact;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ViewModels\LoadPostViewModel;
use App\ViewModels\ItemModalViewModel;
use App\ViewModels\SearchPostViewModel;

class WebAjaxController extends Controller
{
    public function call_modal($id){
		$item = Shop_Item::with(['product_category', 'product_price', 'product_gallery', 'product_with_color', 'product_with_color.product_color'])
						->find($id);

		$viewModel = new ItemModalViewModel(
			$item,
			$item->product_price,
			UM_Contact::all(),
		);

		$this->data['item'] 		= $viewModel->shop_item();
		$this->data['contacts']		= $viewModel->um_contacts();
		$this->data['colors'] 		= $item->product_with_color;

		return view('v_client.ajax.item_modal', $this->data);
	}

	public function load_post(){
		$limit = 9; //jumlah berita per request di news page
		$page  = $limit * $_GET['page'];

		$posts = Post::latest()->skip($page)->take($limit)->get();

		if($posts->count() < 1){
			return view('v_client.ajax.no_data');
		}

		$viewModel = new LoadPostViewModel(
			$posts,
		);

		$this->data['posts'] = $viewModel->posts();

		return view('v_client.ajax.load_post', $this->data);
	}

	public function search_title(){
		$this->data['query'] = trim($_GET['query']);

		$search = Post::where('title', 'LIKE', "%{$this->data['query']}%");
		
		if($search->count() > 0){
			$viewModel = new SearchPostViewModel(
				$search->latest()->get(),
				$this->data['query']
			);

			$this->data['results'] = $viewModel->results();
		} else {
			$this->data['results'] = 0;
		}

		return view('v_client.ajax.search_result', $this->data);
    }
}
