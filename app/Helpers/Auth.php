<?php 
    
namespace App\Helpers;

use Illuminate\Support\Facades\Mail;
use App\Helpers\General;

use App\Models\User;
use App\Mail\ActivationMail;
use App\Mail\ActiveModeMail;
use App\Mail\MaintenanceTokenMail;

class Auth
{
	public static function send_activation_email(string $email){
		$mailData['subject'] = __('email.auth.subject', ['name' => __('global.name')]);

		$user = User::where('email', $email);

		$mailData['token'] 		= $user->value('activation_hash');
		$mailData['expired'] 	= General::indonesia_date($user->value('activation_expires'), true);

		Mail::to($email)->send(new ActivationMail($mailData));
	}

	public static function send_maintenance_token(string $email, string $token){
		$mailData['subject']	= __('email.modeChange', ['name' => __('global.name')]);
		$mailData['token'] 		= $token;

		Mail::to($email)->send(new MaintenanceTokenMail($mailData));
	}

	public static function send_status_active(string $email){
		$mailData['subject'] = __('email.modeChange', ['name' => __('global.name')]);

		Mail::to($email)->send(new ActiveModeMail($mailData));
	}

	public function email_verification(){
		$temp_id = $this->request->getVar('id');
		$this->data['data_peserta'] = $this->peserta->getByTempID($temp_id);

		if(is_null($this->data['data_peserta'])){
			return redirect()->to('registrasi/tahap_1');
		}

		$this->data['title'] = 'Verifikasi Email';
		
		// $this->data['title'] = 'Verifikasi Email';
		// $this->data['img'] = '/assets/img/web/inbox.jpg';
		// $this->data['desc'] = 'Cek email anda <strong>' .$this->data['data_peserta']['email']. '</strong> dan klik tombol verifikasi untuk memverifikasi email. Jika anda tidak dapat menemukan email verifikasi pada inbox, silahkan cek di spam. Email verifikasi berlaku 3 jam.';
		// $this->data['resend_req'] = 'Tidak menerima email? Klik tombol di bawah untuk mengirim ulang email verifikasi.';
		
		return view('v_email/email_verification', $this->data);
	}

	public function resend_verification($id){
		$dt_peserta = $this->peserta->find($id);

		if($dt_peserta['email_verification'] == 2){
			echo base_url(). '/registrasi/tahap_2?id='.$dt_peserta['temp_id'];
		}

		$data = [
			'verification_hash' => bin2hex(random_bytes(20)),
			'expires_at' 		=> date("Y-m-d H:i:s", strtotime("+" .$this->data['hour_expired']. " hours"))
		];

		$this->peserta->update($id, $data);

		$this->send_email($dt_peserta['temp_id']);
	}

	private function expired(){
		$this->data['title'] = 'Email Verifikasi Sudah Tidak Berlaku';
		$this->data['img'] = '/assets/img/web/expired.jpg';
		$this->data['desc'] = 'Hi, email aktivasi anda tidak berlaku lagi. Email aktivasi hanya berlaku 3 jam dan hanya dapat digunakan sekali.';
		$this->data['resend_req'] = 'Klik tombol di bawah untuk mengirim ulang email verifikasi.';
		
		return view('v_email/expired', $this->data);
	}
	
	public function active(){
		$token = $this->request->getVar('token');
		
		$user = $this->peserta->activate_account($token);
		
		if($user['expires_at'] < date('Y-m-d H:i:s')){
			$this->data['title'] = 'Email Verifikasi Sudah Tidak Berlaku';
			return view('v_email/expired', $this->data);
		}

		$user['verification_hash'] 	= NULL;
		$user['email_verification'] = 2;
		$user['expires_at'] 		= NULL;

		$this->peserta->save($user);

		session()->setFlashdata('pesan', 'Pendaftaran Tahap 1 Telah Diselesaikan');
		return redirect()->to('registrasi/tahap_2?id='.$user['temp_id']);
	}
}
?>