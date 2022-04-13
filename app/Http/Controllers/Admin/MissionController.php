<?php

namespace App\Http\Controllers\Admin;

use App\Models\Mission;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class MissionController extends AdminController
{
	public function __construct(){
		parent::__construct();
		$this->data['page'] = ['page' => __('admin/crud.variable.mission')];
	}

	public function index(){
		$this->data['title'] = __('admin/crud.data', $this->data['page']);

		if(request()->ajax()){
            return Datatables::of(Mission::query())
					->addColumn('action', function($item){
						return '<div class="dropdown d-inline">
									<button class="btn btn-warning dropdown-toggle me-1 mb-1" type="button" data-bs-toggle="dropdown">' .__('admin/crud.btn.action'). '</button>
									<div class="dropdown-menu">
										<a type="button" class="dropdown-item has-icon editMission" data-id="' .$item->id. '">
											<i class="fas fa-pen"></i> ' .__('admin/crud.btn.edit'). '
										</a>
										<a type="button" class="dropdown-item has-icon deleteMission" data-title="' .$item->mission. '" data-id="' .$item->id. '">
											<i class="fas fa-times"></i> ' .__('admin/crud.btn.delete'). '
										</a>
									</div>
								</div>';
					})
					->rawColumns(['action'])
					->addIndexColumn()
					->make();
        }

		return view('v_admin.config.mission.data', $this->data);
	}

    public function create(){
		$this->data['title'] = __('admin/crud.add', $this->data['page']);

		return view('v_admin.config.mission.modal_add', $this->data);
    }

    public function store(Request $request){
        $val = self::validator($request->all());

		if(!empty($val->errors()->messages())){
			$feedback = self::error_feedback($val);
		} else {
			Mission::create($request->all());

			$feedback['status'] = __('admin/crud.val_success');
		}

		echo json_encode($feedback);
    }

    public function edit(Request $request){
		$this->data['mission'] = Mission::findOrFail($request->id);

        return view('v_admin.config.mission.modal_edit', $this->data);
    }

    public function update(Request $request){
		$val = self::validator($request->all(), $request->id);

		if(!empty($val->errors()->messages())){
			$feedback = self::error_feedback($val);
		} else {
			$item = Mission::findOrFail($request->id);

			$item->fill($request->all())->save();
			$feedback['status'] = __('admin/crud.val_success');
		}

		echo json_encode($feedback);
    }

    public function destroy(Request $request){
        Mission::findOrFail($request->id)->delete();
    }

    private function validator(array $data, string $id = ''){
        return Validator::make($data, [
			'mission'		=> 'required|unique:missions' .(($id) ? ',mission,'.$id : ''),
		], [
			'mission.required' => __('admin/validation.mission.required'),
			'mission.unique' 	=> __('admin/validation.mission.unique'),
		]);
    }

	private function error_feedback($val){
		$feedback = [
			'status' 	=> __('admin/crud.val_failed'),
			'mission' 	=> $val->errors()->first('mission') ?? false,
		];

		return $feedback;
	}
}
