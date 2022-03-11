<?php

namespace App\Http\Controllers;

use App\Models\Vision;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index(){
		$data['title'] = 'Website Sedang Maintenance';
		$data['social'] = $this->m_social->findAll();

		return view('errors/maintenance', $data);
	}
}
