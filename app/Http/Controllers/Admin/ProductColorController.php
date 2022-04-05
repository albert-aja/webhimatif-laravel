<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product_Color;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ProductColorController extends AdminController
{
	public function __construct(){
		parent::__construct();
		$this->data['page'] = ['page' => 'Warna Produk'];
	}

	public function index(){
		$this->data['title'] = __('admin/crud.data', $this->data['page']);

		if(request()->ajax()){
            return Datatables::of(Product_Color::query())
					->editColumn('hex_code', function($item){
						return '<div style="background:'.$item['hex_code'].';" class="social-color" data-bs-toggle="tooltip" data-bs-placement="top" title=' .$item['hex_code']. '></div>';
					})
					->addColumn('action', function($item){
						return '<div class="dropdown d-inline">
									<button class="btn btn-warning dropdown-toggle me-1 mb-1" type="button" data-bs-toggle="dropdown">' .__('admin/crud.btn.action'). '</button>
									<div class="dropdown-menu">
										<a type="button" class="dropdown-item has-icon editColor" data-id="' .$item->id. '">
											<i class="fas fa-pen"></i> ' .__('admin/crud.btn.edit'). '
										</a>
										<a type="button" class="dropdown-item has-icon deleteColor" data-id="' .$item->id. '" data-color="' .$item->color. '">
											<i class="fas fa-times"></i> ' .__('admin/crud.btn.delete'). '
										</a>
									</div>
								</div>';
					})
					->rawColumns(['hex_code', 'action'])
					->addIndexColumn()
					->make();
        }

		return view('v_admin.shop.color.data', $this->data);
	}

    public function create(){
        return view('v_admin.shop.color.modal_add', $this->data);
    }

    public function store(Request $request){
		self::checkHex($request);

        $val = self::validator($request->all());

		if(!empty($val->errors()->messages())){
			$feedback = self::error_feedback($val);
		} else {
			Product_Color::create($request->input());

			$feedback['status'] = __('admin/crud.val_success');
		}

		echo json_encode($feedback);
    }

    public function edit(Request $request){
		$this->data['color'] = Product_Color::findOrFail($request->id);

		return view('v_admin.shop.color.modal_edit', $this->data);
    }

    public function update(Request $request){
		self::checkHex($request);

        $val = self::validator($request->all());

		if(!empty($val->errors()->messages())){
			$feedback = self::error_feedback($val);
		} else {
			$item = Product_Color::findOrFail($request->id);

			$item->fill($request->all())->save();

			$feedback['status'] 	= __('admin/crud.val_success');
		}

		echo json_encode($feedback);
    }

    public function destroy(Request $request){
		Product_Color::findOrFail($request->id)->delete();
    }

	private function checkHex($request){
		if($request->input('hex_code')){
			if(substr($request->input('hex_code'),0,1) != '#'){
				return $request->merge([
					'hex_code' => '#' .$request->input('hex_code')
				]);
			}
		}
	}

    private function validator(array $data, string $id = ''){
        return Validator::make($data, [
			'color'		=> 'required|unique:product__colors' .(($id) ? ',color,'.$id : ''),
            'hex_code'	=> 'required|regex:/^#(?:[0-9a-fA-F]{3}){1,2}$/|unique:product__colors' .(($id) ? ',hex_code,'.$id : ''),
		], [
			'color.required' 	=> __('admin/validation.required.input', ['field' => __('admin/crud.variable.color')]),
			'color.unique' 		=> __('admin/validation.unique.existed', ['field' => __('admin/crud.variable.color')]),
			'hex_code.required' => __('admin/validation.required.input', ['field' => __('admin/crud.variable.hex')]),
			'hex_code.regex' 	=> __('admin/validation.regex.hex'),
			'hex_code.unique' 	=> __('admin/validation.unique.existed', ['field' => __('admin/crud.variable.hex')]),
		]);
    }

	private function error_feedback($val){
		$feedback = [
			'status' 		=> __('admin/crud.val_failed'),
			'color' 		=> $val->errors()->first('color') ?? false,
			'hex_code' 		=> $val->errors()->first('hex_code') ?? false,
		];

		return $feedback;
	}
}
