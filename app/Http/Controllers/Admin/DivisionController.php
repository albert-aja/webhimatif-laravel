<?php

namespace App\Http\Controllers;

use App\Models\Division;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
	public function index(){
		$this->data['title'] = 'Divisi';
		
		return view('v_server/divisi/data', $this->data);
	}

	public function getDivisi(){
		$table = $this->table_data('divisi');
		$data  = [];
		$no    = $table['start'] + 1;

		foreach($table['list'] as $tmp){
			$row   = [];
			$row[] = $no;
			$row[] = $tmp['divisi'];
			$row[] = $tmp['slug'];
			$row[] = $tmp['alias'];
			$row[] = '<a href="/Admin/divisi/progja?divisi=' .$tmp['slug']. '" class="btn btn-warning"><i class="fa fa-info"></i></a>';
			$row[] = '<a href="/Admin/divisi/pengurus?divisi=' .$tmp['slug']. '" class="btn btn-info"><i class="fa fa-search"></i></a>';
			$row[] = '<a href="/admin/divisi/view_edit_divisi?divisi=' .$tmp['slug']. '" class="btn btn-icon icon-left btn-primary m-1 clicked-button" type="button" style="min-width: 5rem"><i class="fas fa-pen"></i>Edit</a><button class="btn btn-icon icon-left btn-danger hapusDivisi m-1"  data-divisi="' .$tmp['divisi']. '" data-id="' .$tmp['id']. '" type="button" style="min-width: 5rem"><i class="fas fa-times"></i>Hapus</button>';
			
			$data[] = $row;
			$no++;
		}

		$table['output']['data'] = $data;

		echo json_encode($table['output']);
		exit();
	}

	public function view_add_divisi(){
		$this->data['title'] = 'Tambah Divisi';
		
		return view('v_server/divisi/add', $this->data);
	}

	public function add_divisi(){
		$nama = $this->request->getVar('nama');

		//validation 
		if(!$this->validate([
			'nama' => [
				'rules'  => 'required|is_unique[divisi.divisi]',
				'errors' => [
					'required'  => 'Nama divisi masih kosong',
					'is_unique' => 'Divisi <b>'.$nama.'</b> sudah ada',				
				]
			],
			'alias' => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'Alias divisi masih kosong',		
				]
			],
		])) {
			return redirect()->to('/Admin/divisi/view_add_divisi')->withInput();
		}

		//membuat slug dari title
		$slug = url_title($nama, '-', true);
		
		$alias = $this->request->getVar('alias');
		
		//process input data
		$this->m_divisi->save([
			'divisi' => $nama,
			'slug'   => $slug,
			'alias'  => $alias,
		]);
		
		//pesan yang ditampilkan apabila input success
		session()->setFlashdata('pesan', 'Divisi <b>'.$nama.'</b> telah ditambahkan.');
		
		return redirect()->to('/Admin/divisi');
	}

	public function view_edit_divisi(){
		$slug = $this->request->getVar('divisi');
		
		$this->data['title'] = 'Edit Divisi';
		
		$this->data['divisi'] = $this->m_divisi->getDataBySlug($slug);
		
		return view('v_server/divisi/edit', $this->data);
	}

	public function edit_divisi(){
		$id   = $this->request->getVar('id');
		$nama = $this->request->getVar('nama');
		$slug = $this->request->getVar('slug');

		//validation 
		if(!$this->validate([
			'nama' => [
				'rules'  => 'required|is_unique[divisi.divisi,divisi.id,'.$id.']',
				'errors' => [
					'required'  => 'Nama divisi masih kosong',
					'is_unique' => 'Divisi <b>'.$nama.'</b> sudah ada',				
				]
			],
			'alias' => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'Alias divisi masih kosong',		
				]
			],
		])) {
			return redirect()->to('/Admin/divisi/view_edit_divisi?divisi='.$slug)->withInput();
		}
		
		//membuat slug dari nama
		$slug = url_title($nama, '-', true);

		$alias = $this->request->getVar('alias');	//masukkan data dalam array
		$this->data = [
			'divisi' => $nama,
			'slug'   => $slug,
			'alias'  => $alias,
		];
		
		//process update data 
		$this->m_divisi->update($id, $this->data);

		//pesan yang ditampilkan apabila input success
		session()->setFlashdata('pesan', 'Divisi <b>'.$nama.'</b> berhasil di update.');
		
		return redirect()->to('/Admin/divisi');
	}

	public function delete_divisi($id){
		$this->m_divisi->delete($id);
	}

	public function pengurus(){
		$slug = $this->request->getVar('divisi');

		$this->data['divisi'] = $this->m_divisi->getDataBySlug($slug);

		$this->data['title'] = 'Pengurus ' .$this->data['divisi']['alias'];
		
		return view('v_server/pengurus/data', $this->data);
	}

	public function progja(){
		$slug = $this->request->getVar('divisi');
		
		$this->data['divisi'] = $this->m_divisi->getDataBySlug($slug);
		
		$this->data['title'] = 'Program Kerja ' .$this->data['divisi']['alias'];
		
		return view('v_server/progja/data', $this->data);
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
     * @param  \App\Models\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function show(Division $division)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function edit(Division $division)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Division $division)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function destroy(Division $division)
    {
        //
    }
}
