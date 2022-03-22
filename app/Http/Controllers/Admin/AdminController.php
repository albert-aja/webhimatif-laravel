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

		$this->dir_berita = 'img/news/';
		$this->dir_divisi = 'img/divisi/';
		$this->dir_toko	  = 'img/shop/';

		$breadcrumbs 	= new Breadcrumbs;

		$this->data = [
			'tahun_kepengurusan' => Management_Year::first(),
			'breadcrumb'		 => $breadcrumbs->buildAutoTag(),
		];
	}
}
