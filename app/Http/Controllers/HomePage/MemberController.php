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
class MemberController extends Controller
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

    public function index() {
        $news_hot = $this->news_hot;
        $news_recent = $this->news_recent;
        $categories = $this->categories;
        return view('member.register_index',compact(['news_hot','news_recent','categories']));
    }

    public function registerMember(){
        $news_hot = $this->news_hot;
        $news_recent = $this->news_recent;
        $categories = $this->categories;
    	return view('member.registerPersonal',compact(['news_hot','news_recent','categories']));
    }
    public function registerAssociation(){
        $news_hot = $this->news_hot;
        $news_recent = $this->news_recent;
        $categories = $this->categories;
        return view('member.registerSecondMember',compact(['news_hot','news_recent','categories']));
    }
    public function postRegisterMember(Request $request){
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
            return redirect('members/register/personal')
                        ->withErrors($validator)
                        ->withInput();
        }else{
            $file = isset($data['input_file'])?$data['input_file']:null;
            $path = 'images/association/personal/';

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
                    'role' =>"member_personal",
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
             Session::flash('success','Success');
             return Redirect::route('homepage.index');
        }
    }
    public function postRegisterAssociation(Request $request){
        $data = $request->all();
        $validator = Validator::make($data,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            ],[
            'email.unique' =>"email đã tồn tại.",
            'email.required' =>"email bị bỏ trống."
            ]);
        if ($validator->fails()) {
            return redirect('members/register/association')
                        ->withErrors($validator)
                        ->withInput();
        }else{
            $file = isset($data['file'])?$data['file']:null;
             $file_item = isset($data['file_item'])?$data['file_item']:null;
            $path = 'images/association/company/';
            if (isset($file_item)) {
                 $extension = $file_item->getClientOriginalExtension();
                $new_avatar = uniqid().'.'.$extension;
                $file_item->move($path,$new_avatar);
            }else $new_avatar=null;

            if (isset($file)) {
                 $extension = $file->getClientOriginalExtension();
                $new_file = time().'.'.$extension;
                $file->move($path,$new_file);
            }else $new_file=null;
            DB::beginTransaction();
            try {
                $save = array(
                        'type'      =>2,
                        'fullname'      =>$data['name'],
                        'email_association' =>  $data['email_association'],
                        'bussiness_name' =>$data['bussiness_name'],
                        'logo'           =>$path.$new_file,
                        'province' =>$data['province'],
                        'action_status' =>$data['action_status'],
                        'hotline' =>$data['hotline'],
                        'fax'       =>$data['fax'],
                        'site'      =>$data['site'],
                        'code'      =>$data['code'],
                        'product'   =>$data['product'],
                        'info_add'  =>$data['info_add'],
                        'created_at'    =>  Carbon::now(),
                        'updated_at'    =>  Carbon::now(),
                    );
                $email = implode("", $request->only('email'));
                
                if (DB::table('associations')->insert($save)) {
                    $id = DB::getPdo()->lastInsertId();
                    DB::table('users')->insert([
                    'assoc_id' =>$id,
                    'name' =>$data['username'],
                    'avatar' => $path.$new_avatar,
                    'email' =>$email,
                    'role' =>"member_association",
                    'password'=>Hash::make($data['password']),
                    'address' =>$data['address'],
                    'is_active' =>  0,
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
             Session::flash('success','Success');
             return Redirect::route('homepage.index');
        }
    }
    public function list_personal(){
        $personal = $this->user->personalAssociation();
        $news_hot = $this->news_hot;
        $news_recent = $this->news_recent;
        $categories = $this->categories;
        return view('member.listPersonal',compact(['personal','news_hot','news_recent','categories']));
    }

    public function detail_personal($id){
        $news_hot = $this->news_hot;
        $news_recent = $this->news_recent;
        $categories = $this->categories;
        $user = User::where('id',$id)->where('is_active',1)->get()->first();
        if (count($user) == 0){
            Session::flash('Lỗi! Không tìm thấy dữ liệu');
            return Redirect::back();   
        }
        $detail = $user->association()->first();
        return view('member.detailPersonal')->with([
                'user'=>$user,
                'detail' =>$detail,
                'news_hot'  =>  $news_hot,
                'news_recent'   =>  $news_recent,
                'categories'    =>  $categories,
            ]);
    }

    public function list_association(){
        $news_hot = $this->news_hot;
        $news_recent = $this->news_recent;
        $categories = $this->categories;
        $detail = Association::where('type',2)->get();
        return view('member.listAssociation',compact(['detail','news_hot','news_recent','categories']));
    }
    public function detail_association($id){
        $news_hot = $this->news_hot;
        $news_recent = $this->news_recent;
        $categories = $this->categories;
        $detail = Association::where('type',2)->where('id',$id)->first();
        $user = User::where('assoc_id',$id)->get(['email','phone','avatar','address'])->first();
        return view('member.detailAssociation')->with([
                'user'=>$user,
                'detail' =>$detail,
                'news_hot'  =>  $news_hot,
                'news_recent'   =>  $news_recent,
                'categories'    =>  $categories,
            ]);
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
            if ($user->role == 'member_personal')
                return view('member.edit_personal',compact($compact));
            if ($user->role == 'member_association')
                return view('member.edit_association',compact($compact));
            if ($user->role == 'collaborator')
                return view('collaborator.edit',compact($compact));
        }

        return Redirect::route('homepage.index');
    }

    public function update(Request $request) {
        $data = $request->all();
        $validator = Validator::make($data,[
            'name' => 'required|string|max:255',
            ]);
        if (!Auth::check()){
            return Redirect::route('homepage.index');
        }
        if ($validator->fails()) {
            return Redirect::back()
            ->withErrors($validator)
            ->withInput();
        }

        if (Auth::user()->role == 'member_personal') 
            $this->edit_personal($request);

        if (Auth::user()->role == 'member_association')
            $this->edit_association($request);

        if (Auth::user()->role == 'collaborator')
            $this->edit_collaborator($request);

        Session::flash('success','Success');
        return Redirect::back();
    }

    public function edit_association(Request $request) {
        $data = $request->all();
        $validator = Validator::make($data,[
            'name' => 'required|string|max:255',
            ]);

        if (!Auth::check())
            return Redirect::route('homepage.index');

        if ($validator->fails()) {
            return Redirect::back()
            ->withErrors($validator)
            ->withInput();
        }
            $file = isset($data['file'])?$data['file']:null;
            $file_item = isset($data['file_item'])?$data['file_item']:null;
            $path = '/images/association/company/';
            $old_avatar = Auth::user()->avatar;
            $old_logo = Auth::user()->association()->first()->logo;
            $new_logo = null;
            $new_avatar = null;
            if (isset($file_item)) {
               $extension = $file_item->getClientOriginalExtension();
               $new_avatar = uniqid().'.'.$extension;
               $file_item->move($path,$new_avatar);
           }else $file_item=null;

           if (isset($file)) {
               $extension = $file->getClientOriginalExtension();
               $new_logo = time().'.'.$extension;
               $file->move($path,$new_logo);
           }else $file=null;
           DB::beginTransaction();
           try {
            $save = array(
                'type'      =>2,
                'fullname'      =>$data['name'],
                'bussiness_name' =>$data['bussiness_name'],
                'logo'           =>isset($new_logo)?$path.$new_logo:$old_logo,
                'province' =>$data['province'],
                'action_status' =>$data['action_status'],
                'hotline' =>$data['hotline'],
                'fax'       =>$data['fax'],
                'site'      =>$data['site'],
                'code'      =>$data['code'],
                'product'   =>$data['product'],
                'info_add'  =>$data['info_add'],
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
                    'name' =>$data['name'],
                    'avatar' => isset($new_avatar)?$path.$new_avatar:$old_avatar,
                    'password'=>isset($request->password)?Hash::make($request->password):Auth::user()->password,
                    'address' =>$data['address'],
                    'is_active' =>  0,
                    'created_at'    =>  Carbon::now(),
                    'updated_at'    =>  Carbon::now(),
                    ]);
            DB::commit();
            if (file_exists($path.$old_logo) && $path.$new_logo != $old_logo)
                unlink($old_logo);

            if (file_exists($path.$old_avatar) && $path.$new_avatar != $old_avatar)
                unlink($old_avatar);
        } catch (Exception $e) {
            DB::rollback();
            if (file_exists($path.$new_logo )) 
                unlink($path.$new_logo);
            if (file_exists($path.$new_avatar )) 
                unlink($path.$new_avatar);
        }
        Session::flash('success','Success');
        return Redirect::route('homepage.index');
    }

    public function edit_personal(Request $request) {
        $data = $request->all();
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
            $path = '/images/association/personal/';
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
                'logo' => 'images/association/personal/'.$new_file,
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
                    'avatar' => isset($new_file)?'images/association/personal/'.$new_file:$old_avatar,
                    'password'=>isset($request->password)?Hash::make($request->password):Auth::user()->password,
                    'phone'     =>$data['phone'],
                    'updated_at'    =>  Carbon::now(),
                    ]);
            
            DB::commit();
            if (file_exists($path."/".$old_avatar) && $old_avatar != 'images/association/personal/'.$new_file)
                unlink($path."/".$old_avatar);
            Session::flash('success','Success');
            return Redirect::back();
        } catch (Exception $e) {
            DB::rollback();
            if (file_exists($path."/".$new_file )) 
                unlink($path."/".$new_file);
        }
        Session::flash('success','Success');
        return Redirect::back();
    }
    }

    public function edit_collaborator(Request $request) {
        $data = $request->all();
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
            $path = '/images/collaborator/';
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
                'logo' => 'images/collaborator/'.$new_file,
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
                'avatar' => isset($new_file)?'images/collaborator/'.$new_file:$old_avatar,
                'password'=>isset($request->password)?Hash::make($request->password):Auth::user()->password,
                'phone'     =>$data['phone'],
                'updated_at'    =>  Carbon::now(),
                ]);
            
            DB::commit();
            if (file_exists($path."/".$old_avatar) && $old_avatar != 'images/collaborator/'.$new_file)
                unlink($path."/".$old_avatar);
            Session::flash('success','Success');
            return Redirect::back();
        } catch (Exception $e) {
            DB::rollback();
            if (file_exists($path."/".$new_file )) 
                unlink($path."/".$new_file);
        }
        Session::flash('success','Success');
        return Redirect::back();
    }
}
}
