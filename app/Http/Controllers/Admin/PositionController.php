<?php

namespace App\Http\Controllers\Admin;

use App\Models\Division;
use App\Models\Position;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Admin\AdminController;

class PositionController extends AdminController
{
	public function __construct(){
		parent::__construct();
		$this->data['page'] = ['page' => 'Jabatan'];
	}

	public function getNewPosition(){
		$this->data['position'] = Position::latest()->first();

		return view('v_admin.position.new_data', $this->data);
	}

	public function index(){
		$this->data['title'] = 'Jabatan';

		return view('v_admin.position.data', $this->data);
	}

    public function store(Request $request){
        $val = self::validator($request->all());

		if(!empty($val->errors()->messages())){
			$feedback['status'] 	= __('admin/crud.val_failed');
			$feedback['position'] 	= $val->errors()->first('position') ?? false;
		} else {
			Position::create($request->all());

			$feedback['status'] = __('admin/crud.val_success');
		}

		echo json_encode($feedback);
    }

    private function validator(array $data, string $id = ''){
        return Validator::make($data, [
			'position'		=> 'required|unique:positions' .(($id) ? ',position,'.$id : ''),
		], [
			'position.required' 	=> __('admin/validation.position.required'),
			'position.unique' 		=> __('admin/validation.position.unique'),
		]);
    }

	public function getJabatan(){
		$table = $this->table_data('jabatan');

		$data = [];
		$no = $table['start'] + 1;

		foreach($table['list'] as $tmp){
			$row = [];
			$row[] = $no;
			$row[] = $tmp['jabatan'];
			$row[] = '<a href="/admin/Jabatan/view_edit_jabatan?id=' .$tmp['id']. '" class="btn btn-icon icon-left btn-primary m-1" type="button" style="min-width: 5rem"><i class="fas fa-pen"></i>Edit</a><button class="btn btn-icon icon-left btn-danger hapusJabatan m-1"  data-jabatan="' .$tmp['jabatan']. '" data-id="' .$tmp['id']. '" data-toggle="modal" data-target="#konfirmasiHapus" type="button" style="min-width: 5rem"><i class="fas fa-times"></i>Hapus</button>';
			
			$data[] = $row;
			$no++;
		}

		$table['output']['data'] = $data;

		echo json_encode($table['output']);
		exit();
	}

	public function view_add_jabatan(){
		$this->data['title'] = 'Tambah Jabatan';

		return view('v_admin/jabatan/add', $this->data);
	}

	public function add_jabatan(){
		$jabatan = $this->request->getVar('jabatan');

		//validation 
		if(!$this->validate([
			'jabatan' => [
				'rules'  => 'required|is_unique[jabatan.jabatan]',
				'errors' => [
					'required'  => 'Jabatan masih kosong',
					'is_unique' => 'Jabatan <b>'.$jabatan.'</b> sudah ada',				
				]
			],
		])) {
			return redirect()->to('/Admin/Jabatan/view_add_jabatan')->withInput();
		}

		//process input data
		$this->m_jabatan->save([
			'jabatan' => $jabatan,
		]);

		//pesan yang ditampilkan apabila input success
		session()->setFlashdata('pesan', 'Jabatan <b>'.$jabatan.'</b> telah ditambahkan.');

		return redirect()->to('/Admin/Jabatan');
	}

	public function view_edit_jabatan(){
		$id = $this->request->getVar('id');

		$this->data['title'] = 'Edit Jabatan';

		$this->data['jabatan'] = $this->m_jabatan->find($id);

		return view('v_admin/jabatan/edit', $this->data);
	}

	public function edit_jabatan(){
		$id = $this->request->getVar('id');
		$jabatan = $this->request->getVar('jabatan');

		//validation 
		if(!$this->validate([
			'jabatan' => [
				'rules'  => 'required|is_unique[jabatan.jabatan]',
				'errors' => [
					'required'  => 'Jabatan masih kosong',
					'is_unique' => 'Jabatan <b>'.$jabatan.'</b> sudah ada',				
				]
			],
		])) {
			return redirect()->to('/Admin/Jabatan/view_add_jabatan?id=' .$id)->withInput();
		}

		$this->m_jabatan->update($id, [
			'jabatan' => $jabatan,
		]);

		//pesan yang ditampilkan apabila input success
		session()->setFlashdata('pesan', 'Jabatan <b>'.$jabatan.'</b> telah ditambahkan.');

		return redirect()->to('/Admin/jabatan');
	}

	public function delete_jabatan($id){
		$this->m_jabatan->delete($id);
	}

    public function create(){
		$this->data['title'] = __('admin/crud.add', $this->data['page']);

		return view('v_admin.position.modal_add', $this->data);
    }
}
