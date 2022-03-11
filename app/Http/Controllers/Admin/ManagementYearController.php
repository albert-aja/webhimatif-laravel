<?php

namespace App\Http\Controllers;

use App\Models\Management_Year;
use Illuminate\Http\Request;

class ManagementYearController extends Controller
{
    public function periode(){
		$this->data['title'] = 'Periode Kepengurusan';

		return view('v_admin/config/tahun', $this->data);
	}

	public function edit_periode(){
		//validation 
		if(!$this->validate([
			'tahun' => [
				'rules'  => 'required|max_length[40]',
				'errors' => [
					'required'   => 'Periode Kepengurusan belum diisi',
					'max_length' => 'Periode Kepengurusan tidak boleh lebih dari 40 karakter',				
				]
			],
		])) {
			return redirect()->to('/Admin/Config/Periode')->withInput();
		}

		//process input data
		$this->tahun->save([
			'id'    => $this->request->getVar('id'),
			'tahun' => trim($this->request->getVar('tahun')),
		]);

		//pesan yang ditampilkan apabila input success
		session()->setFlashdata('pesan', 'Periode Kepengurusan telah diedit.');
		
		return redirect()->to('/Admin/Config/Periode');
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
     * @param  \App\Models\Management_Year  $management_Year
     * @return \Illuminate\Http\Response
     */
    public function show(Management_Year $management_Year)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Management_Year  $management_Year
     * @return \Illuminate\Http\Response
     */
    public function edit(Management_Year $management_Year)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Management_Year  $management_Year
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Management_Year $management_Year)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Management_Year  $management_Year
     * @return \Illuminate\Http\Response
     */
    public function destroy(Management_Year $management_Year)
    {
        //
    }
}
