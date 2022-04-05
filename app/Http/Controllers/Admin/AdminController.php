<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Helpers\Breadcrumbs;
use App\Models\Management_Year;

use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    public function __construct() {
		$this->middleware(['isActive', 'auth']);

		$breadcrumbs 	= new Breadcrumbs;

		$this->data = [
			'tahun_kepengurusan' => Management_Year::first(),
			'breadcrumb'		 => $breadcrumbs->buildAutoTag(),
		];
	}

	protected function saveResized(array $sizes, $img, string $folderPath, string $filename){
        $img = Image::make($img);

		for($i=0;$i<count($sizes);$i++){
			$front_name = ($i+1). 'x_';
			$img->resize(null, $sizes[$i], function ($const) {
				$const->aspectRatio();
			})->save($folderPath. '/' .$front_name. $filename);
		}
	}

	protected function makedir($folderPath){
		if (!file_exists($folderPath)) {
			@mkdir($folderPath, 0775, true);
		}
	}
}
