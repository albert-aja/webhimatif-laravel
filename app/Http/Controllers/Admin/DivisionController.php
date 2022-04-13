<?php

namespace App\Http\Controllers\Admin;

use App\Models\Division;
use App\Helpers\General;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class DivisionController extends AdminController
{
	public function __construct(){
		parent::__construct();
		$this->data['page'] = ['page' => 'Divisi'];

		$this->division_dir = 'img/divisi/';
	}

	public function index(){
		$this->data['title'] = __('admin/crud.data', $this->data['page']);

		if(request()->ajax()){
            return Datatables::of(Division::query())
					->addColumn('program', function($item){
						return '<a href="' .route('program-data', $item->slug). '" class="btn btn-primary icon-left">
									<i class="fa fa-info"></i>
								</a>';
					})
					->addColumn('commitee', function($item){
						return '<a href="' .route('commitee-data', $item->slug). '" class="btn btn-info icon-left">
									<i class="fa fa-search"></i>
								</a>';
					})
					->addColumn('action', function($item){
						return '<div class="dropdown d-inline">
									<button class="btn btn-warning dropdown-toggle me-1 mb-1" type="button" data-bs-toggle="dropdown">' .__('admin/crud.btn.action'). '</button>
									<div class="dropdown-menu">
										<a type="button" class="dropdown-item has-icon editDivision" data-id="' .$item->id. '">
											<i class="fas fa-pen"></i> ' .__('admin/crud.btn.edit'). '
										</a>
										<a type="button" class="dropdown-item has-icon deleteDivision" data-title="' .$item->alias. '" data-id="' .$item->id. '">
											<i class="fas fa-times"></i> ' .__('admin/crud.btn.delete'). '
										</a>
									</div>
								</div>';
					})
					->rawColumns(['program', 'commitee', 'action'])
					->addIndexColumn()
					->make();
        }

		return view('v_admin.division.data', $this->data);
	}

    public function create(){
		$this->data['title'] = __('admin/crud.add', $this->data['page']);

		return view('v_admin.division.modal_add', $this->data);
    }

    public function store(Request $request){
        $val = self::validator($request->all());

		if(!empty($val->errors()->messages())){
			$feedback = self::error_feedback($val);
		} else {
			$request['slug'] = Str::slug($request->division);

			Division::create($request->all());

			$feedback['status'] = __('admin/crud.val_success');
		}

		echo json_encode($feedback);
    }

    public function edit(Request $request){
		$this->data['division'] = Division::findOrFail($request->id);
		$this->data['page']['page'] .= ' ' .$this->data['division']['alias'];

        return view('v_admin.division.modal_edit', $this->data);
    }

    public function update(Request $request){
		$val = self::validator($request->all(), $request->id);

		if(!empty($val->errors()->messages())){
			$feedback = self::error_feedback($val);
		} else {
			$item = Division::findOrFail($request->id);

			$request['slug'] = Str::slug($request->division);

			$item->fill($request->all())->save();
			$feedback['status'] = __('admin/crud.val_success');
		}

		echo json_encode($feedback);
    }

    public function destroy(Request $request){
		$data = Division::findOrFail($request->id);
		General::clearStorage($this->division_dir.$data->slug);
        $data->delete();
    }

    private function validator(array $data, string $id = ''){
        return Validator::make($data, [
			'division'	=> 'required|unique:divisions' .(($id) ? ',division,'.$id : ''),
            'alias'		=> 'required|unique:divisions' .(($id) ? ',division,'.$id : ''),
		], [
			'division.required' 	=> __('admin/validation.required.input', ['field' => __('admin/crud.variable.division')]),
			'division.unique' 		=> __('admin/validation.unique.existed', ['field' => __('admin/crud.variable.division')]),
			'alias.required' 		=> __('admin/validation.required.input', ['field' => __('admin/crud.variable.alias')]),
			'alias.unique' 			=> __('admin/validation.unique.used', ['field' => __('admin/crud.variable.alias')]),
		]);
    }

	private function error_feedback($val){
		return [
			'status' 	=> __('admin/crud.val_failed'),
			'division' 	=> $val->errors()->first('division') ?? false,
			'alias' 	=> $val->errors()->first('alias') ?? false,
		];
	}
}
