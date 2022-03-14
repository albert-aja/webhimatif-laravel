<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    
	public function generateResetHash()
	{
		$this->attributes['reset_hash'] = bin2hex(random_bytes(16));
		$this->attributes['reset_expires'] = date('Y-m-d H:i:s', time() + config('Auth')->resetTime);

		return $this;
	}
}
