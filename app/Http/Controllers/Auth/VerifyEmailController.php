<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    public function __construct(){
        $this->middleware('guest');
    }

    public function index(){
        if(!session()->get('email')){
            return redirect()->route('auth-login');
        }

        $this->data['title'] = __('auth.verify.verifyTitle');
        $this->data['email'] = session()->get('email');

        return view('auth.verify_email', $this->data);
    }

    public function attemptActivation($token){  
        $this->user = User::where('activation_hash', $token)->first();

        $this->user->update([
            'email_verified_at' => date('Y-m-d H:i:s'),
            'activation_hash'   => NULL,
			'activation_status' => 1,
            'activation_expires'=> NULL,
		]);

        Auth::login($this->user);

        return redirect()->route('admin-dashboard');
    }

    public function resendEmail($email){
        Auth::send_mail($email, __('email.subject', ['name' => __('email.name')]));
    }
}