<?php

namespace App\Http\Controllers\Admin;

use App\Models\Division;
use App\Models\Work_Program;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WorkProgramController extends AdminController
{
	public function __construct(){
		parent::__construct();
		$this->data['page'] = ['page' => 'Progja'];
	}

	private function prepare_data($slug){
		$this->division = Division::where('slug', '=', $slug)->first();
		
		$this->data['page']['page'] .= ' ' .$this->division->alias;
		$this->data['slug'] = $slug;
	}

	public function index($slug){
		self::prepare_data($slug);

		$this->data['title'] = __('admin/crud.data', $this->data['page']);
		$query = Work_Program::with(['division'])->whereDivisionId($this->division->id);

		if(request()->ajax()){
            return Datatables::of($query)
					->addColumn('action', function($item){
						return '<div class="dropdown d-inline">
									<button class="btn btn-warning dropdown-toggle me-1 mb-1" type="button" data-bs-toggle="dropdown">' .__('admin/crud.btn.action'). '</button>
									<div class="dropdown-menu">
										<a type="button" class="dropdown-item has-icon editProgram" data-id="' .$item->id. '">
											<i class="fas fa-pen"></i> ' .__('admin/crud.btn.edit'). '
										</a>
										<a type="button" class="dropdown-item has-icon deleteProgram" data-id="' .$item->id. '" data-program="' .$item->program. '">
											<i class="fas fa-times"></i> ' .__('admin/crud.btn.delete'). '
										</a>
									</div>
								</div>';
					})
					->rawColumns(['action'])
					->addIndexColumn()
					->make();
        }

		return view('v_admin.program.data', $this->data);
	}

    public function create($slug){
		self::prepare_data($slug);
		return view('v_admin.program.modal_add', $this->data);
    }

    public function store(Request $request, $slug){
        $val = self::validator($request->all());

		if(!empty($val->errors()->messages())){
			$feedback = self::error_feedback($val);
		} else {
			$request['division_id'] = Division::where('slug', '=', $slug)->first()['id'];

			Work_Program::create($request->input());

			$feedback['status'] 	= __('admin/crud.val_success');
			$feedback['redirect']	= route('program-data', $slug);
		}

		echo json_encode($feedback);
    }

    public function edit(Request $request, $slug){
		self::prepare_data($slug);

		$this->data['program'] = Work_Program::findOrFail($request->id);

		return view('v_admin.program.modal_edit', $this->data);
    }

    public function update(Request $request, $slug){
        $val = self::validator($request->all(), $request->id);

		if(!empty($val->errors()->messages())){
			$feedback = self::error_feedback($val);
		} else {
			$item = Work_Program::findOrFail($request->id);

			$item->fill($request->input())->save();

			$feedback['status'] 	= __('admin/crud.val_success');
			$feedback['redirect']	= route('program-data', $slug);
		}

		echo json_encode($feedback);
    }

    public function destroy(Request $request){
		Work_Program::findOrFail($request->id)->delete();
    }

    private function validator(array $data, string $id = ''){
        return Validator::make($data, [
			'program'		=> 'required|unique:work__programs' .(($id) ? ',program,'.$id : ''),
            'description'	=> 'required',
		], [
			'program.required' 		=> __('admin/validation.required.input', ['field' => __('admin/crud.variable.program')]),
			'program.unique' 		=> __('admin/validation.unique.existed', ['field' => __('admin/crud.variable.program')]),
			'description.required' 	=> __('admin/validation.required.input', ['field' => __('admin/crud.variable.description')]),
		]);
    }

	private function error_feedback($val){
		$feedback = [
			'status' 		=> __('admin/crud.val_failed'),
			'program' 		=> $val->errors()->first('program') ?? false,
			'description' 	=> $val->errors()->first('description') ?? false,
		];

		return $feedback;
	}
}
