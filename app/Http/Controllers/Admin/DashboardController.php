<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;

class DashboardController extends AdminController
{
    public function nullData($array){
		$data = [
			'created_at' => '',
			'total' => 'NaN',
		];

		array_unshift($array, $data);
		array_push($array, $data);

		return $array;
	}

	// dashboard
	public function index(){
		$this->data['title'] = 'Dashboard';
		
		$this->data['jumlahDivisi'] 	= $this->m_divisi->countAllResults();
		$this->data['jumlahPengurus'] 	= $this->m_pengurus->countAllResults();
		$this->data['jumlahBerita'] 	= $this->m_post->countAllResults();
		$this->data['jumlahProduk'] 	= $this->m_shop->countAllResults();
		
		return view('v_admin/dashboard/dashboard', $this->data);
	}

	public function newsDateRange(){
		$range_data = $this->m_post->getLast12Months($this->m_post->selectNewest()['created_at']);
		
		$this->data['startMonth'] = ambilBulanTahun($range_data->selectMin('created_at')->first()['created_at']);
		$this->data['endMonth'] = ambilBulanTahun(date('Y-m-d'));

		return view('v_admin/dashboard/newsStatChart', $this->data);
	}

	public function newsStatChart(){
		$monthly_total = $this->m_post->getCountLast12Months($this->m_post->selectNewest()['created_at']);

		$startMonth = date_format(date_create(current($monthly_total)['created_at']), "Y-m"). '-01';
		$endMonth   = date('Y-m-d');
		
		$start    = new \DateTime($startMonth);
		$end      = new \DateTime($endMonth);
		$interval = new \DateInterval('P1M');

		$period   = new \DatePeriod($start, $interval, $end);

		$date_arr = [];
		$i = 0;
		
		foreach($period as $dt) {
			$date_arr[$i]['created_at'] = ambilBulanTahun($dt->format("Y-m-d"));
			$date_arr[$i]['total'] = 0;
			$i++;
		}
		
		foreach($monthly_total as &$mt) {
			$mt['created_at'] = ambilBulanTahun($mt['created_at']);
			foreach($date_arr as &$date){
				if($date['created_at'] == $mt['created_at']){
					$date['total'] = $mt['total'];
				}
			}
		}

		$jumlah_data = count($date_arr);
		$maks_data = 12;
		
		if($jumlah_data < $maks_data){
			if($jumlah_data < $maks_data - 2){
				$date_arr = $this->nullData($date_arr);
			}
		}
		
		return json_encode($date_arr);
	}

	public function latestNews(){
		$this->data['beritaTerbaru'] = $this->m_post->sort_byDate()->findAll(5);
		
		return view('v_admin/dashboard/latestNews', $this->data);
	}


	public function topNews(){
		$this->data['rankedNews'] = 10;
		$this->data['newsData']   = $this->m_post->sort_byView()->findAll($this->data['rankedNews']);

		return view('v_admin/dashboard/topNews', $this->data);
	}

	public function anggotaHimatif(){
		$anggotaHimatif = $this->m_pengurus->getAnggotaHimatif();

		foreach($anggotaHimatif as &$ad){
			if($ad['alias'] === 'BPH'){
				$ad['utama'] = $ad['utama'] * 2;
			}
		}

		return json_encode($anggotaHimatif);
	}

	public function anggotaHimatifChart(){
		return view('v_admin/dashboard/anggotaHimatifChart');
	}
}
