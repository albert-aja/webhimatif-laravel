<?php

namespace App\Http\Controllers;

use App\Models\Vision;
use Illuminate\Http\Request;

class VisionController extends Controller
{
	public function visi(){
		$this->data['title'] = 'Visi';

		$this->data['visi'] = $this->m_visi->first() ?? '';
		
		return view('v_admin/config/visi', $this->data);
	}

	public function edit_visi(){
		//validation 
		if(!$this->validate([
			'visi' => [
				'rules'  => 'required|max_length[255]',
				'errors' => [
					'required' 	 => 'Visi belum diisi',
					'max_length' => 'Visi tidak boleh lebih dari 255 karakter',				
				]
			],
		])) {
			return redirect()->to('/Admin/Config/Visi')->withInput();
		}

		//process input data
		$this->m_visi->save([
			'id'  => $this->request->getVar('id'),
			'isi' => trim($this->request->getVar('visi')),
		]);

		//pesan yang ditampilkan apabila input success
		session()->setFlashdata('pesan', 'Visi Himatif telah diedit.');
		
		return redirect()->to('/Admin/Config/Visi');
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
     * @param  \App\Models\Vision  $vision
     * @return \Illuminate\Http\Response
     */
    public function show(Vision $vision)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vision  $vision
     * @return \Illuminate\Http\Response
     */
    public function edit(Vision $vision)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vision  $vision
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vision $vision)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vision  $vision
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vision $vision)
    {
        //
    }
}
