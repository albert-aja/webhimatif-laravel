<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ServiceController extends AdminController
{
	public function __construct(){
		parent::__construct();
		$this->data['page'] = ['page' => __('admin/crud.variable.service')];
	}

	public function index(){
		$this->data['title'] = __('admin/crud.data', $this->data['page']);

		if(request()->ajax()){
            return Datatables::of(Service::query())
                    ->editColumn('link', function($item){
                        return '<a href="' .$item->link. '" target="_blank" rel="noopener noreferrer">Link</a>';
                    })
					->addColumn('action', function($item){
						return '<div class="dropdown d-inline">
									<button class="btn btn-warning dropdown-toggle me-1 mb-1" type="button" data-bs-toggle="dropdown">' .__('admin/crud.btn.action'). '</button>
									<div class="dropdown-menu">
										<a type="button" class="dropdown-item has-icon editService" data-id="' .$item->id. '">
											<i class="fas fa-pen"></i> ' .__('admin/crud.btn.edit'). '
										</a>
										<a type="button" class="dropdown-item has-icon deleteService" data-title="' .$item->service. '" data-id="' .$item->id. '">
											<i class="fas fa-times"></i> ' .__('admin/crud.btn.delete'). '
										</a>
									</div>
								</div>';
					})
					->rawColumns(['link', 'action'])
					->addIndexColumn()
					->make();
        }

		return view('v_admin.config.service.data', $this->data);
	}

    public function create(){
		$this->data['title'] = __('admin/crud.add', $this->data['page']);

		return view('v_admin.config.service.modal_add', $this->data);
    }

    public function store(Request $request){
        $val = self::validator($request->all());

		if(!empty($val->errors()->messages())){
			$feedback = self::error_feedback($val);
		} else {
			Service::create($request->all());

			$feedback['status'] = __('admin/crud.val_success');
		}

		echo json_encode($feedback);
    }

    public function edit(Request $request){
		$this->data['service'] = Service::findOrFail($request->id);

        return view('v_admin.config.service.modal_edit', $this->data);
    }

    public function update(Request $request){
		$val = self::validator($request->all(), $request->id);

		if(!empty($val->errors()->messages())){
			$feedback = self::error_feedback($val);
		} else {
			$item = Service::findOrFail($request->id);

			$item->fill($request->all())->save();
			$feedback['status'] = __('admin/crud.val_success');
		}

		echo json_encode($feedback);
    }

    public function destroy(Request $request){
        Service::findOrFail($request->id)->delete();
    }

    private function validator(array $data, string $id = ''){
        return Validator::make($data, [
			'service'	=> 'required|unique:services' .(($id) ? ',service,'.$id : ''),
			'link'		=> 'required|active_url|url',
		], [
			'service.required'	=> __('admin/validation.required.input', ['field' => __('admin/crud.variable.service')]),
			'service.unique' 	=> __('admin/validation.unique.existed'),
			'link.required' 	=> __('admin/validation.required.input', ['field' => __('admin/crud.variable.link')]),
			'link.active_url' 	=> __('admin/validation.url'),
			'link.url' 			=> __('admin/validation.url'),
		]);
    }

	private function error_feedback($val){
		$feedback = [
			'status' 	=> __('admin/crud.val_failed'),
			'service' 	=> $val->errors()->first('service') ?? false,                        
			'link' 	 => $val->errors()->first('link') ?? false,
		];

		return $feedback;
	}
}
