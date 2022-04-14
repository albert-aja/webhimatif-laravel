<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Helpers\General;
use App\Models\Commitee;
use App\Models\Division;
use App\Models\Shop_Item;

use App\Http\Controllers\Admin\AdminController;
use App\ViewModels\Admin\Dashboard\LatestNewsViewModel;
use App\ViewModels\Admin\Dashboard\NewsStatChartViewModel;

class DashboardController extends AdminController
{
	public function __construct(){
		parent::__construct();

		$this->m_post = new Post();
	}

	public function index(){
		$this->data['title'] = 'Dashboard';

		$this->data['jumlahDivisi'] 	= Division::count();
		$this->data['jumlahPengurus'] 	= Commitee::count();
		$this->data['jumlahBerita'] 	= Post::count();
		$this->data['jumlahProduk'] 	= Shop_Item::count();

		return view('v_admin.dashboard.dashboard', $this->data);
	}

	public function newsDateRange(){
		$range_data = $this->m_post->get12monthsBack(date('Y-m-d'));

		$this->data['startMonth'] = General::ambilBulanTahun($range_data->first()['created_at']);
		$this->data['endMonth'] = General::ambilBulanTahun(date('Y-m-d'));

		return view('v_admin.dashboard.newsStatChart', $this->data);
	}

	public function newsStatChart(){
		$viewModel = new NewsStatChartViewModel(
			$this->m_post->getCount12monthsBack(date('Y-m-d')),
		);

		return json_encode($viewModel->chart());
	}

	public function latestNews(){
		$viewModel = new LatestNewsViewModel(
			$this->m_post::orderBy('created_at', 'desc')->take(5)->get(),
		);

		$this->data['latestNews'] = $viewModel->latestNews();

		return view('v_admin.dashboard.latestNews', $this->data);
	}


	public function topNews(){
		$this->data['rankedNews'] = 10;
		$this->data['newsData']   = $this->m_post::orderBy('viewed', 'desc')->take($this->data['rankedNews'])->get();

		return view('v_admin.dashboard.topNews', $this->data);
	}

	public function postByDivision(){
		$data = Division::with(['post'])->get();

		return collect($data)->map(function($dt){
            return collect($dt)->merge([
                'post' => (!is_null($dt->post)) ? count($dt->post) : 0,
            ])->only(['alias', 'post']);
        });
	}

	public function postByDivisionChart(){
		return view('v_admin.dashboard.postByDivisionChart');
	}

	public function anggotaHimatif(){
		$this->m_pengurus = new Commitee();
		$anggotaHimatif = $this->m_pengurus->getAnggotaHimatif()->with(['division'])->get();

		foreach($anggotaHimatif as &$ad){
			if($ad['alias'] === 'BPH'){
				$ad['utama'] = $ad['utama'] * 2;
			}
		}

		return json_encode($anggotaHimatif);
	}

	public function anggotaHimatifChart(){
		return view('v_admin.dashboard.anggotaHimatifChart');
	}

	public function shopProduct(){
		$this->m_shop = new Shop_Item();

		return json_encode($this->m_shop->productPerCategory()->with(['product_category'])->get());
	}

	public function shopProductChart(){
		return view('v_admin.dashboard.shopProductChart');
	}
}
