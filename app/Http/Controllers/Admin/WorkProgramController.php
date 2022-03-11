<?php

namespace App\Http\Controllers;

use App\Models\Work_Program;
use Illuminate\Http\Request;

class WorkProgramController extends Controller
{
	public function getProgja(){
		$url_components = parse_url(previous_url());

		parse_str($url_components['query'], $params);

		$id = $this->m_divisi->getIdBySlug($params['divisi']);
		
		$draw 	= $_REQUEST['draw'];
		$length = $_REQUEST['length'];
		$start 	= $_REQUEST['start'];
		$search = $_REQUEST['search']['value'];
		
		$total = $this->m_progja->getByDivisi($id)->getTotal();
		$output = [
			'length'		 => $length,
			'draw'			 => $draw,
			'recordsTotal'	 => $total,
			'recordsFiltered'=> $total
		];

		if($search !== ""){
			$list = $this->m_progja->getByDivisi($id)->getDataSearch($search, $length, $start);

			$total_search = $this->m_progja->getByDivisi($id)->getSearchTotal($search);
			$output = [
				'recordsTotal'		=> $total_search,
				'recordsFiltered'	=> $total_search
			];
		} else {
			$list = $this->m_progja->getByDivisi($id)->getData($length, $start);
		}
		
		$data = [];
		$no = $start + 1;

		foreach($list as $tmp){
			$row   = [];
			$row[] = $no;
			$row[] = $tmp['progja'];
            $row[] = $tmp['deskripsi'];
			$row[] = $tmp['alias'];
			$row[] = '<a href="/admin/progja/view_edit_progja?divisi=' .$params['divisi']. '&id=' .$tmp['id']. '" class="btn btn-icon icon-left btn-primary m-1 clicked-button" type="button" style="min-width: 5rem"><i class="fas fa-pen"></i>Edit</a><button class="btn btn-icon icon-left btn-danger hapusProgja m-1" data-id='.$tmp['id'].' data-progja='.$tmp['progja'].' type="button" style="min-width: 5rem"><i class="fas fa-times"></i>Hapus</button>';
			
			$data[] = $row;
			$no++;
		}

		$output['data'] = $data;

		echo json_encode($output);
		exit();
	}

	public function view_add_progja(){
		$this->data['title'] = 'Tambah Program Kerja';
		
		$slug = $this->request->getVar('divisi');
		
		$this->data['divisi'] = $this->m_divisi->getDataBySlug($slug);
		
		return view('v_admin/progja/add', $this->data);
	}
	
	public function add_progja(){
		$slug_divisi = $this->request->getVar('divisi');
		
		//validation 
		if(!$this->validate([
			'progja' => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'Program kerja masih kosong',				
				]
			],
			'deskripsi' => [
				'rules'  => 'required|max_length[500]',
				'errors' => [
					'required'   => 'Deskripsi progja belum diisi.',
					'max_length' => 'Deskripsi progja hanya 500 karakter.'
				]
			],
		])) {
			return redirect()->to('/Admin/progja/view_add_progja?divisi=' .$slug_divisi)->withInput();
		}

		$progja  	= $this->request->getVar('progja');
		$deskripsi  = $this->request->getVar('deskripsi');
		
		$divisi = $this->m_divisi->getIdBySlug($slug_divisi);

		//process input data
		$this->m_progja->save([
			'progja' 	=> $progja,
			'deskripsi' => $deskripsi,
			'divisi' 	=> $divisi['id'],
		]);
		
		//pesan yang ditampilkan apabila input success
		session()->setFlashdata('pesan', 'Progja <b>'.$progja.'</b> telah ditambahkan.');
		
		return redirect()->to('/Admin/divisi/progja?divisi='. $slug_divisi);
	}

	public function view_edit_progja(){
		$slug 	= $this->request->getVar('divisi');
		$id 	= $this->request->getVar('id');
		
		$this->data['divisi'] = $this->m_divisi->getDataBySlug($slug);
		$this->data['progja'] = $this->m_progja->find($id);

		$this->data['title'] = 'Edit Progja';
		
		return view('v_admin/progja/edit', $this->data);
	}
	
	public function edit_progja(){
		$id = $this->request->getVar('id');
		$slug_divisi = $this->request->getVar('divisi');
		
		//validation 
		if(!$this->validate([
			'progja' => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'Program kerja masih kosong',				
				]
			],
			'deskripsi' => [
				'rules'  => 'required|max_length[500]',
				'errors' => [
					'required'   => 'Deskripsi progja belum diisi.',
					'max_length' => 'Deskripsi progja hanya 500 karakter.'
				]
			],
		])) {
			return redirect()->to('/Admin/progja/view_add_progja?divisi=' .$slug_divisi)->withInput();
		}

		$progja 	= $this->request->getVar('progja');
		$deskripsi  = $this->request->getVar('deskripsi');

		$this->m_progja->update($id, [
			'progja' 	=> $progja,
			'deskripsi' => $deskripsi,
		]);
		
		//pesan yang ditampilkan apabila input success
		session()->setFlashdata('pesan', 'Progja <b>'.$progja.'</b> telah diedit.');
		
		return redirect()->to('/Admin/divisi/progja?divisi='. $slug_divisi);
	}

	public function delete_progja($id){
		$this->m_progja->delete($id);
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
     * @param  \App\Models\Work_Program  $work_Program
     * @return \Illuminate\Http\Response
     */
    public function show(Work_Program $work_Program)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Work_Program  $work_Program
     * @return \Illuminate\Http\Response
     */
    public function edit(Work_Program $work_Program)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Work_Program  $work_Program
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Work_Program $work_Program)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Work_Program  $work_Program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Work_Program $work_Program)
    {
        //
    }
}
