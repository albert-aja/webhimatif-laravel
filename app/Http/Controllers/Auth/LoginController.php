<?php

namespace App\Http\Controllers\Auth;

use App\Providers\RouteServiceProvider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOMEPAGE;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('guest')->except('logout');
    }

    public function index(){
        return view('auth.login', ['title' => 'Login']);
    }

    public function attemptLogin(Request $request){
        self::validator($request->all())->validate();

        $login = $request->input('login');
		$password = $request->input('password');

        $type = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if(!Auth::attempt([$type => $login, 'password' => self::prepare_password($password)])){
            return back()->withInput()->with('errorMsg', __('auth.login.badAttempt'));
        };

        $request->session()->regenerate();

        return redirect()->intended('/Admin/Dashboard');
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    protected function validator(array $data){
        $rules = [
			'login'	=> 'required',
			'password' => 'required',
		];

        if(config('auth.valid_fields') == ['email']){
			$rules['login'] .= '|email:rfc,dns';
		}

        return Validator::make($data, $rules);
    }

    protected function prepare_password($password){
        return base64_encode(hash('sha384', $password, true));
    }
}
