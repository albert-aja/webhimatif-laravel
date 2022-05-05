<?php 

namespace App\Helpers;

use App\Helpers\General;
use App\Models\User;

use Illuminate\Support\Facades\Mail;
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
}
?>