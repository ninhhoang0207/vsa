<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Auth;

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
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->redirectTo = route('system');
        $this->middleware('guest');
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:2|confirmed',
        ],
        [
        'email.unique' =>"email đã tồn tại.",
        'password.min' =>"mật khẩu phải ít nhất 6 ký tự.",
        'password.confirmed' =>"mật khẩu không trùng khớp."
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'role'      =>  'collaborator',
            'password'  => bcrypt($data['password']),
            'is_active' =>  1,
        ]);
    }

    protected function quickRegister(Request $request) {
        $validator = Validator::make($request->all(), array(
            'name'                  =>  'required',
            'email'                 =>  'email|required|unique:users',
            'password'              =>  'min:6|required',
            'password_confirmation' =>  'min:6|required|same:password'
            ));

        if ($validator->fails()) {
            $notification = $validator->errors()->all();
            return array($notification,-1);
        } else {
            try {
                $user = User::create(array(
                'email'     =>  $request->email,
                'password'  =>  bcrypt($request->password),
                'name'      =>  $request->name,
                'role'      =>  'user',
                'is_active' =>  1,
                ));
                Auth::login($user);
                return [view('includes.homepage.login_model')->render(),1];

            } catch (Exception $e) {
                $notification = 'Register errors';
                return array($notification, 1);
            }
        }
    }
}
