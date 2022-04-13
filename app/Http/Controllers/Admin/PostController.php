<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Helpers\General;
use App\Models\Division;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;
use Yajra\DataTables\Facades\DataTables;

class PostController extends AdminController
{
	public function __construct(){
		parent::__construct();
		$this->data['page'] = ['page' => 'Berita'];

		$this->hero_img_dir 	= 'img/news/hero_image/';
	}

    public function uploadHeroImage($image){
		$filename = Uuid::uuid4().'.'.$image->extension();

		self::makedir($this->hero_img_dir);
		self::saveResized([800, 300, 100], $image, $this->hero_img_dir, $filename);

		return $filename;
	}

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
						return '<img src="' .asset($this->hero_img_dir. '3x_' .$item->hero_image). '" style="min-height: 6rem"/>';
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

    public function create(){
		$this->data['title'] 		= __('admin/crud.add', $this->data['page']);
		$this->data['divisions'] 	= Division::select('id', 'division')->get();

		return view('v_admin.post.write', $this->data);
    }

    public function store(Request $request){
        $val = self::validator($request->all());

        if(!empty($val->errors()->messages())){
			$feedback = self::error_feedback($val);
		} else {
			$request['hero_image'] = self::uploadHeroImage($request->file('hero_image'));

			$request['slug'] = Str::slug($request->title);

			Post::create($request->input());

			$feedback['status'] 	= __('admin/crud.val_success');
			$feedback['redirect']	= route('post-data');
		}

		echo json_encode($feedback);
    }

    public function edit(Request $request){
		$this->data['title'] 		= __('admin/crud.edit', $this->data['page']);
		$this->data['post'] 		= Post::where('id', $request->id)->first();
		$this->data['divisions'] 	= Division::select('id', 'division')->get();

		return view('v_admin.post.write', $this->data);
    }

    public function update(Request $request){
        
    }

    public function destroy(Request $request){
		$data = Post::findOrFail($request->id);
		// General::clearStorage(self::shop_image($data->product_category->slug, $data['slug'], $data['photo']));
		$data->delete();
    }

    private function validator(array $data){
        return Validator::make($data, [
			'created_at'	=> 'required|date',
            'title'     	=> 'required|unique:posts',
            'hero_image'  	=> 'required|image|file|max:4096',
            'article'  		=> 'required',
			'division_id'		=> 'required',
		], [
			'created_at.required' 	=> __('admin/validation.post.publish_date.required'),
			'created_at.date' 		=> __('admin/validation.post.publish_date.date'),
			'title.required' 		=> __('admin/validation.post.title.required'),
			'title.unique' 			=> __('admin/validation.post.title.unique'),
			'hero_image.required' 	=> __('admin/validation.post.hero_image.required'),
			'hero_image.image' 		=> __('admin/validation.post.hero_image.image'),
			'hero_image.file' 		=> __('admin/validation.post.hero_image.file'),
			'hero_image.max' 		=> __('admin/validation.post.hero_image.max'),
			'article.required' 		=> __('admin/validation.post.article.required'),
			'division_id.required' 	=> __('admin/validation.post.division.required'),
		]);
    }

	private function error_feedback($val){
		return [
			'status' 		=> __('admin/crud.val_failed'),
			'created_at' 	=> $val->errors()->first('created_at') ?? false,
			'title' 		=> $val->errors()->first('title') ?? false,
			'hero_image' 	=> $val->errors()->first('hero_image') ?? false,
			'article' 		=> $val->errors()->first('article') ?? false,
			'division' 		=> $val->errors()->first('division_id') ?? false,
		];
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
