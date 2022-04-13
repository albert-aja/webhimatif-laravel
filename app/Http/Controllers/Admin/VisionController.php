<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vision;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class VisionController extends AdminController
{
    public function index(){
        $this->data['title']    = __('admin/crud.data', ['page' => __('admin/crud.variable.vision')]);
        $this->data['vision']   = Vision::first();

		return view('v_admin.config.vision', $this->data);
    }

    public function update(Request $request){
        $val = self::validator($request->all());

		if(!empty($val->errors()->messages())){
			$feedback = self::error_feedback($val);
		} else {
			$item = Vision::findOrFail($request->id);

			$item->fill($request->input())->save();

			$feedback['status'] = __('admin/crud.val_success');
		}

		echo json_encode($feedback);
    }

    private function validator(array $data){
        return Validator::make($data, [
			'vision' => 'required',
		], [
			'vision.required' => __('admin/validation.required.input', ['field' => __('admin/crud.variable.vision')]),
		]);
    }

	private function error_feedback($val){
		return [
			'status' 	=> __('admin/crud.val_failed'),
			'vision' 	=> $val->errors()->first('vision') ?? false,
		];
	}
}
