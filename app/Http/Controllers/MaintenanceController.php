<?php

namespace App\Http\Controllers;

use App\Models\Social_Media;

class MaintenanceController extends Controller
{
    public function index(){
		$data['title'] = 'Website Sedang Maintenance';
		$data['social'] = Social_Media::all();

		return view('errors.maintenance', $data);
	}
}
