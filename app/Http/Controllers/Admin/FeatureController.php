<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Auth;
use App\Models\Maintenance_Info;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Artisan;

class FeatureController extends AdminController
{
	private function tahunSelanjutnya(){
		$periode = explode(' ', $this->data['periode']['year']);
		$tahun_kepengurusan = explode('/', $periode[1]);

		foreach ($tahun_kepengurusan as &$at) {
			$at = $at + 1;
		}

		return $periode[0]. ' ' .implode('/', $tahun_kepengurusan);
	}

	public function get_status(){
		$this->data['is_maintenance'] = (Maintenance_Info::first()->is_maintenance) ? true : false;

		return view('v_admin.webInfo', $this->data);
	}

	private function toggle_mode(){
		Maintenance_Info::where('id', 1)->update([
			'is_maintenance' => (Maintenance_Info::first()->is_maintenance) ? false : true,
		]);
	}

	public function maintenance_mode(){
		$secret = bin2hex(random_bytes(16));
		$emails = User::select('email')->get();

		foreach($emails as $email){
			Auth::send_maintenance_token($email->email, $secret);			
		}

		Artisan::call('down --refresh=10 --secret="' .$secret. '"');
		self::toggle_mode();

		return redirect('/' .$secret);
	}

	public function active_mode(){
		$emails = User::select('email')->get();

		foreach($emails as $email){
			Auth::send_status_active($email->email);			
		}

		self::toggle_mode();

		Artisan::call('up');
	}

	// public function change_password(){
	// 	$this->data['title'] = __('admin/global.change.pw');

    //     return view('v_admin.changePassword', $this->data);
	// }

	// public function edit_password(Request $request){
	// 	$val = self::validator($request->all());

	// 	if(!empty($val->errors()->messages())){
	// 		$feedback = self::error_feedback($val);
	// 	} else {
	// 		User::findOrFail($request->id)->update(['password' => password_hash($request->password, config('auth.hashAlgorithm'))]);

	// 		$feedback['status'] = __('admin/crud.val_success');
	// 	}

	// 	echo json_encode($feedback);
	// }

	public function fresh_start(){
        $this->data['title'] = 'Ganti Kepengurusan';

		//ambil tahun kepengurusan baru
		$this->data['tahun_kepengurusan_baru'] = $this->tahunSelanjutnya();
		
		//table yang dapat dihapus opsional (HARD CODED)
		$optional_tbl = [
			'divisi', 'jabatan', 'misi',
			'visi', 'post', 'sejarah',
			'social'
		];

		for($i=0;$i<count($this->data['table_data']);$i++){
			$this->data['table'][$i]['table'] = $this->data['table_data'][$i];

			//checked untuk table yang 'pasti' di hapus
			if(in_array($this->data['table_data'][$i], $optional_tbl)){
				$this->data['table'][$i]['checked'] = false;
			} else {
				$this->data['table'][$i]['checked'] = true;
			}
		}

		return view('v_admin/freshStart', $this->data);
	}

	public function regression(){
		//ubah ke maintenance mode
		$this->m_webInfo->update(1, [
			'status' => 'true',
		]);

		//ubah tahun kepengurusan
		$this->tahun->update(1, [
			'tahun' => $this->tahunSelanjutnya()
		]);

		//hapus data tabel
		$table_arr = $this->request->getVar('table');
		
		//truncate tabel
		foreach($table_arr as $ta){
			$this->db->table($ta)->truncate();
		}

		//function untuk menghapus direktori dan seluruh isinya
		foreach($this->gbr as $g){
			if(in_array($table_arr, $g)){
				$this->truncateDir($g[1]);
			}
		}
	}

    private function validator(array $data){
        return Validator::make($data, [
			'password'					=> 'required|min:' .config('auth.minimumPasswordLength'). '|confirmed',
            'password_confirmation'		=> 'required',
		], [
			'password.required' 				=> __('admin/validation.required.input', ['field' => __('admin/crud.variable.new_pw')]),
			'password.confimed' 				=> 'Password tidak cocok',
			'password_confirmation.required' 	=> __('admin/validation.required.input', ['field' => __('admin/crud.variable.confirm_new_pw')]),
		]);
    }

	private function error_feedback($val){
		return [
			'status' 				=> __('admin/crud.val_failed'),
			'password' 				=> $val->errors()->first('password') ?? false,
			'password_confirmation' => $val->errors()->first('password_confirmation') ?? false,
		];
	}
}
