<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Helpers\General;
use App\Models\Division;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class PostController extends AdminController
{
	public function __construct(){
		parent::__construct();
		$this->data['page'] = ['page' => 'Berita'];

		$this->post_dir = 'img/news/';
	}

    public function uploadProccessing($date, $slug, $image, $folder_name = '', $name = ''){
		//generate nama random untuk gambar
		if($name == ''){
			$name = $image->getRandomName();
		}
		
		if($folder_name == ''){
			//buat slug untuk nama folder
			$folder_name = url_title(indonesia_date($date), '-', true) .'_'. $slug;
		}

		//membuat folder apabila belum ada
		if (!file_exists($this->post_dir .$folder_name)) {
			@mkdir($this->post_dir .$folder_name, 0777, true);
		}

		//melakukan resize gambar sebanyak 3 ukuran
		//besar
		\Config\Services::image()
			->withFile($image)
			->resize(1000, 800, true, 'height')
			->save($this->post_dir .$folder_name .'/1x_' .$name);

		//medium
		\Config\Services::image()
			->withFile($image)
			->resize(600, 300, true, 'height')
			->save($this->post_dir .$folder_name .'/2x_' .$name);
		
		//kecil
		\Config\Services::image()
			->withFile($image)
			->resize(200, 100, true, 'height')
			->save($this->post_dir .$folder_name .'/3x_' .$name);
			
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
		$folder = url_title(indonesia_date($date), '-', true) .'_'. $slug .'/img';

		if (!file_exists($this->post_dir .$folder)) {
			@mkdir($this->post_dir .$folder, 0777, true);
		}

		$path = $this->post_dir .$folder .'/2x_' .$name;
		
		\Config\Services::image()
			->withFile($image)
			->resize(1000, 800, true, 'height')
			->save($this->post_dir .$folder .'/1x_' .$name);

		\Config\Services::image()
			->withFile($image)
			->resize(800, 350, true, 'width')
			->save($path);
			
		$functionNumber = $this->request->getVar('CKEditorFuncNum');
		$url = base_url(). '/' .$path;
		$message = '';
		
		echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($functionNumber, '$url', $message)</script>";
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function index(){
		$this->data['title'] = __('admin/crud.data', $this->data['page']);
		
		if(request()->ajax()){
            return Datatables::of(Post::with(['division']))
					->addColumn('action', function($item){
						return '<div class="dropdown d-inline">
									<button class="btn btn-warning dropdown-toggle me-1 mb-1" type="button" data-bs-toggle="dropdown">' .__('admin/crud.btn.action'). '</button>
									<div class="dropdown-menu">
										<a href="' .route('web-article', $item->slug). '" class="dropdown-item has-icon" target="_blank" rel="noopener noreferrer">
											<i class="fas fa-info"></i> ' .__('admin/crud.btn.2post'). '
										</a>
										<a href="' .route('post-edit', $item->id). '" class="dropdown-item has-icon">
											<i class="fas fa-pen"></i> ' .__('admin/crud.btn.edit'). '
										</a>
										<a href="#" class="dropdown-item has-icon deletePost" data-title="' .$item->title. '" data-id="' .$item->id. '">
											<i class="fas fa-times"></i> ' .__('admin/crud.btn.delete'). '
										</a>
									</div>
								</div>';
					})
					->editColumn('article', function($item){
						$max = 100;
						return (strlen($item->article) <= $max) ? $item->article : substr($item->article, 0, $max) . '...';
					})
					->editColumn('hero_image', function($item){
						$img_loc = General::getNewsPhoto($item->created_at, $item['slug']);

						return '<img src="' .asset('img/news/' .$img_loc. '/3x_' .$item->hero_image). '" style="min-height: 6rem"/>';
					})
					->editColumn('division_id', function($item){
						return '<span class="badge rounded-pill bg-primary">' .$item->division->alias. '</span>';
					})
					->editColumn('created_at', function($item){
						return General::indonesia_date($item->created_at);
					})
					->rawColumns(['hero_image', 'article', 'division_id', 'action'])
					->addIndexColumn()
					->make();
        }

		return view('v_admin.post.data', $this->data);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
		$this->data['title'] 		= __('admin/crud.add', $this->data['page']);
		$this->data['divisions'] 	= Division::select('id', 'division')->get();

		return view('v_admin.post.write', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $data = self::validator($request->all())->validate();

        $data['slug'] = Str::slug($request->product_name);

        $this->product::create($data);

        return redirect()->route($this->index_route);
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

    private function validator(array $data){
        return Validator::make($data, [
			'publish_date'	=> 'required|date',
            'title'     	=> 'required|unique:posts',
            'hero_image'  	=> 'required|image|file|max:4096',
            'article'  		=> 'required',
			'division'		=> 'required',
		], [
			'publish_date.required' => __('admin/validation.post.publish_date.required'),
			'publish_date.date' 	=> __('admin/validation.post.publish_date.date'),
			'title.required' 		=> __('admin/validation.post.title.required'),
			'title.unique' 			=> __('admin/validation.post.title.unique'),
			'hero_image.required' 	=> __('admin/validation.post.hero_image.required'),
			'hero_image.image' 		=> __('admin/validation.post.hero_image.image'),
			'hero_image.file' 		=> __('admin/validation.post.hero_image.file'),
			'hero_image.max' 		=> __('admin/validation.post.hero_image.max'),
			'article.required' 		=> __('admin/validation.post.publish_date.required'),
			'division.required' 	=> __('admin/validation.post.division.required'),
		]);
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
		
		return view('v_admin/berita/preview', $this->data);
	}

	public function edit_article(){
		$id = $this->request->getVar('id');

		$this->data['title'] = 'Edit Berita';

		$this->data['post'] 	= $this->m_post->find($id);
		$this->data['divisi'] 	= $this->m_divisi->findAll();

		$this->data['folder'] = getNewsPhoto($this->data['post']['created_at'], $this->data['post']['slug']);

		return view('v_admin/berita/edit', $this->data);
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

			rename($this->post_dir .$old_loc, $this->post_dir .$new_loc);

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
		$img_loc = getNewsPhoto($data['created_at'], $data['slug']);
		
		//path ke folder gambar
		$folder_path = $this->post_dir .$img_loc;

		$this->truncateDir($folder_path);

		//hapus data dari database
		$this->m_post->delete($id);
	}
}
