<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Commitee;
use Illuminate\Http\Request;

class CommiteeController extends AdminController
{
    public function image_process($img, $slug){
		$image_array_1 = explode(";", $img);
		$image_array_2 = explode(",", $image_array_1[1]);
		
		//decode blob image
		$data = base64_decode($image_array_2[1]);
		$img_binary = imagecreatefromstring($data);

		$background = imagecolorallocate($img_binary , 0, 0, 0);
		
        // removing the black from the placeholder
        imagecolortransparent($img_binary, $background);

        // turning off alpha blending (to ensure alpha channel information
        // is preserved, rather than removed (blending with the rest of the
        // image in the form of black))
        imagealphablending($img_binary, false);

        // turning on alpha channel information saving (to ensure the full range
        // of transparency is preserved)
        imagesavealpha($img_binary, true);

		$nama_img = bin2hex(random_bytes(25)). '.png';
		
		$path = './assets/img/divisi/' .$slug. '/' .$nama_img. '/';

		if (!file_exists($path)) {
			@mkdir($path, 0777, true);
		}
		
		imagepng($img_binary, $path.$nama_img, 9);
		
		\Config\Services::image()
			->withFile($path.$nama_img)
			->resize(700, 600, true, 'height')
			->save($path.$nama_img);
			
		\Config\Services::image()
			->withFile($path.$nama_img)
			->resize(400, 200, true, 'height')
			->save($path. '2x_' .$nama_img);
			
		\Config\Services::image()
			->withFile($path.$nama_img)
			->resize(100, 80, true, 'height')
			->save($path. '3x_' .$nama_img);
		
		return $nama_img;
	}

	public function getPengurus(){
		$url_components = parse_url(previous_url());

		parse_str($url_components['query'], $params);

		$id = $this->m_divisi->getIdBySlug($params['divisi']);
		
		$draw 	= $_REQUEST['draw'];
		$length = $_REQUEST['length'];
		$start 	= $_REQUEST['start'];
		$search = $_REQUEST['search']['value'];
		
		$total 	= $this->m_pengurus->getByDivisi($id)->getTotal();
		$output = [
			'length'			=> $length,
			'draw'				=> $draw,
			'recordsTotal'		=> $total,
			'recordsFiltered'	=> $total
		];

		if($search !== ""){
			$list = $this->m_pengurus->getByDivisi($id)->getDataSearch($search, $length, $start);

			$total_search = $this->m_pengurus->getByDivisi($id)->getSearchTotal($search);
			$output = [
				'recordsTotal'		=> $total_search,
				'recordsFiltered'	=> $total_search
			];
		} else {
			$list = $this->m_pengurus->getByDivisi($id)->getData($length, $start);
		}
		
		$data 	= [];
		$no 	= $start + 1;

		foreach($list as $tmp){
			$row   = [];
			$row[] = $no;
			$row[] = $tmp['nama'];
			$row[] = '<img src="' .base_url(). '/assets/img/divisi/' .$params['divisi']. '/' .$tmp['foto']. '/3x_' .$tmp['foto'].'" style="max-width: 4rem;">';
			$row[] = $tmp['divisi'];
			$row[] = $tmp['jabatan'];
			$row[] = '<a href="/admin/pengurus/view_edit_pengurus?divisi=' .$params['divisi']. '&id=' .$tmp['id']. '" class="btn btn-icon icon-left btn-primary m-1 clicked-button" type="button" style="min-width: 5rem"><i class="fas fa-pen"></i>Edit</a><button class="btn btn-icon icon-left btn-danger hapusPengurus m-1" data-id='.$tmp['id'].' data-pengurus='.$tmp['nama'].' type="button" style="min-width: 5rem"><i class="fas fa-times"></i>Hapus</button>';
			
			$data[] = $row;
			$no++;
		}

		$output['data'] = $data;

		echo json_encode($output);
		exit();
	}

	public function view_add_pengurus(){
		$this->data['title'] = 'Tambah Pengurus';
		
		$slug = $this->request->getVar('divisi');
		
		$this->data['divisi'] = $this->m_divisi->getDataBySlug($slug);

		if($this->data['divisi']['id'] == 1){
			$this->data['jabatan'] = $this->m_jabatan->findAll(3, 2);
		} else {
			$this->data['jabatan'] = $this->m_jabatan->find([1, 2, 6]);
		}
		
		return view('v_admin/pengurus/add', $this->data);
	}
	
	public function add_pengurus(){
		$slug_divisi = $this->request->getVar('divisi');
		
		//validation 
		if(!$this->validate([
			'nama' => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'Nama pengurus masih kosong',				
				]
			],
			'foto' => [
				'rules'  => 'uploaded[foto]|mime_in[foto, image/jpg,image/jpeg,image/png]|is_image[foto]|max_size[foto, 5120]',
				'errors' => [
					'uploaded' 	=> 'Foto pengurus belum di upload.',
					'mime_in' 	=> 'Format foto yang diizinkan adalah .jpg, .jpeg dan .png.',
					'is_image' 	=> 'File yang diupload bukan gambar.',
					'max_size' 	=> 'Ukuran maksimum foto adalah 5mb.',
				]
			],
			'jabatan' => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'Jabatan pengurus belum diisi.'
				]
			],
		])) {
			return redirect()->to('/Admin/pengurus/view_add_pengurus?divisi=' .$slug_divisi)->withInput();
		}

		$nama 		= $this->request->getVar('nama');
		$jabatan 	= $this->request->getVar('jabatan');
		$hero_img 	= $this->request->getVar('preview');
		
		$foto = $this->image_process($hero_img, $slug_divisi);
		
		$divisi = $this->m_divisi->getIdBySlug($slug_divisi);

		//process input data
		$this->m_pengurus->save([
			'nama' 		=> $nama,
			'foto' 		=> $foto,
			'jabatan' 	=> $jabatan,
			'divisi' 	=> $divisi['id'],
		]);
		
		//pesan yang ditampilkan apabila input success
		session()->setFlashdata('pesan', 'Data <b>'.$nama.'</b> telah ditambahkan.');
		
		return redirect()->to('/Admin/divisi/pengurus?divisi='. $slug_divisi);
	}

	public function view_edit_pengurus(){
		$this->data['title'] = 'Edit Pengurus';

		$this->data['divisi'] 	= $this->m_divisi->getDataBySlug($this->request->getVar('divisi'));
		$this->data['pengurus'] = $this->m_pengurus->find($this->request->getVar('id'));

		if($this->data['divisi']['id'] == 1){
			$this->data['jabatan'] = $this->m_jabatan->findAll(3, 2);
		} else {
			$this->data['jabatan'] = $this->m_jabatan->find([1, 2, 6]);
		}
		
		return view('v_admin/pengurus/edit', $this->data);
	}
	
	public function edit_pengurus(){
		$id = $this->request->getVar('id');
		$slug_divisi = $this->request->getVar('divisi');
		
		//validation 
		if(!$this->validate([
			'nama' => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'Nama pengurus masih kosong',				
				]
			],
			'foto' => [
				'rules'  => 'mime_in[foto, image/jpg,image/jpeg,image/png]|is_image[foto]|max_size[foto, 5120]',
				'errors' => [
					'mime_in'  => 'Format foto yang diizinkan adalah .jpg, .jpeg dan .png.',
					'is_image' => 'File yang diupload bukan gambar.',
					'max_size' => 'Ukuran maksimum foto adalah 5mb.',
				]
			],
			'jabatan' => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'Jabatan pengurus belum diisi.'
				]
			],
		])) {
			return redirect()->to('/Admin/Pengurus/view_edit_pengurus?divisi=' .$slug_divisi. '&id=' .$id)->withInput();
		}

		$id 		= $this->request->getVar('id');
		$nama 		= $this->request->getVar('nama');
		$jabatan 	= $this->request->getVar('jabatan');
		$hero_img 	= $this->request->getVar('preview');
		$old_img 	= $this->request->getVar('old_img');

		if($hero_img == ''){
			$foto = $old_img;
		} else{
			$foto = $this->image_process($hero_img, $slug_divisi);
			
			//hapus gambar lama dari server 
			$this->truncateDir($this->dir_divisi .$slug_divisi. '/' .$old_img);
		}

		$divisi = $this->m_divisi->getIdBySlug($slug_divisi);

		$this->m_pengurus->update($id, [
			'nama' => $nama,
			'foto' => $foto,
			'jabatan' => $jabatan,
			'divisi' => $divisi['id'],
		]);
		
		//pesan yang ditampilkan apabila input success
		session()->setFlashdata('pesan', 'Data <b>'.$nama.'</b> telah diedit.');
		
		return redirect()->to('/Admin/divisi/pengurus?divisi='. $slug_divisi);
	}

	public function delete_pengurus($id){
		$this->data['pengurus'] = $this->m_pengurus->find($id);
		$old_img = $this->data['pengurus']['foto'];
		
		$slug_divisi = $this->m_divisi->find($this->data['pengurus']['divisi'])['slug'];

		unlink($this->dir_divisi .$slug_divisi. '/pengurus/' .$old_img);

		$this->m_pengurus->delete($id);
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
     * @param  \App\Models\Commitee  $commitee
     * @return \Illuminate\Http\Response
     */
    public function show(Commitee $commitee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commitee  $commitee
     * @return \Illuminate\Http\Response
     */
    public function edit(Commitee $commitee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commitee  $commitee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commitee $commitee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commitee  $commitee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commitee $commitee)
    {
        //
    }
}
