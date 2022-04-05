<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product_Category;
use App\Helpers\General;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\Facades\Image;
use Ramsey\Uuid\Uuid;

class ProductCategoryController extends AdminController
{
	public function __construct(){
		parent::__construct();
		$this->data['page'] = ['page' => 'Kategori Produk'];

		$this->category_dir = 'img/web/shop/';
	}

    public function index(){
        $this->data['title'] = __('admin/crud.data', $this->data['page']);

		if(request()->ajax()){
            return Datatables::of(Product_Category::query())
					->editColumn('photo', function($item){
						return '<img src="' .asset($this->category_dir .$item['photo']). '" style="width: 5rem;">';
					})
					->addColumn('action', function($item){
						return '<div class="dropdown d-inline">
									<button class="btn btn-warning dropdown-toggle me-1 mb-1" type="button" data-bs-toggle="dropdown">' .__('admin/crud.btn.action'). '</button>
									<div class="dropdown-menu">
										<a type="button" class="dropdown-item has-icon editCategory" data-id="' .$item->id. '">
											<i class="fas fa-pen"></i> ' .__('admin/crud.btn.edit'). '
										</a>
										<a type="button" class="dropdown-item has-icon deleteCategory" data-id="' .$item->id. '" data-category="' .$item->category. '">
											<i class="fas fa-times"></i> ' .__('admin/crud.btn.delete'). '
										</a>
									</div>
								</div>';
					})
					->rawColumns(['photo', 'action'])
					->addIndexColumn()
					->make();
        }

		return view('v_admin.shop.category.data', $this->data);
    }

    public function create(){
        return view('v_admin.shop.category.modal_add', $this->data);
    }

    public function store(Request $request){
        $val = self::validator($request->all());

		if(!empty($val->errors()->messages())){
			$feedback = self::error_feedback($val);
		} else {
			$request['photo'] = Uuid::uuid4().'.'.$request->file('photo')->extension();
			$folderPath = public_path($this->category_dir);

			self::resizeImage($request->file('photo'), $folderPath, $request->input('photo'));

			$request['slug'] = Str::slug($request->category);

			Product_Category::create($request->input());

			$feedback['status'] = __('admin/crud.val_success');
		}

		echo json_encode($feedback);
    }

    public function edit(Request $request){
		$this->data['title'] 	= __('admin/crud.edit', $this->data['page']);
		$this->data['category'] = Product_Category::find($request->id);

		return view('v_admin.shop.category.modal_edit', $this->data);
    }

    public function update(Request $request){
        $val = self::validator($request->all(), $request->id);

		if(!empty($val->errors()->messages())){
			$feedback = self::error_feedback($val);
		} else {
			$request['slug'] = Str::slug($request->category);

			if($request->file('photo')){
				General::clearStorage($this->category_dir . $request->input('old_img'));

				$request['photo'] = Uuid::uuid4().'.'.$request->file('photo')->extension();
				$folderPath = public_path($this->category_dir);

				self::makedir($folderPath);
				self::resizeImage($request->file('photo'), $folderPath, $request->input('photo'));
			}

			$item = Product_Category::findOrFail($request->id);
			$item->fill($request->input())->save();

			$feedback['status'] = __('admin/crud.val_success');
		}

		echo json_encode($feedback);
    }

    public function destroy(Request $request){
		$data = Product_Category::findOrFail($request->id);
		General::clearStorage($this->category_dir . $data['photo']);
		$data->delete();
    }

	private function resizeImage($img, string $folderPath, string $filename){
		self::makedir($folderPath);

		Image::make($img)->resize(700, null, function ($const) {
			$const->aspectRatio();
		})->save($folderPath. '/' .$filename);
	}

    private function validator(array $data, string $id = ''){
        return Validator::make($data, [
			'category'	=> 'required|unique:product__categories' .(($id) ? ',category,'.$id : ''),
            'photo'		=> ($id) ? '' : 'required'.'|image|mimes:jpeg,jpg,png|file|max:4096',
		], [
			'category.required' 	=> __('admin/validation.required.input', ['field' => __('admin/crud.variable.category')]),
			'category.unique' 		=> __('admin/validation.unique.existed', ['field' => __('admin/crud.variable.category')]),
			'photo.required' 		=> __('admin/validation.required.upload', ['field' => __('admin/crud.variable.photo')]),
			'photo.image' 			=> __('admin/validation.image.image', ['field' => __('admin/crud.variable.photo')]),
			'photo.mime' 			=> __('admin/validation.image.mime', ['mime' => '.jpg, .jpeg, .png']),
			'photo.file' 			=> __('admin/validation.image.file'),
			'photo.max' 			=> __('admin/validation.image.max'),
		]);
    }

	private function error_feedback($val){
		$feedback = [
			'status' 	=> __('admin/crud.val_failed'),
			'category' 	=> $val->errors()->first('category') ?? false,
			'photo' 	=> $val->errors()->first('photo') ?? false,
		];

		return $feedback;
	}
}
