<?php

namespace App\Http\Controllers\HomePage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB,Hash;
use Redirect,Session;
use App\User;
use App\Association;
use Validator;
use Auth;
use Carbon\Carbon;
use App\NewsModel;
use App\CategoryModel;
use Storage;

class CollaboratorController extends Controller
{
    //
	private $news;
	private $news_recent;
	private $news_hot;
	private $categories;
	private $user;

	public function __construct() {
		$this->user = new User;
		$this->news = new NewsModel;
        $this->news_hot = $this->news->getHotNews();//Right content
        $this->news_recent = $this->news->getRecentNews();//Right content
        $category = new CategoryModel;
        $this->categories = $category->getCategoryMenu();
    }

    public function register() {
    	$news_hot = $this->news_hot;
    	$news_recent = $this->news_recent;
    	$categories = $this->categories;
    	return view('collaborator.register',compact(['news_hot','news_recent','categories']));
    }

    public function postRegister(Request $request){
    	$data = $request->all();
    	$validator = Validator::make($data,[
    		'email' => 'required|string|email|max:255|unique:users',
    		'password'  =>'required|confirmed',
    		],[

    		'email.unique' =>"email đã tồn tại.",
    		'email.required' =>"email bị bỏ trống.",
    		'pass.confirmed' => "mật khẩu không trùng khớp."
    		]);
    	if ($validator->fails()) {
            // dd($validator);
    		return Redirect::back()
    		->withErrors($validator)
    		->withInput();
    	}else{
    		$file = isset($data['input_file'])?$data['input_file']:null;
    		$path = 'images/collaborator/';

    		if (isset($file)) {
    			$extension = $file->getClientOriginalExtension();
    			$new_file = time().'.'.$extension;
    			$file->move($path,$new_file);
    		}else $new_file=null;
    		DB::beginTransaction();
    		try {
    			$save = array(
    				'type'      =>1,
    				'fullname'      =>$data['name'],
    				'logo' => $path.$new_file,
    				// 'email_association'=>$data['email_association'],
    				'province' =>$data['province'],
    				'birthday' =>date('Y/m/d ', strtotime($data['birthday'])),
    				'action_status' =>$data['major'],
    				'position' =>$data['position'],
    				'company' =>$data['company'],
    				'hotline' =>$data['hotline'],
    				'train_process' =>$data['train_process'],
    				'action_process' =>$data['action_process'],
    				'info_add' =>$data['info_add'],
    				'created_at'    =>  Carbon::now(),
    				'updated_at'    =>  Carbon::now(),
    				);
    			$email = implode("", $request->only('email'));

    			if (DB::table('associations')->insert($save)) {
    				$id = DB::getPdo()->lastInsertId();
    				DB::table('users')->insert([
    					'assoc_id' =>$id,
    					'name' =>$data['username'],
    					'avatar' => $path.$new_file,
    					'email' =>$email,
    					'role' =>"collaborator",
    					'password'=>Hash::make($data['password']),
    					'phone'     =>$data['phone'],
    					'is_active' => 0,
    					'created_at'    =>  Carbon::now(),
    					'updated_at'    =>  Carbon::now(),
    					]);
    			}

    			DB::commit();

    		} catch (Exception $e) {
    			DB::rollback();
    			if (file_exists($path.$new_file )) 
    				unlink($path.$new_file);
    		}
    		Session::flash('success','Đăng ký thành công! Đang chờ xét duyệt của quản trị viên.');
    		return Redirect::route('homepage.index');
    	}
    }

    public function edit() {
    	$news_hot = $this->news_hot;
    	$news_recent = $this->news_recent;
    	$categories = $this->categories;
    	if (!Auth::check())
    		return Redirect::route('homepage.index');
    	else {
    		$user = Auth::user();
    		$compact = ['user','news_hot','news_recent','categories'];
    		return view('collaborator.edit',compact($compact));
    	}

    	return Redirect::route('homepage.index');
    }

    public function update(Request $request) {
        $data = $request->all();
        dd($data['birthday']);
        $validator = Validator::make($data,[
            'password'  =>'confirmed',
            ],[
            'pass.confirmed' => "mật khẩu không trùng khớp."
            ]);
        if ($validator->fails()) {
            // dd($validator);
            return redirect('members/register/personal')
            ->withErrors($validator)
            ->withInput();
        }else{
            $file = isset($data['input_file'])?$data['input_file']:null;
            $path = 'images/collaborator/';
            $old_avatar = Auth::user()->avatar;

            if (isset($file)) {
               $extension = $file->getClientOriginalExtension();
               $new_file = time().'.'.$extension;
               $file->move($path,$new_file);
            }else $new_file=null;
           DB::beginTransaction();
           try {
            $save = array(
                'type'      =>1,
                'fullname'      =>$data['name'],
                'logo' => $path.$new_file,
                'email_association'=>$data['email_association'],
                'province' =>$data['province'],
                'birthday' =>isset($data['birthday'])?$this->formatDate($data['birthday']):null,
                'action_status' =>$data['major'],
                'position' =>$data['position'],
                'company' =>$data['company'],
                'hotline' =>$data['hotline'],
                'train_process' =>$data['train_process'],
                'action_process' =>$data['action_process'],
                'info_add' =>$data['info_add'],
                'created_at'    =>  Carbon::now(),
                'updated_at'    =>  Carbon::now(),
                );
            $email = implode("", $request->only('email'));
            DB::table('associations')
                ->where('id',Auth::user()->assoc_id)
                ->update($save);
            DB::table('users')
                ->where('id',Auth::user()->id)
                ->update([
                    'name' =>$data['username'],
                    'avatar' => isset($new_file)?$path.$new_file:$old_avatar,
                    'password'=>isset($request->password)?Hash::make($request->password):Auth::user()->password,
                    'phone'     =>$data['phone'],
                    'updated_at'    =>  Carbon::now(),
                    ]);
            
            DB::commit();
            if (file_exists($path.$old_avatar) && $old_avatar != $path.$new_file)
                unlink($path.$old_avatar);
            Session::flash('success','Success');
            return Redirect::back();
        } catch (Exception $e) {
            DB::rollback();
            if (file_exists($path.$new_file )) 
                unlink($path.$new_file);
        }
        Session::flash('success','Success');
        return Redirect::back();
    }
    }
}
