<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->redirectTo = route('system');
        $this->middleware('guest')->except('logout');
    }

    public function quickLogin(Request $request) {
        $user = new User;
        $data = array(
            'email'     =>  $request->email,
            'password'  =>  $request->password
            );
        $error_login = null;
        if (!$user->where('password',bcrypt($request->password))->first()) {
            $error_login = 'Password không hợp lệ';
        }
        if (!$user->where('email',$request->email)->first()) {
            $error_login = 'Emai không tồn tại';
        }
        if ($this->attemptLogin($request))
            return [view('includes.homepage.login_model')->render(),1];

        return [view('includes.homepage.login_model')->render(),$error_login];
    }

    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            array(
                'email'     =>  $request->email,
                'password'  =>  $request->password,
                'is_active'  =>  1,
                ), $request->has('remember')
        );
    }
}
