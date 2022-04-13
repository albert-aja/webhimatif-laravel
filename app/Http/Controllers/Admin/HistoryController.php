<?php

namespace App\Http\Controllers\Admin;

use App\Models\History;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class HistoryController extends AdminController
{
    public function index(){
        $this->data['title']    = __('admin/crud.data', ['page' => __('admin/crud.variable.history')]);
        $this->data['history']  = History::first();

		return view('v_admin.config.history', $this->data);
    }

    public function update(Request $request){
        $val = self::validator($request->all());

		if(!empty($val->errors()->messages())){
			$feedback = self::error_feedback($val);
		} else {
			$item = History::findOrFail($request->id);

			$item->fill($request->input())->save();

			$feedback['status'] = __('admin/crud.val_success');
		}

		echo json_encode($feedback);
    }

    private function validator(array $data){
        return Validator::make($data, [
			'history' => 'required',
		], [
			'history.required' => __('admin/validation.required.input', ['field' => __('admin/crud.variable.history')]),
		]);
    }

	private function error_feedback($val){
		return [
			'status' 	=> __('admin/crud.val_failed'),
			'history' 	=> $val->errors()->first('history') ?? false,
		];
	}
}
