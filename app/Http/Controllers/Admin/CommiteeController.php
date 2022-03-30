<?php

namespace App\Http\Controllers\Admin;

use App\Models\Commitee;
use App\Models\Division;
use App\Models\Position;
use App\Helpers\General;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use Ramsey\Uuid\Uuid;

class CommiteeController extends AdminController
{
	public function __construct(){
		parent::__construct();
		$this->data['page'] = ['page' => 'Pengurus'];
	}

	private function prepare_image(string $img, string $extension, string $slug){
		$image_array_1 = explode(";", $img);
		$image_array_2 = explode(",", $image_array_1[1]);

		$data = base64_decode($image_array_2[1]);
		$img_binary = imagecreatefromstring($data);
		$background = imagecolorallocate($img_binary , 0, 0, 0);

        imagecolortransparent($img_binary, $background);
        imagealphablending($img_binary, false);
        imagesavealpha($img_binary, true);

		$filename = Uuid::uuid4().'.'.$extension;
        $folderPath = public_path($this->division_dir.$slug. '/' .$filename);

		self::makedir($folderPath);

		imagepng($img_binary, $folderPath. '/' .$filename, 9);

		$resize = [600, 200, 80];

		self::saveResized($resize, $folderPath. '/' .$filename, $folderPath, $filename);

		return $filename;
	}

	private function prepare_data($slug){
		$this->division = Division::where('slug', '=', $slug)->first();

		$this->data['page']['page'] .= ' ' .$this->division->alias;
		$this->data['slug'] = $slug;
	}

	public function index($slug){
		self::prepare_data($slug);
		$this->data['title'] = __('admin/crud.data', $this->data['page']);

		$query = Commitee::with(['division', 'position'])->whereDivisionId($this->division->id);

		if(request()->ajax()){
            return Datatables::of($query)
					->addColumn('action', function($item){
						return '<div class="dropdown d-inline">
									<button class="btn btn-warning dropdown-toggle me-1 mb-1" type="button" data-bs-toggle="dropdown">' .__('admin/crud.btn.action'). '</button>
									<div class="dropdown-menu">
										<a href="' .route('commitee-edit', ['division' => $item->division->slug, 'commitee'=> $item->id]). '" class="dropdown-item has-icon">
											<i class="fas fa-pen"></i> ' .__('admin/crud.btn.edit'). '
										</a>
										<a type="button" class="dropdown-item has-icon deleteCommitee" data-url="' .asset(General::getCommiteePhoto($item->division->slug, $item->photo, '2x_')). '" data-id="' .$item->id. '" data-name="' .$item->name. '">
											<i class="fas fa-times"></i> ' .__('admin/crud.btn.delete'). '
										</a>
									</div>
								</div>';
					})
					->editColumn('position', function($item){
						return '<span class="badge rounded-pill bg-primary">' .$item->position->position. '</span>';
					})
					->editColumn('photo', function($item){
						return '<img src="' .asset(General::getCommiteePhoto($item->division->slug, $item->photo, '3x_')). '" style="min-height: 6rem"/>';
					})
					->rawColumns(['photo', 'position', 'action'])
					->addIndexColumn()
					->make();
        }

		return view('v_admin.commitee.data', $this->data);
    }

    public function create($slug){
		self::prepare_data($slug);

		$this->data['title'] 		= __('admin/crud.add', $this->data['page']);
		$this->data['positions'] 	= Position::all();

        return view('v_admin.commitee.add', $this->data);
    }

    public function store(Request $request, $slug){
		$val = self::validator($request->all());

		if(!empty($val->errors()->messages())){
			$feedback = self::error_feedback($val);
		} else {
			$request['photo'] = self::prepare_image(
									$request->input('cropped'),
									$request->file('photo')->extension(),
									$slug
								);

			$request['division_id'] = Division::where('slug', '=', $slug)->first()['id'];

			Commitee::create($request->input());

			$feedback['status'] 	= __('admin/crud.val_success');
			$feedback['redirect']	= route('commitee-data', $slug);
		}

		echo json_encode($feedback);
    }

    public function edit($slug, $id){
		self::prepare_data($slug);

		$this->data['title'] 	 = __('admin/crud.edit', array_merge($this->data['page'], ['name' => '']));
		$this->data['commitee']  = Commitee::find($id);
		$this->data['positions'] = Position::all();

        return view('v_admin.commitee.edit', $this->data);
    }

    public function update(Request $request, $slug, $id){
        $val = self::validator($request->all(), $id);

		if(!empty($val->errors()->messages())){
			$feedback = self::error_feedback($val);
		} else {
			if($request->file('photo')){
				$request['photo'] = self::prepare_image(
										$request->input('cropped'),
										$request->file('photo')->extension(),
										$slug
									);

				General::clearStorage($this->division_dir.$slug. '/' .$request->input('old_img'));
			}

			$item = Commitee::findOrFail($id);

			$item->fill($request->input())->save();

			$feedback['status'] 	= __('admin/crud.val_success');
			$feedback['redirect']	= route('commitee-data', $slug);
		}

		echo json_encode($feedback);
    }

    public function destroy(Request $request){
		$data = Commitee::findOrFail($request->id);
		General::clearStorage($this->division_dir.$request->slug. '/' .$data['photo']);
		$data->delete();
    }

    private function validator(array $data, string $id = ''){
        return Validator::make($data, [
			'name'			=> 'required',
            'photo'  		=> ($id) ? '' : 'required'.'|image|mimes:jpeg,jpg,png|file|max:5120',
            'position_id'  	=> 'required|exists:positions,id',
		], [
			'name.required' 		=> __('admin/validation.required.input', ['field' => __('admin/crud.variable.name')]),
			'photo.required' 		=> __('admin/validation.required.upload', ['field' => __('admin/crud.variable.photo')]),
			'photo.image' 			=> __('admin/validation.image.image', ['field' => __('admin/crud.variable.photo')]),
			'photo.mime' 			=> __('admin/validation.image.mime', ['mime' => '.jpg, .jpeg, .png']),
			'photo.file' 			=> __('admin/validation.image.file'),
			'photo.max' 			=> __('admin/validation.image.max'),
			'position_id.required' 	=> __('admin/validation.required.select', ['field' => __('admin/crud.variable.position')]),
			'position_id.exists' 	=> __('admin/validation.exists'),
		]);
    }

	private function error_feedback($val){
		$feedback = [
			'status' 		=> __('admin/crud.val_failed'),
			'name' 			=> $val->errors()->first('name') ?? false,
			'photo' 		=> $val->errors()->first('photo') ?? false,
			'position_id' 	=> $val->errors()->first('position_id') ?? false,
		];

		return $feedback;
	}
}
