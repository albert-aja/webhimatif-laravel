<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Helpers\Auth;
use App\Models\Social_Media;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function __construct(){
        $this->middleware('guest');
        $this->middleware('allowRegis');
    }

    public function index(){
        return view('auth.register', ['title' => __('auth.register.registerTitle')]);
    }

    public function attemptRegister(Request $request){
        self::validator($request->all())->validate();
        self::create($request->all());

        $email = $request->input('email');

        Auth::send_activation_email($email, __('email.auth.subject', ['name' => __('global.name')]));

        return redirect()->route('auth-verify')->with(['email' => $email]);
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'email'     => 'required|string|email:rfc,dns|max:255|unique:users',
            'username'  => 'required|string|max:255|unique:users',
            'password'  => 'required|string|min:' .config('auth.minimumPasswordLength'). '|confirmed',
        ]);
    }

    protected function create(array $data){
        return User::create([
            'username'  => $data['username'],
            'email'     => $data['email'],
            'password'  => password_hash($data['password'], config('auth.hashAlgorithm')),
            'activation_hash' => bin2hex(random_bytes(16)),
            'activation_expires' => date('Y-m-d H:i:s', time() + config('auth.expiredTime')),
        ]);
    }
}
