<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request) {

        $auth = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // User::create([
        //     'name' => 'Budi',
        //     'email' => 'budi123@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('budi'),
        //     'phone' => '08123123131',
        //     'api_token' => str_random(50)
        // ]);

        if(Auth::attempt($auth)) {
            Auth::user()->update(['api_token' => str_random(50)]);
            return response()->json(['status' => 'Success', 'token' => Auth::user()->api_token], 200);
        }else{
            return response()->json(['status' => 'Error'], 401);
        }

    }

    public function register(Request $request) {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'api_token' => str_random(50)
        ]);

        // $token = User::where('email', $request->email)->first();

        return response()->json([
            'message' => 'Success',
            'token' => User::where('email', $request->email)->first()->api_token
        ], 200);
    }
}