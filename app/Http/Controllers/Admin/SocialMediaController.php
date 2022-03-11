<?php

namespace App\Http\Controllers;

use App\Models\Social_Media;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
	public function sosial(){
		$this->data['title'] = 'Media Sosial';
		
		return view('v_server/config/social/data', $this->data);
	}

	public function getSocial(){
		$table = $this->table_data('social');
		
		$data = [];
		$no = $table['start'] + 1;

		foreach($table['list'] as $tmp){
			$row = [];
			$row[] = $no;
			$row[] = $tmp['social'];
			$row[] = '<a href="'.$tmp['link'].'">'.$tmp['link'].'</a>';
			$row[] = '<i class="'.$tmp['icon'].'" style="font-size: 2.5rem;"></i>';
			$row[] = '<div style="background:'.$tmp['color'].';" class="social-color"></div>';

			//kolom untuk button
			$row[] = '<a href="/Admin/config/view_edit_misi?id='.$tmp['id'].'" class="btn btn-icon icon-left btn-primary m-1" style="min-width: 5rem"><i class="fas fa-pen"></i>Edit</a><button class="btn btn-icon icon-left btn-danger" id="delete_misi" type="button" data-id="'.$tmp['id'].'" style="min-width: 5rem"><i class="fas fa-times"></i>Hapus</button>';
			
			$data[] = $row;
			$no++;
		}
		
		$table['output']['data'] = $data;

		echo json_encode($table['output']);
		exit();
	}

	public function delete_social($id){
		$this->m_social->delete($id);
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
     * @param  \App\Models\Social_Media  $social_Media
     * @return \Illuminate\Http\Response
     */
    public function show(Social_Media $social_Media)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Social_Media  $social_Media
     * @return \Illuminate\Http\Response
     */
    public function edit(Social_Media $social_Media)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Social_Media  $social_Media
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Social_Media $social_Media)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Social_Media  $social_Media
     * @return \Illuminate\Http\Response
     */
    public function destroy(Social_Media $social_Media)
    {
        //
    }
}
