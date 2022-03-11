<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
	public function service(){
		$this->data['title'] = 'Layanan';
		
		return view('v_server/config/layanan/data', $this->data);
	}

	public function getService(){
		$table = $this->table_data('service');
		
		$data = [];
		$no = $table['start'] + 1;

		foreach($table['list'] as $tmp){
			$row   = [];
			$row[] = $no;
			$row[] = $tmp['layanan'];
			$row[] = '<a href="'.$tmp['link'].'">'.$tmp['link'].'</a>';

			//kolom untuk button
			$row[] = '<a href="/Admin/config/view_edit_misi?id='.$tmp['id'].'" class="btn btn-icon icon-left btn-primary m-1" style="min-width: 5rem"><i class="fas fa-pen"></i>Edit</a><button class="btn btn-icon icon-left btn-danger" id="delete_misi" type="button" data-id="'.$tmp['id'].'" style="min-width: 5rem"><i class="fas fa-times"></i>Hapus</button>';
			
			$data[] = $row;
			$no++;
		}
		
		$table['output']['data'] = $data;

		echo json_encode($table['output']);
		exit();
	}

	public function delete_service($id){
		$this->m_service->delete($id);
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
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
    }
}
