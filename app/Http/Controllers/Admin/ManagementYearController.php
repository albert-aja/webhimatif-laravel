<?php

namespace App\Http\Controllers\Admin;

use App\Models\Management_Year;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ManagementYearController extends AdminController
{
    public function index(){
        $this->data['title'] = __('admin/crud.data', ['page' => __('admin/crud.variable.year')]);

		return view('v_admin.config.periode', $this->data);
    }

    public function update(Request $request){
        $val = self::validator($request->all());

		if(!empty($val->errors()->messages())){
			$feedback = self::error_feedback($val);
		} else {
			$item = Management_Year::findOrFail($request->id);

			$request['year'] = "Himatif " .$request['year'];
			$item->fill($request->input())->save();

			$feedback['status'] = __('admin/crud.val_success');
		}

		echo json_encode($feedback);
    }

    private function validator(array $data){
        return Validator::make($data, [
			'year' => 'required',
		], [
			'year.required' => __('admin/validation.required.input', ['field' => __('admin/crud.variable.year')]),
		]);
    }

	private function error_feedback($val){
		return [
			'status' 	=> __('admin/crud.val_failed'),
			'year' 		=> $val->errors()->first('year') ?? false,
		];
	}
}
