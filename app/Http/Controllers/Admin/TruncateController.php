<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\General;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TruncateController extends AdminController
{
	public function __construct() {
		//memanggil constructor parent agar tidak tertimpa constructor baru
		parent::__construct();

		//HARD-CODED
		//nama table dan direktori gambarnya
		$this->gbr = [
			['post', 'assets/img/news'],
			['shop', 'assets/img/shop'],
			['divisi', 'assets/img/divisi']
		];
	}

    public function index(){
		$this->data['title'] = "Truncate Table";

		$this->db_name = 'Tables_in_' .DB::getDatabaseName();

		$all_tables = collect(DB::select('SHOW TABLES'))->map(function ($table) {
			return $table->{$this->db_name};
		})->toArray();

		for($i=0;$i<count($all_tables);$i++){
			if(!DB::table($all_tables[$i])->first()){
				unset($all_tables[$i]);
			}
		}

		//mengeluarkan table yang TIDAK INGIN DI TRUNCATE
		//array_diff untuk hapus spesifik value dan array_values untuk mereset index
		$query = array_values(array_diff($all_tables, 
			[
				"maintenance__infos", "users",
				"histories", "management__years", 
				"password_resets", "personal_access_tokens", "migrations"
			]
		));

		if(request()->ajax()){
            return Datatables::of($query)
					->addColumn('table', function($item){
						return $item;
					})
					->addColumn('action', function($item){
						return '<div class="dropdown d-inline">
									<button class="btn btn-warning dropdown-toggle me-1 mb-1" type="button" data-bs-toggle="dropdown">' .__('admin/crud.btn.action'). '</button>
									<div class="dropdown-menu">
										<a type="button" class="dropdown-item has-icon detailTable" data-tbl="' .$item. '">
											<i class="fas fa-pen"></i> Detail
										</a>
										<a type="button" class="dropdown-item has-icon truncateTable" data-tbl="' .$item. '">
											<i class="fas fa-skull-crossbones"></i> Truncate
										</a>
									</div>
								</div>';
					})
					->rawColumns(['action'])
					->addIndexColumn()
					->make();
        }

		return view('v_admin.truncate.data', $this->data);
    }

	public function getTableDetail(Request $request){
		$table = $request->table;

		$this->data['title'] = 'Detail Tabel ' .$table;
		$this->data['field'] = DB::getSchemaBuilder()->getColumnListing($table);
		$this->data['data']  = DB::table($table)->get();

		return view('v_admin.truncate.tableDetail', $this->data);
	}

	public function truncateHandler(Request $request){
		$table = $request->table;

		if($table == '*'){
			foreach($this->data['table_data'] as $td){
				DB::table($td)->truncate();
			}

			//function untuk menghapus direktori dan seluruh isinya
			foreach($this->gbr as $g){
				General::clearStorage($g[1]);
			}
		} else {
			foreach($this->gbr as $g){
				if(in_array($table, $g)){
					General::clearStorage($g[1]);
				}
				break;
			}

			DB::table($table)->truncate();
		}
	}
}
