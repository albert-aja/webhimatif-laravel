<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article_Image;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Yajra\DataTables\Facades\DataTables;

class ArticleImageController extends AdminController
{
	public function __construct(){
		parent::__construct();
		$this->data['page'] = ['page' => 'Foto Artikel'];

		//HARD-CODED
		$this->article_img_dir 	= 'img/news/article_image/';
	}

	public function uploadArticleImage(Request $request){
		$image = $request->file('upload');

		$filename = Uuid::uuid4().'.'.$image->extension();

		self::makedir($this->article_img_dir);

		$statement = DB::select("SHOW TABLE STATUS LIKE 'posts'");
		$nextId = $statement[0]->Auto_increment;

		self::saveResized([800, 350], $image, $this->article_img_dir, $filename, $nextId);

		$functionNumber = $request->input('CKEditorFuncNum');
		$url = asset($this->article_img_dir .'2x_' .$filename);
		$url1 = asset($this->article_img_dir .'1x_' .$filename);
		// $url = [asset($this->article_img_dir .'1x_' .$filename), asset($this->article_img_dir .'2x_' .$filename)];
		$message = '';

		echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($functionNumber, ['$url', '$url1'], $message)</script>";
		// echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($functionNumber, '$url', $message)</script>";
	}

	public function index(){
		$this->data['title'] = __('admin/crud.data', $this->data['page']);

		if(request()->ajax()){
            return Datatables::of(Article_Image::with(['article']))
					->addColumn('title', function($item){
						return $item->article->title;
					})
					->editColumn('photo', function($item){
						return '<img src="' .asset($this->article_img_dir . $item->photo). '" style="height: 6rem"/>';
					})
					->rawColumns(['photo'])
					->addIndexColumn()
					->make();
        }

		return view('v_admin.post.article.data', $this->data);
	}
}