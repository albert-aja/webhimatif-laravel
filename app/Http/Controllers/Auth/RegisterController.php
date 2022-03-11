<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOMEPAGE;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $universityData = file_get_contents('./json/universitas.json');
        $universities = json_decode($universityData, true);

        $urlDataProvinces = file_get_contents('https://arieffadhlan.github.io/api-wilayah-indonesia/api/provinces.json');
        $provinceData = json_decode($urlDataProvinces, true);
        $provinces = [];
        foreach ($provinceData as $province) {
            $provinceId = $province['id'];
            $provinceName = $province['name'];
            if (preg_match('/\s/', $provinceName) === 1) {
                $nameSplit = explode(' ', $provinceName);
                if (strlen($nameSplit[0]) > 0 && strlen($nameSplit[0]) < 4) {
                    $nameSplit[0] = strtoupper($nameSplit[0]);
                    $provinceName = $nameSplit[0] . ' ' . ucwords(strtolower($nameSplit[1]));
                    array_push($provinces, ['id' => $provinceId, 'name' => $provinceName]);
                } else {
                    array_push($provinces, ['id' => $provinceId, 'name' => ucwords(strtolower($provinceName))]);
                }
            } else {
                array_push($provinces, ['id' => $provinceId, 'name' => ucwords(strtolower($provinceName))]);
            }
        }

        return view('auth.register', compact('universities', 'provinces'));
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        if ($request->wantsJson()) {
            return new JsonResponse([], 201);
        } else {
            if ($request->user()->hasVerifiedEmail()) {
                return redirect($this->redirectPath());
            } else {
                return Redirect::route('verification.notice');
            }
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date'],
            'gender' => ['required', 'integer'],
            'universitas' => ['required', 'string'],
            'no_identitas' => ['required', 'string'],
            'provinsi' => ['required', 'string'],
            'kabKota' => ['required', 'string'],
            'alamat' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users'],
            'no_telp' => ['required', 'regex:/^(\+62|62)?[\s-]?0?8[1-9]{1}\d{1}[\s-]?\d{4}[\s-]?\d{2,5}$/'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'gender' => $data['gender'],
            'alamat' => $data['alamat'] . ', ' . $data['kabKota'] . ', ' . $data['provinsi'],
            'email' => $data['email'],
            'no_telp' => $data['no_telp'],
            'tanggal_lahir' => $data['tanggal_lahir'],
            'no_identitas' => $data['no_identitas'],
            'universitas' => $data['universitas'],
            'password' => Hash::make($data['password']),
            'isAdmin' => 0
        ]);
    }
}password_hash($request->input('password'), config('auth.hashAlgorithm'))
