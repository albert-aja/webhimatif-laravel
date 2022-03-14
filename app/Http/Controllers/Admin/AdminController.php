<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Helpers\Breadcrumbs;
use App\Models\Management_Year;
use App\Models\Maintenance_Info;

class AdminController extends Controller
{
    public function __construct() {
		$this->dir_berita = 'assets/img/news/';
		$this->dir_divisi = 'assets/img/divisi/';
		$this->dir_toko	  = 'assets/img/shop/';

		$breadcrumbs 	= new Breadcrumbs;

		$this->data = [
			'tahun_kepengurusan' => Management_Year::first(),
			'statusWeb' 		 => Maintenance_Info::first(),
			'breadcrumb'		 => $breadcrumbs->buildAuto(),
		];
	}

	//template datatables
	public function table_data($table){
		$draw 	= $_REQUEST['draw'];
		$length = $_REQUEST['length'];
		$start 	= $_REQUEST['start'];
		$search = $_REQUEST['search']['value'];
		
		$total = $this->$table->getTotal();
		$output = [
			'length'		 => $length,
			'draw'			 => $draw,
			'recordsTotal'	 => $total,
			'recordsFiltered'=> $total
		] ;

		if($search !== ""){
			$list = $this->$table->getDataSearch($search, $length, $start);

			$total_search = $this->$table->getSearchTotal($search);
			$output = [
				'recordsTotal'		=> $total_search,
				'recordsFiltered'	=> $total_search
			];
		} else {
			$list = $this->$table->getData($length, $start);
		}

		return [
			'output' 	=> $output,
			'list' 		=> $list,
			'start' 	=> $start,
		];
	}
	
	//function untuk hapus sebuah direktori dan seluruh isinya
	public static function truncateDir($target){
		if(is_dir($target)){
			$files = glob($target. '/*', GLOB_MARK); //GLOB_MARK adds a slash to directories returned
			
			foreach($files as $file){
				self::truncateDir($file);      
			}

			rmdir($target);
		} elseif(is_file($target)) {
			unlink($target);  
		}
	}
}
