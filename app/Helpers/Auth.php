<?php 
    
namespace App\Helpers;

use App\Mail\Mailer;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class Auth
{
    /**
     * Generates a secure hash to use for password reset purposes,
     * saves it to the instance.
     *
     * @return $this
     * @throws \Exception
     */
	public function generateResetHash(){
		$this->attributes['reset_hash']     = bin2hex(random_bytes(16));
		$this->attributes['reset_expires']  = date('Y-m-d H:i:s', time() + config('auth.expiredTime'));

		return $this;
	}

    /**
     * Generates a secure random hash to use for account activation.
     *
     * @return $this
     * @throws \Exception
     */
    public function generateActivationHash(){
        $this->attributes['activation_hash']    = bin2hex(random_bytes(16));
		$this->attributes['activation_expires'] = date('Y-m-d H:i:s', time() + config('auth.expiredTime'));

		return $this;
    }

    /**
     * Activate user.
     *
     * @return $this
     */
    protected function activate(){
        $this->attributes['activation_status']  = 1;
        $this->attributes['activation_hash']    = null;
        $this->attributes['activation_expires'] = null;

        return $this;
    }

    public static function send_mail(string $email, string $subject){
		$mailData['subject'] = $subject;

		$user = User::where('email', $email);

		$mailData['token'] 		= $user->value('activation_hash');
		$mailData['expired'] 	= General::indonesia_date($user->value('activation_expires'), true);

        Mail::to($email)->send(new Mailer($mailData));
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