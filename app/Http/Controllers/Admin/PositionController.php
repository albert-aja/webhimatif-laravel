<?php

namespace App\Http\Controllers\Admin;

use App\Models\Position;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PositionController extends AdminController
{
	public function __construct(){
		parent::__construct();
		$this->data['page'] = ['page' => 'Jabatan'];
	}

	public function getNewPosition(){
		$this->data['position'] = Position::latest()->first();

		return view('v_admin.position.new_data', $this->data);
	}

	public function index(){
		$this->data['title'] = __('admin/crud.data', $this->data['page']);

		if(request()->ajax()){
            return Datatables::of(Position::query())
					->addColumn('action', function($item){
						return '<div class="dropdown d-inline">
									<button class="btn btn-warning dropdown-toggle me-1 mb-1" type="button" data-bs-toggle="dropdown">' .__('admin/crud.btn.action'). '</button>
									<div class="dropdown-menu">
										<a type="button" class="dropdown-item has-icon editPosition" data-id="' .$item->id. '">
											<i class="fas fa-pen"></i> ' .__('admin/crud.btn.edit'). '
										</a>
										<a type="button" class="dropdown-item has-icon deletePosition" data-title="' .$item->position. '" data-id="' .$item->id. '">
											<i class="fas fa-times"></i> ' .__('admin/crud.btn.delete'). '
										</a>
									</div>
								</div>';
					})
					->rawColumns(['action'])
					->addIndexColumn()
					->make();
        }

		return view('v_admin.position.data', $this->data);
	}

    public function create(){
		$this->data['title'] = __('admin/crud.add', $this->data['page']);

		return view('v_admin.position.modal_add', $this->data);
    }

    public function store(Request $request){
        $val = self::validator($request->all());

		if(!empty($val->errors()->messages())){
			$feedback = self::error_feedback($val);
		} else {
			Position::create($request->all());

			$feedback['status'] = __('admin/crud.val_success');
		}

		echo json_encode($feedback);
    }

    public function edit(Request $request){
		$this->data['position'] = Position::findOrFail($request->id);

        return view('v_admin.position.modal_edit', $this->data);
    }

    public function update(Request $request){
		$val = self::validator($request->all(), $request->id);

		if(!empty($val->errors()->messages())){
			$feedback = self::error_feedback($val);
		} else {
			$item = Position::findOrFail($request->id);

			$item->fill($request->all())->save();
			$feedback['status'] = __('admin/crud.val_success');
		}

		echo json_encode($feedback);
    }

    public function destroy(Request $request){
        Position::findOrFail($request->id)->delete();
    }

    private function validator(array $data, string $id = ''){
        return Validator::make($data, [
			'position'		=> 'required|unique:positions' .(($id) ? ',position,'.$id : ''),
		], [
			'position.required' => __('admin/validation.position.required'),
			'position.unique' 	=> __('admin/validation.position.unique'),
		]);
    }

	private function error_feedback($val){
		$feedback = [
			'status' 	=> __('admin/crud.val_failed'),
			'position' 	=> $val->errors()->first('position') ?? false,
		];

		return $feedback;
	}
}
