<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use Illuminate\Http\Request;

class MissionController extends Controller
{
	public function misi(){
		$this->data['title'] = 'Misi';
		
		return view('v_admin/config/misi/data', $this->data);
	}

	public function getMisi(){
		$table = $this->table_data('misi');
		
		$data = [];
		$no   = $table['start'] + 1;

		foreach($table['list'] as $tmp){
			$row   = [];
			$row[] = $no;
			$row[] = $tmp['isi'];

			//kolom untuk button
			$row[] = '<a href="/Admin/config/view_edit_misi?id='.$tmp['id'].'" class="btn btn-icon icon-left btn-primary m-1" style="min-width: 5rem"><i class="fas fa-pen"></i>Edit</a><button class="btn btn-icon icon-left btn-danger" id="delete_misi" type="button" data-id="'.$tmp['id'].'" style="min-width: 5rem"><i class="fas fa-times"></i>Hapus</button>';
			
			$data[] = $row;
			$no++;
		}
		
		$table['output']['data'] = $data;

		echo json_encode($table['output']);
		exit();
	}

	public function view_add_misi(){
		$this->data['title'] = 'Tambah Misi';
		
		return view('v_admin/config/misi/add', $this->data);
	}

	public function add_misi(){
		//validation 
		if(!$this->validate([
			'misi' => [
				'rules'  => 'required|is_unique[misi.isi]',
				'errors' => [
					'required'  => 'Misi masih kosong',
					'is_unique' => 'Misi sudah ada',				
				]
			],
		])) {
			return redirect()->to('/Admin/config/view_add_misi')->withInput();
		}

		//process input data
		$this->m_misi->save([
			'isi' => trim($this->request->getVar('misi')),
		]);
		
		//pesan yang ditampilkan apabila input success
		session()->setFlashdata('pesan', 'Misi baru telah dicatat.');
		
		return redirect()->to('/Admin/config/misi');
	}

	public function view_edit_misi(){
		$id = $this->request->getVar('id');

		$this->data['title'] = 'Edit Misi';

		$this->data['misi'] = $this->m_misi->find($id);
		
		return view('v_admin/config/misi/edit', $this->data);
	}

	public function edit_misi(){
		$id = $this->request->getVar('id');

		//validation 
		if(!$this->validate([
			'misi' => [
				'rules'  => 'required|is_unique[misi.isi,misi.id,'.$id.']',
				'errors' => [
					'required'  => 'Misi masih kosong',
					'is_unique' => 'Misi sudah ada',				
				]
			],
		])) {
			return redirect()->to('/Admin/config/view_edit_misi?id='.$id)->withInput();
		}

		$this->m_misi->update($id, [
			'isi' => $this->request->getVar('misi'),
		]);
		
		//pesan yang ditampilkan apabila input success
		session()->setFlashdata('pesan', 'Misi telah diedit.');
		
		return redirect()->to('/Admin/config/misi');
	}

	public function delete_misi($id){
		$this->m_misi->delete($id);
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
     * @param  \App\Models\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function show(Mission $mission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function edit(Mission $mission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mission $mission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mission  $mission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mission $mission)
    {
        //
    }
}
