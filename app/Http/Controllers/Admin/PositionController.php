<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
	public function index(){
		$this->data['title'] = 'Jabatan';

		return view('v_admin/jabatan/data', $this->data);
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit(Position $position)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Position $position)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
        //
    }
}
