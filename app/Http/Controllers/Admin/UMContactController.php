<?php

namespace App\Http\Controllers\Admin;

use App\Models\UM_Contact;
use App\Helpers\Icon;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class UMContactController extends AdminController
{
	public function __construct(){
		parent::__construct();
		$this->data['page'] = ['page' => 'Kontak UM'];
	}

	private function prepare_iconArray($data, $current = ''){
        $existed_icons = $data->pluck('icon');
        $icon_arr = Icon::icon_array();

		foreach($existed_icons as $icon){
			if($key = array_search($icon, array_column($icon_arr, 'icon'))){
				unset($icon_arr[$key]);
			}
		}

		if($current){
			array_push($icon_arr, [
				'name' => $current->social, 
				'icon' => $current->icon
			]);
		}

		return $icon_arr;
	}

    public function index(){
        $this->data['title'] = __('admin/crud.data', $this->data['page']);

		if(request()->ajax()){
            return Datatables::of(UM_Contact::query())
					->editColumn('link', function($item){
						return '<a href="' .$item->link. '" target="_blank" rel="noopener noreferrer">' .$item->social. '</a>';
					})
					->editColumn('icon', function($item){
						return '<i class="' .$item->icon. '" style="font-size: 2.5rem;"></i>';
					})
					->editColumn('color', function($item){
						return '<div style="background:'.$item->color.';" class="social-color" data-bs-toggle="tooltip" data-bs-placement="top" title=' .$item->color. '></div>';
					})
					->addColumn('action', function($item){
						return '<div class="dropdown d-inline">
									<button class="btn btn-warning dropdown-toggle me-1 mb-1" type="button" data-bs-toggle="dropdown">' .__('admin/crud.btn.action'). '</button>
									<div class="dropdown-menu">
										<a type="button" class="dropdown-item has-icon editContact" data-id="' .$item->id. '">
											<i class="fas fa-pen"></i> ' .__('admin/crud.btn.edit'). '
										</a>
										<a type="button" class="dropdown-item has-icon deleteContact" data-id="' .$item->id. '" data-social="' .$item->social. '">
											<i class="fas fa-times"></i> ' .__('admin/crud.btn.delete'). '
										</a>
									</div>
								</div>';
					})
					->rawColumns(['link', 'icon', 'color', 'action'])
					->addIndexColumn()
					->make();
        }

		return view('v_admin.shop.contact.data', $this->data);
    }

	public function create(){
		$this->data['title']   = __('admin/crud.add', $this->data['page']);
        $this->data['existed'] = UM_Contact::all();
        $this->data['icon_arr'] = self::prepare_iconArray($this->data['existed']);

		return view('v_admin.shop.contact.modal_add', $this->data);
	}

    public function store(Request $request){
		self::checkHex($request);
        $val = self::validator($request->all());

		if(!empty($val->errors()->messages())){
			$feedback = self::error_feedback($val);
		} else {
			UM_Contact::create($request->all());

			$feedback['status'] = __('admin/crud.val_success');
		}

		echo json_encode($feedback);
    }

	public function edit(Request $request){
		$this->data['title']   = __('admin/crud.edit', $this->data['page']);
        $this->data['existed'] = UM_Contact::all()->except($request->id);
        $this->data['contact'] = UM_Contact::where('id', '=', $request->id)->first();
        $this->data['icon_arr'] = self::prepare_iconArray($this->data['existed'], $this->data['contact']);

		return view('v_admin.shop.contact.modal_edit', $this->data);
	}

	public function update(Request $request){
		self::checkHex($request);

        $val = self::validator($request->all());

		if(!empty($val->errors()->messages())){
			$feedback = self::error_feedback($val);
		} else {
			$item = UM_Contact::findOrFail($request->id);

			$item->fill($request->all())->save();

			$feedback['status'] 	= __('admin/crud.val_success');
		}

		echo json_encode($feedback);
	}

    public function destroy(Request $request){
		UM_Contact::findOrFail($request->id)->delete();
    }

	private function checkHex($request){
		if($request->input('color')){
			if(substr($request->input('color'),0,1) != '#'){
				return $request->merge([
					'color' => '#' .$request->input('color')
				]);
			}
		}
	}

    private function validator(array $data, string $id = ''){
        return Validator::make($data, [
			'social'	=> 'required|unique:u_m__contacts' .(($id) ? ',social,'.$id : ''),
			'link'		=> 'required|active_url|url',
            'icon'		=> 'required',
            'color'		=> 'required',
		], [
			'social.required' 	=> __('admin/validation.required.input', ['field' => __('admin/crud.variable.social_media')]),
			'social.unique' 	=> __('admin/validation.unique.existed', ['field' => __('admin/crud.variable.social_media')]),
			'link.required' 	=> __('admin/validation.required.input', ['field' => __('admin/crud.variable.link')]),
			'link.active_url' 	=> __('admin/validation.url'),
			'link.url' 			=> __('admin/validation.url'),
			'icon.required' 	=> __('admin/validation.required.input', ['field' => __('admin/crud.variable.icon')]),
			'color.required' 	=> __('admin/validation.required.input', ['field' => __('admin/crud.variable.color')]),
		]);
    }

	private function error_feedback($val){
		$feedback = [
			'status' => __('admin/crud.val_failed'),
			'social' => $val->errors()->first('social') ?? false,
			'link' 	 => $val->errors()->first('link') ?? false,
			'icon' 	 => $val->errors()->first('icon') ?? false,
			'color'  => $val->errors()->first('color') ?? false,
		];

		return $feedback;
	}
}
