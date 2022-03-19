<?php

namespace App\Http\Controllers\Admin;

use App\Models\Division;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class DivisionController extends AdminController
{
	public function __construct(){
		parent::__construct();
		$this->data['page'] = ['page' => 'Divisi'];
	}

	public function index(){
		$this->data['title'] = __('admin/crud.data', $this->data['page']);
		
		if(request()->ajax()){
            return Datatables::of(Division::query())
					->addColumn('program', function($item){
						return '<a href="' .route('workprogram-data', $item->slug). '" class="btn btn-primary icon-left">
									<i class="fa fa-info"></i> ' .__('admin/crud.btn.check'). ' ' .__('admin/crud.variable.program'). '
								</a>';
					})
					->addColumn('commitee', function($item){
						return '<a href="' .route('commitee-data', $item->slug). '" class="btn btn-info icon-left">
									<i class="fa fa-info"></i> ' .__('admin/crud.btn.check'). ' ' .__('admin/crud.variable.commitee'). '
								</a>';
					})
					->addColumn('action', function($item){
						return '<div class="dropdown d-inline">
									<button class="btn btn-warning dropdown-toggle me-1 mb-1" type="button" data-bs-toggle="dropdown">' .__('admin/crud.btn.action'). '</button>
									<div class="dropdown-menu">
										<a href="#" class="dropdown-item has-icon editDivision" data-id="' .$item->id. '">
											<i class="fas fa-pen"></i> ' .__('admin/crud.btn.edit'). '
										</a>
										<a href="#" class="dropdown-item has-icon deleteDivision" data-title="' .$item->alias. '" data-id="' .$item->id. '">
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
        $val = self::validator($request->input());

		if(!empty($val->errors()->messages())){
			$feedback['status'] 	= __('admin/crud.val_failed');
			$feedback['division'] 	= $val->errors()->first('division') ?? false;
			$feedback['alias'] 		= $val->errors()->first('alias') ?? false;
		} else {
			$request['slug'] = Str::slug($request->division);

			Division::create($request->input());

			$feedback['status'] = __('admin/crud.val_success');
		}

		echo json_encode($feedback);
    }

    public function edit($id){
		$this->data['division'] = Division::findOrFail($id);
        $this->data['title'] 	= __('admin/crud.edit', array_merge($this->data['page'], ['name' => $this->data['division']->division]));

        return view('v_admin.division.modal_edit', $this->data);
    }

    public function update(Request $request){
		$val = self::validator($request->input(), $request->id);

		if(!empty($val->errors()->messages())){
			$feedback['status'] 	= __('admin/crud.val_failed');
			$feedback['division'] 	= $val->errors()->first('division') ?? false;
			$feedback['alias'] 		= $val->errors()->first('alias') ?? false;
		} else {
			$item = Division::findOrFail($request->id);

			$request['slug'] = Str::slug($request->division);

			$item->fill($request->input())->save();
			$feedback['status'] = __('admin/crud.val_success');
		}

		echo json_encode($feedback);
    }

    public function destroy(Request $request){
        Division::findOrFail($request->id)->delete();
    }

    private function validator(array $data, string $id = ''){
        return Validator::make($data, [
			'division'		=> 'required|unique:divisions' .(($id) ? ',division,'.$id : ''),
            'alias'     	=> 'required|unique:divisions' .(($id) ? ',division,'.$id : ''),
		], [
			'division.required' 	=> __('admin/validation.division.division.required'),
			'division.unique' 		=> __('admin/validation.division.division.unique'),
			'alias.required' 		=> __('admin/validation.division.alias.required'),
			'alias.unique' 			=> __('admin/validation.division.alias.unique'),
		]);
    }

	public function pengurus(){
		$slug = $this->request->getVar('divisi');

		$this->data['divisi'] = $this->m_divisi->getDataBySlug($slug);

		$this->data['title'] = 'Pengurus ' .$this->data['divisi']['alias'];
		
		return view('v_admin/pengurus/data', $this->data);
	}

	public function progja(){
		$slug = $this->request->getVar('divisi');
		
		$this->data['divisi'] = $this->m_divisi->getDataBySlug($slug);
		
		$this->data['title'] = 'Program Kerja ' .$this->data['divisi']['alias'];
		
		return view('v_admin/progja/data', $this->data);
	}
}
