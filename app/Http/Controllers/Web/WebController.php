<?php

namespace App\Http\Controllers\Web;

use App\Models\Post;
use App\Models\Vision;
use App\Models\History;
use App\Models\Mission;
use App\Models\Service;
use App\Models\Division;
use App\Models\Shop_Item;
use App\Helpers\Breadcrumbs;
use App\Models\Social_Media;
use App\Models\Management_Year;
use App\Models\Product_Category;

use App\Http\Controllers\Controller;
use App\ViewModels\ArticleViewModel;
use App\ViewModels\WebHomeViewModel;
use App\ViewModels\WebDivisiViewModel;
use App\ViewModels\HimatifShopViewModel;

/**
 * User Page Controller
 */
class WebController extends Controller
{
	public function __construct(){
        $this->data = [
            'socials'	=> Social_Media::all(),
            'services' 	=> Service::all(),
			'divisions'	=> Division::all(),
			'history'	=> History::first(),
		];
	}

	// home page
	public function index(){
		$viewModel = new WebHomeViewModel(
            Mission::get(),
			Product_Category::all(),
			Post::orderBy('created_at', 'DESC')->take(config('web.POST_MAX'))->get(),
			$this->data['divisions']
        );

		$this->data['title'] 		= 'Home';
		$this->data['vision'] 		= Vision::first();
		$this->data['missions'] 	= $viewModel->missions();
		$this->data['category1'] 	= $viewModel->category1()[0];
		$this->data['category2'] 	= $viewModel->category2();
		$this->data['posts'] 		= $viewModel->posts();
		$this->data['divisions'] 	= $viewModel->divisions();
		$this->data['videos'] 		= $viewModel->youtube();

		return view('v_web.index', $this->data);
	}

	// division page
	public function divisi(Division $division){
		$this->data['division'] = Division::where('slug', $division['slug'])
											->with(['commitee', 'work_program', 'commitee.position'])
											->first();

		$viewModel = new WebDivisiViewModel(
			$this->data['division'],
			$this->data['division']->commitee,
			$this->data['division']->work_program,
			Management_Year::first(),
		);

		$breadcrumbs = new Breadcrumbs;

		$this->data['breadcrumbs']	= $breadcrumbs->userCrumb(true);
		$this->data['title'] 		= $viewModel->title();
		$this->data['commitees'] 	= $viewModel->commitees();
		$this->data['programs'] 	= $viewModel->programs();
		
		return view('v_web.divisi', $this->data);
	}

	// shop page
	public function Himatif_Shop(){
		$viewModel = new HimatifShopViewModel(
			Shop_Item::with(['product_category', 'product_price', 'product_gallery'])->get(),
		);

		$category 		= new Product_Category;
		$breadcrumbs 	= new Breadcrumbs;

		$this->data['breadcrumbs']	= $breadcrumbs->userCrumb();
		$this->data['title'] 		= 'Himatif Shop';
		$this->data['categories'] 	= $category->count_category();
		$this->data['items'] 		= $viewModel->shop_items()->shuffle();

		return view('v_web.shop', $this->data);
	}

	//news page
	public function berita(){	
		$breadcrumbs 	= new Breadcrumbs;

		$this->data['title'] 		='Himatif News';
		$this->data['breadcrumbs']	= $breadcrumbs->userCrumb();

		return view('v_web.news', $this->data);
	}

	// article page
	public function article(Post $post){
		$this->article = Post::where('slug', $post['slug'])->first();

		// ensure the data that appears in the latest news section is not the current news
		$latest = Post::latest()->whereNot(function ($query) {
												$query->where('id', $this->article['id']);
											})->take(config('web.POST_MAX'))->get();

		$viewModel = new ArticleViewModel(
			$this->article,
			$latest
		);

		$this->data['title'] 	= $this->article['title'];
		$this->data['post'] 	= $viewModel->article();
		$this->data['latest'] 	= $viewModel->latest();

		// add viewer number
		$this->article->update([
			'viewed' => $viewModel->viewers()
		]);

		return view('v_web.article', $this->data);
	}
}
