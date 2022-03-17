<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Truncate extends Controller
{
	public function __construct() {
		//memanggil constructor parent agar tidak tertimpa constructor baru
		parent::__construct();

		//connect ke database
		$this->db = \Config\Database::connect();

		//mengeluarkan table yang TIDAK INGIN DI TRUNCATE
		//array_diff untuk hapus spesifik value dan array_values untuk mereset index
		$tables = array_values(array_diff($this->db->listTables(), array(
			// bawaan
			"auth_activation_attempts",
			"auth_logins",
			"auth_reset_attempts",
			"auth_tokens",
			"migrations",

			//
			"web_info",
			"users",
			"tahun_kepengurusan",
			"sejarah",
		)));

		$this->data['table_data'] = [];

		for($i=0;$i<count($tables);$i++){
			$this->data['table_data'][$i] = $tables[$i];
		}
		
		//HARD-CODED
		//nama table dan direktori gambarnya
		$this->gbr = [
			['post', 'assets/img/news'],
			['shop', 'assets/img/shop'],
			['divisi', 'assets/img/divisi']
		];
	}

    public function index(){
		$this->data['title']  = "Truncate Table";
		
		return view('v_admin.truncate.data', $this->data);
    }

	public function getTable(){
		$draw 	= $_REQUEST['draw'];
		$length = $_REQUEST['length'];
		$start 	= $_REQUEST['start'];

		$total = count($this->data['table_data']);
		$output = [
			'length'		  => $length,
			'draw'			  => $draw,
			'recordsTotal'	  => $total,
			'recordsFiltered' => $total
		];
		
		$data = [];
		$no = $start + 1;

		foreach($this->data['table_data'] as $tmp){
			if(!$this->db->table($tmp)->get()->getResult()){
				continue;
			}

			$row  	= [];
			$row[] 	= $no;
			$row[] 	= $tmp;
			$row[] 	= '<button id="lihatDetailTabel" class="btn btn-info btn-icon icon-left" data-id="' .$tmp. '"><i class="fas fa-info"></i> Detail</button><button class="btn btn-icon icon-left btn-warning m-1" id="hapusTable" data-table="' .$tmp. '" type="button" style="min-width: 5rem"><i class="fas fa-skull-crossbones"></i> Truncate</button>';
			
			$data[] = $row;
			$no++;
		}

		$output['data'] = $data;

		echo json_encode($output);
		exit();
	}

	public function getTableDetail(){
		$table = $this->request->getVar('table');

		$this->data['title'] = 'Detail Tabel ' .$table;
		$this->data['field'] = $this->db->getFieldNames($table);
		$this->data['data']  = $this->db->table($table)->get()->getResultArray();

		return view('v_admin/truncate/tableDetail', $this->data);
	}

	public function truncateHandler(){
		$table = $this->request->getVar('table');
		
		if($table == '*'){
			foreach($this->data['table_data'] as $td){
				$this->db->table($td)->truncate();
			}

			//function untuk menghapus direktori dan seluruh isinya
			foreach($this->gbr as $g){
				$this->truncateDir($g[1]);
			}
		} else {
			foreach($this->gbr as $g){
				if(in_array($table, $g)){
					$this->truncateDir($g[1]);
				}
				break;
			}

			$this->db->table($table)->truncate();
		}
	}
}
