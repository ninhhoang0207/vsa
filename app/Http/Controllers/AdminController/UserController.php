<?php

namespace App\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB,Hash;
use  Carbon\Carbon;
use Redirect;
use Session,Input;
use Validator;
use Lang;
use Yajra\Datatables\Facades\Datatables;
use App\User;
class UserController extends Controller
{
    //
    public function admin_index(){
    	return view('admin.users.create');
    }
    public function add(Request $request)
    {
    	$data= $request->all();
    	$email = implode("", $request->only('email'));
    	DB::beginTransaction();
    	try {
    		$save = array(
    			'name'      =>$data['title'],
    			'email'		=>$email,
    			'password'	=>Hash::make($data['password']),
    			'phone'		=>$data['phone'],
    			'address'	=>$data['address'],
    			'role'		=>$data['role'],
    			'created_at'	=>	Carbon::now(),
				'updated_at'	=>	Carbon::now(),
    			);
    		DB::table( 'users')->insert($save);
    		DB::commit();
    		
    	} catch (Exception $e) {
    		DB::rollback();
    	}
    	Session::flash('success','Success');

    	return Redirect::back(); 

    }
    public function check_email()
    {
    	if(!empty($_POST["email"])) {
    		$connection = mysqli_connect('localhost', 'root', '', 'seaculture_association');
    		$result = mysqli_query($connection,"SELECT count(*) FROM users WHERE email='" . $_POST["email"] . "'");
    		$row = mysqli_fetch_row($result);
    		$user_count = $row[0];
    		if($user_count>0) {
    			echo '<span id="email_result" style="color:red;font-size:17px;font-weight: 600" > Email đã tồn tại</span>';
    		}
    	}
    }
    public function list_users()
    {
    	return view('admin.users.list');
    }
    public function get_user_data(){
           $users = User::select(['id', 'name', 'email', 'role','created_at'])
                ->where('is_active',1)
                ->whereIn('role',['user','collaborator','admin']);
           return Datatables::of($users)
           ->editColumn('created_at', function ($user) {
            return $user->created_at->format('d/m/Y H:i');
        })
           ->filterColumn('created_at', function ($query, $keyword) {
            $query->whereRaw("DATE_FORMAT(created_at,'%Y/%m/%d %H:%i') like ?", ["%$keyword%"]);
        })
           ->make(true);
    }
    public function get_detail(Request $request){
        $id = $request->id;
        if(isset($id)){
            $data = User::where('id',$id)->get(['id','name','created_at'])->first();
            $data['created_at'] = isset($data['created_at'])?User::where('id',$data['created_at'])->first():null;

            return $data;
        }
    }
    public function delete($id){
        DB::beginTransaction();
        try {
             $user = User::where('id',$id)->first();
            if(!is_null($user)){
                 $user->delete();
            }
             DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return 0;
        }
        return 1;
    }
    public function edit($id){
        $user = User::where('id',$id)->select('name','avatar','email','phone','role','address')->first();
        return view('admin.users.edit',compact('user',$user));

    }
    public function update(Request $request,$id){

        $old_user = User::where('id',$id)->first();
        $validator = Validator::make($request->all(),
            [
                'password'      =>  'nullable|confirmed',
            ]);

        if ($validator->fails()) {
            Session::flash('error',Lang::get('general.wrong_password_confirm'));
            return Redirect::back();
        }

        if (isset($request->old_password) && !Hash::check($request->old_password,$old_user->password)) {
            Session::flash('error',Lang::get('general.wrong_password_old'));
            return Redirect::back();
        }

        $old_password = $request->old_password;
        $new_password = $request->pass;
        $password_confirmation = $request->password_confirmation;

        $data = $request->all();
        $file = isset($data['file'])?$data['file']:null;
        $current_file_name = isset($old_user)?$old_user['avatar']:null;
        $path = "images/users/";

        if(isset($file)){
            $filename = $id.'_'.time();
            $extension = $file->getClientOriginalExtension();
            $new_file = $filename.'.'.$extension;
            $file->move($path,$new_file);
            $data['avatar'] = $path.$new_file;

        }else $new_file =null;

        $data['name'] = $data['title'];
        // $data['password'] = Hash::make($data['password']);
        if ($data['password']) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
       
        unset($data['title']);
        unset($data['file']);
        unset($data['_token']);
        unset($data['email']);
        unset($data['old_password']);
        unset($data['password_confirmation']);
        DB::beginTransaction();
        try {
           User::where('id',$id)->update($data);
            DB::commit();
            if(file_exists($path.$current_file_name) && $new_file != null && ($old_user['avatar'] != "images/users/".$new_file)) {
                unlink($path.$current_file_name);
            }
        Session::flash('success','Success');
        } catch (Exception $e) {
            DB::rollback();
            if (file_exists($path.$new_file )) {
                unlink($path.$new_file);
                $data['avatar'] = $old_user['avatar'];
            }
            Session::flash('error',"Error");
        }
         return Redirect::back();

    }

}
