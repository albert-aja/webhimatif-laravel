<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class FeatureController extends Controller
{
	private function tahunSelanjutnya(){
		$tahun_kepengurusan = explode(' ', $this->data['tahun_kepengurusan']['tahun']);
		$arr_tahun = explode('/', $tahun_kepengurusan[1]);

		//+1 untuk kedua tahun
		foreach ($arr_tahun as &$at) {
			$at = $at + 1;
		}

		$periode_depan = implode('/', $arr_tahun);

		return $tahun_kepengurusan[0]. ' ' .$periode_depan;
	}

	public function get_status(){
		$this->data['statusWeb'] = $this->m_webInfo->first();

		return view('v_admin/maintenance_status', $this->data);
	}

	//function toggle maintenance
	public function maintenance_switch($status){
		//maintenance status
		//true = maintenance mode
		//false = active mode
		if($status == 'false'){
			$this->m_webInfo->update(1, [
				'status' => 'true',
			]);
		} else if($status == 'true'){
			$this->m_webInfo->update(1, [
				'status' => 'false',
			]);
		}
	}

	public function change_password(){
        $this->data['title'] = 'Ubah Password';
		
		return view('v_admin/profile', $this->data);
	}

	public function insert_new_password(){
		//validation 
		if(!$this->validate([
			'old_pass' => [
				'rules'  => 'required',
				'errors' => [
					'required' => 'Password lama belum diisi.',				
				]
			],
			'new_pass' => [
				'rules'  => 'required|min_length[8]',
				'errors' => [
					'required' 	 => 'Password baru belum diisi.',
					'min_length' => 'Password memiliki panjang minimal 8 karakter',	
				]
			],
			'confirm_pass' => [
				'rules'  => 'required|matches[new_pass]',
				'errors' => [
					'required' => 'Password belum dikonfirmasi',
					'matches'  => 'Password baru tidak cocok',				
				]
			],
		])) {
			return redirect()->back()->withInput();
		}

		$old_data = $this->m_users->oldPassword();

		//cek kecocokan password lama
		if(Password::verify($this->request->getVar('old_pass'), $old_data['password_hash'])){
			$this->m_users->update($old_data['id'], [
				'password_hash' => Password::hash($this->request->getVar('new_pass')),
				'created_at' 	=> date('Y-m-d H:i:s')
			]);

			session()->setFlashdata('pesan', 'Password berhasil diubah');

			return redirect()->back();
		}

		$msg = 'Password tidak cocok dengan password lama.';
		return redirect()->back()->with('msg_t', $msg)->withInput();
	}

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
}
