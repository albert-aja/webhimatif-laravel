<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function sejarah(){
		$this->data['title'] = 'Sejarah';

		$this->data['sejarah'] = $this->m_sejarah->first() ?? '';
		
		return view('v_admin/config/sejarah', $this->data);
	}

	public function edit_sejarah(){
		//validation 
		if(!$this->validate([
			'sejarah' => [
				'rules'  => 'required|max_length[500]',
				'errors' => [
					'required' 	 => 'Sejarah belum diisi',
					'max_length' => 'Sejarah tidak boleh lebih dari 500 karakter',				
				]
			],
		])) {
			return redirect()->to('/Admin/Config/Sejarah')->withInput();
		}

		//process input data
		$this->m_sejarah->save([
			'id'  => $this->request->getVar('id'),
			'isi' => trim($this->request->getVar('sejarah')),
		]);

		//pesan yang ditampilkan apabila input success
		session()->setFlashdata('pesan', 'Sejarah Himatif telah diedit.');
		
		return redirect()->to('/Admin/Config/Sejarah');
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
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function show(History $history)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function edit(History $history)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, History $history)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function destroy(History $history)
    {
        //
    }
}
