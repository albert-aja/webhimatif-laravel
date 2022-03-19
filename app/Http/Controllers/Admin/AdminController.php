<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Helpers\Breadcrumbs;
use App\Models\Management_Year;

class AdminController extends Controller
{
    public function __construct() {
		$this->middleware(['isActive', 'auth']);

		$this->dir_berita = 'assets/img/news/';
		$this->dir_divisi = 'assets/img/divisi/';
		$this->dir_toko	  = 'assets/img/shop/';

		$breadcrumbs 	= new Breadcrumbs;

		$this->data = [
			'tahun_kepengurusan' => Management_Year::first(),
			'breadcrumb'		 => $breadcrumbs->buildAutoTag(),
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
