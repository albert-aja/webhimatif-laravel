<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function uploadProccessing($date, $slug, $image, $folder_name = '', $name = ''){
		//generate nama random untuk gambar
		if($name == ''){
			$name = $image->getRandomName();
		}
		
		if($folder_name == ''){
			//buat slug untuk nama folder
			$folder_name = url_title(tgl_indonesia($date), '-', true) .'_'. $slug;
		}

		//membuat folder apabila belum ada
		if (!file_exists($this->dir_berita .$folder_name)) {
			@mkdir($this->dir_berita .$folder_name, 0777, true);
		}

		//melakukan resize gambar sebanyak 3 ukuran
		//besar
		\Config\Services::image()
			->withFile($image)
			->resize(1000, 800, true, 'height')
			->save($this->dir_berita .$folder_name .'/1x_' .$name);

		//medium
		\Config\Services::image()
			->withFile($image)
			->resize(600, 300, true, 'height')
			->save($this->dir_berita .$folder_name .'/2x_' .$name);
		
		//kecil
		\Config\Services::image()
			->withFile($image)
			->resize(200, 100, true, 'height')
			->save($this->dir_berita .$folder_name .'/3x_' .$name);
			
		//mengakali bug adanya file html kosong saat gambar disimpan
		$empty_file = $folder_name. '/index.html';
		
		//apabila index.html ada, maka dihapus
		if(file_exists($empty_file)){
			unlink($empty_file);
		}
		
		//mengembalikan nama gambar untuk disimpan ke dalam database
		return $name;
	}

	public function uploadArticleImage(){
		$title = $this->request->getVar('judul');
		$date  = $this->request->getVar('date');
		
		if($date == ''){
			$date = date('Y-m-d');
		}

		//membuat slug dari title
		$slug = url_title($title, '-', true);

		$image = $this->request->getFile('upload');

		$name   = $image->getRandomName();
		$folder = url_title(tgl_indonesia($date), '-', true) .'_'. $slug .'/img';

		if (!file_exists($this->dir_berita .$folder)) {
			@mkdir($this->dir_berita .$folder, 0777, true);
		}

		$path = $this->dir_berita .$folder .'/2x_' .$name;
		
		\Config\Services::image()
			->withFile($image)
			->resize(1000, 800, true, 'height')
			->save($this->dir_berita .$folder .'/1x_' .$name);

		\Config\Services::image()
			->withFile($image)
			->resize(800, 350, true, 'width')
			->save($path);
			
		$functionNumber = $this->request->getVar('CKEditorFuncNum');
		$url = base_url(). '/' .$path;
		$message = '';
		
		echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($functionNumber, '$url', $message)</script>";
	}

	public function index(){
		$this->data['title'] = 'Berita';
		
		return view('v_server/berita/data', $this->data);
	}

	public function getArticle(){
		$table = $this->table_data('post');
		
		$data = [];
		$no   = $table['start'] + 1;

		foreach($table['list'] as $tmp){
			$img_loc = getFolderPath($tmp['created_at'], $tmp['slug']);

			$row   = [];
			$row[] = $no;
			$row[] = $tmp['title'];
			$row[] = $tmp['slug'];

			// potong artikel > 150 dengan '...'
			if(strlen($tmp['article']) <= 150){
				$row[] = $tmp['article'];
			} else{
				$row[] = substr($tmp['article'], 0, 150) . '...'; 
			}

			// set route image
			$row[] = '<img src="' .base_url(). '/assets/img/news/' .$img_loc. '/3x_' .$tmp['hero_img']. '" style="max-width: 4rem;">';

			// convert menjadi tanggal Indonesia
			$date = date_create($tmp['created_at']);
			// function tgl_indonesia ada di helper
			$row[] = tgl_indonesia(date_format($date, 'Y-m-d'));

			$row[] = '<span class="badge rounded-pill bg-primary">' .$this->m_divisi->getAlias($tmp['divisi'])['alias']. '</span>';

			$row[] = $tmp['viewed'];

			//kolom untuk button
			$row[] = '<a href="/Admin/Berita/edit_article?id='.$tmp['id'].'" class="btn btn-icon icon-left btn-primary m-1" style="min-width: 5rem"><i class="fas fa-pen"></i>Edit</a><button class="btn btn-icon icon-left btn-danger hapusArtikel m-1"  data-title="' .$tmp['title']. '" data-id="' .$tmp['id']. '" type="button" style="min-width: 5rem"><i class="fas fa-times"></i>Hapus</button>';
			
			$data[] = $row;
			$no++;
		}
		
		$table['output']['data'] = $data;

		echo json_encode($table['output']);
		exit();
	}

	public function write(){
		$this->data['title'] 	= 'Write';
		$this->data['divisi'] 	= $this->m_divisi->findAll();
		
		return view('v_server/berita/write', $this->data);
	}

	public function write_article(){
		$title = $this->request->getVar('title');

		//validation 
		if(!$this->validate([
			'title' => [
				'rules'  => 'required|is_unique[post.title]',
				'errors' => [
					'required'  => 'Berita belum memiliki judul',
					'is_unique' => 'Berita dengan judul <b>'.$title.'</b> sudah ada',				
				]
			],
			'hero_img' => [
				'rules'  => 'uploaded[hero_img]|mime_in[hero_img, image/jpg,image/jpeg,image/png]|is_image[hero_img]|max_size[hero_img, 4096]',
				'errors' => [
					'uploaded' => 'Foto utama belum di upload.',
					'mime_in'  => 'Format foto yang diizinkan adalah .jpg, .jpeg dan .png.',
					'is_image' => 'File yang diupload bukan gambar.',
					'max_size' => 'Ukuran maksimum foto adalah 4mb.',
				]
			],
			'article' => [ //FIXME ckeditor whitespace (&nbsp;) pass validation
				'rules'  => 'required',
				'errors' => [
					'required' => 'Berita tidak memiliki artikel.'
				]
			],
			'divisi' => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'Divisi belum dipilih'
				]
			],
		])) {
			return redirect()->back()->withInput();
		}
		
		//membuat slug dari title
		$slug = url_title($title, '-', true);
		
		//request file gambar yang diupload
		$hero_img = $this->request->getFile('hero_img');
		$date 	  = $this->request->getVar('publish_date');
		
		if($date == ''){
			$date = date('Y-m-d');
		}

		$nama_img = $this->uploadProccessing($date, $slug, $hero_img);

		//handling whitespace untuk article
		$article = str_replace("&nbsp;", '', $this->request->getVar('article'));
		$divisi = $this->request->getVar('divisi');

		//process input data
		$this->m_post->save([
			'title' => $title,
			'slug' => $slug,
			'hero_img' => $nama_img,
			//dilakukan trim lagi untuk memastikan tidak ada spasi
			'article' => trim($article),
			'divisi' => $divisi,
			'created_at' => $date
		]);
		
		//pesan yang ditampilkan apabila input success
		session()->setFlashdata('pesan', 'Berita <b>'.$title.'</b> telah diterbitkan.');
		
		return redirect()->to('/Admin/Berita');
	}

	public function preview_article(){
		$title = $this->request->getVar('title');
		
		//validation
		if(!$this->validate([
			'title' => [
				'rules'  => 'required|is_unique[post.title]',
				'errors' => [
					'required'  => 'Berita belum memiliki judul',
					'is_unique' => 'Berita dengan judul <b>'.$title.'</b> sudah ada',				
				]
			],
			'hero_img' => [
				'rules'  => 'uploaded[hero_img]|mime_in[hero_img, image/jpg,image/jpeg,image/png]|is_image[hero_img]|max_size[hero_img, 4096]',
				'errors' => [
					'uploaded' => 'Foto utama belum di upload.',
					'mime_in'  => 'Format foto yang diizinkan adalah .jpg, .jpeg dan .png.',
					'is_image' => 'File yang diupload bukan gambar.',
					'max_size' => 'Ukuran maksimum foto adalah 4mb.',
				]
			],
			'article' => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'Berita tidak memiliki artikel.'
				]
			],
			'tag' => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'Berita tidak memiliki tag.'
				]
			],
		])) {
			return redirect()->back()->withInput();
		}

		$this->data['title'] = 'Preview Article';
		
		$tags = $this->request->getVar('tag');
		
		$tag_arr = [];

		for($i=0; $i<count($tags); $i++){
			array_push($tag_arr, $this->tagBerita->getDataById($tags[$i]));
		}
		
		$this->data['tag'] = $tag_arr;
		
		$this->data['post'] = [
            'title' 	 => $title,
			'hero_img'   => $this->request->getVar('preview'),
			'article' 	 => $this->request->getVar('article'),
			'created_at' => date('Y-m-d'),
		];
        
		$this->data['social']  = $this->m_social->findAll();
		$this->data['layanan'] = $this->m_service->findAll();
		$this->data['divisi']  = $this->m_divisi->findAll();
		
		return view('v_server/berita/preview', $this->data);
	}

	public function edit_article(){
		$id = $this->request->getVar('id');

		$this->data['title'] = 'Edit Berita';

		$this->data['post'] 	= $this->m_post->find($id);
		$this->data['divisi'] 	= $this->m_divisi->findAll();

		$this->data['folder'] = getFolderPath($this->data['post']['created_at'], $this->data['post']['slug']);

		return view('v_server/berita/edit', $this->data);
	}

	public function update_article(){
		$id = $this->request->getVar('id');
		$title = $this->request->getVar('title');

		//validation 
		if(!$this->validate([
			'title' => [
				'rules'  => 'required|is_unique[post.title,post.id,'.$id.']',
				'errors' => [
					'required'  => 'Berita belum memiliki judul',
					'is_unique' => 'Berita dengan judul <b>'.$title.'</b> sudah ada',				
				]
			],
			'hero_img' => [
				'rules'  => 'mime_in[hero_img, image/jpg,image/jpeg,image/png]|is_image[hero_img]|max_size[hero_img, 4096]',
				'errors' => [
					'mime_in'  => 'Format foto yang diizinkan adalah .jpg, .jpeg dan .png.',
					'is_image' => 'File yang diupload bukan gambar.',
					'max_size' => 'Ukuran maksimum foto adalah 4mb.',
				]
			],
			'article' => [ //FIXME ckeditor whitespace (&nbsp;) pass validation
				'rules'  => 'required',
				'errors' => [
					'required' => 'Berita tidak memiliki artikel.'
				]
			],
			'divisi' => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'Divisi belum dipilih'
				]
			],
		])) {
			return redirect()->to('/Admin/Berita/edit_article?id='.$id)->withInput();
		}
		
		//request file gambar yang diupload
		$hero_img = $this->request->getFile('hero_img');
		$old_img  = $this->request->getVar('old_img');
		$old_loc  = $this->request->getVar('old_loc');
		
		//membuat slug dari title
		$slug = url_title($title, '-', true);
		
		$name_arr = explode('_', $old_loc);

		if($slug != end($name_arr)){
			array_pop($name_arr);
			array_push($name_arr, $slug);

			$new_loc = implode('_', $name_arr);

			rename($this->dir_berita .$old_loc, $this->dir_berita .$new_loc);

			$old_loc = $new_loc;
		}

		if($hero_img->getError() == 4){
			$nama_img = $old_img;
		} else{
			$nama_img = $this->uploadProccessing($slug, $hero_img, $old_loc, $old_img);
		}

		//handling whitespace untuk article
		$article = str_replace("&nbsp;", '', $this->request->getVar('article'));

		$divisi = $this->request->getVar('divisi');
		
		//process update data 
		$this->m_post->update($id, [
			'title' => $title,
			'slug' => $slug,
			'hero_img' => $nama_img,
			//dilakukan trim lagi untuk memastikan tidak ada spasi
			'article' => trim($article),
			'divisi' => $divisi,
		]);

		//pesan yang ditampilkan apabila input success
		session()->setFlashdata('pesan', 'Berita <b>'.$title.'</b> berhasil di update.');
		
		return redirect()->to('/Admin/Berita');
	}

	public function delete_article($id){
		$data = $this->m_post->find($id);

		//ambil nama folder
		$img_loc = getFolderPath($data['created_at'], $data['slug']);
		
		//path ke folder gambar
		$folder_path = $this->dir_berita .$img_loc;

		$this->truncateDir($folder_path);

		//hapus data dari database
		$this->m_post->delete($id);
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
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
