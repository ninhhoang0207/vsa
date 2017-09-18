<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Redirect;
use Session;

class SocialiteController extends Controller
{
    //
	use AuthenticatesUsers;
    //
	/**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
	public function redirectToProvider($provider)
	{
		return Socialite::driver($provider)->redirect();
	}

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
    	try {
    		$user = Socialite::driver($provider)->user();
            $check = User::where('email',$user->email)->first();
    		if (!$check) {
    			$new_user = array(
    				'name'		=>	$user->name,
    				'email'		=>	$user->email,
    				'password'	=>	bcrypt($user->id),
    				'role'		=>	'user',
                    'is_active' =>  1,
    				);
    			User::create($new_user);
            }
            $login = $this->attemptSignin(['email'=>$user->email,'password'=>$user->id]);
            if ($login) 
                Session::flash('success','Đăng nhập thành công.');
            else 
                Session::flash('error','Lỗi đăng nhập. Bạn không thể đăng nhập bằng tài khoàn này');
    		return Redirect::route('homepage.index');
    	}
    	catch (Exception $e) {
            throw new $e;
            
    	}
        // $user->token;
    }

    public function attemptSignin($data) {
    	return $this->guard()->attempt(array(
    		'email'     => $data['email'],
    		'password'  => $data['password'],
    		),false);
    }
 }
