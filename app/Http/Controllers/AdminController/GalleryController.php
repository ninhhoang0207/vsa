<?php

namespace App\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Gallery;
use App\GalleryImage;
use App\GalleryTemp;
use App\GalleryImageTemp;
use DB, Lang, Session, Redirect, Validator, File, Storage, Auth;

class GalleryController extends Controller
{
    private $gallery;
    private $gallery_image;
    private $gallery_temp;
    private $gallery_image_temp;

    public function __construct() {
        $this->gallery = new Gallery;
        $this->gallery_image = new GalleryImage;
        $this->gallery_temp = new GalleryTemp;
        $this->gallery_image_temp = new GalleryImageTemp;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $id = 17;
        // $directory = 'public/images/gallery/'.$id;
        // $files = Storage::allFiles($directory);
        // $old_gallery_images = $this->gallery_image_temp->where('gallery_id', $id)->get(['url_image']);
        // foreach ($old_gallery_images as $key => $value) {
        //     $index = array_search(str_replace('\\','', $value->url_image), $files);
        //     unset($files[$index]);
        // }
        // dd($files);
        return view('admin.gallery.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $avatar = $request->avatar;
        //Check empty content
        if (!isset($avatar)) {
            Session::flash('error',Lang::get('general.avatar_empty'));
            return Redirect::back();
        }
        //Check empty content
        if (!isset($request->content)) {
           Session::flash('error',Lang::get('general.content_empty'));
           return Redirect::back();
        }
        //Check empty image
        $img_info = $request->img_info;
        if (!isset($img_info) || !$this->checkEmptyImage($img_info)) {
            Session::flash('error',Lang::get('genera.image_empty'));
            return Redirect::back();
        }
        foreach ($img_info as $key => $value) {
            if ($value == null) unset($img_info[$key]);
        }
        //
        DB::beginTransaction();
        try {
            $_token = $request->_token;
            //Xu ly avatar
            $temp_folder = 'images/temp/'.$_token.'/';
            $real_folder = 'public/images/gallery/avatar/';
            $avatar_name = 'avatar_'.time().'.'.$avatar->getClientOriginalExtension();
            $avatar = Storage::disk('local')->putFileAs($real_folder,$avatar,$avatar_name);

            $data = array(
            'title'         =>  $request->title,
            'title_slug'    =>  $this->slug($request->title).'-'.time(),
            'content'       =>  $request->content,
            'avatar'        =>  $avatar,
            'created_by'    =>  Auth::user()->id,
            'updated_by'    =>  Auth::user()->id,
            );

            $gallery = $this->gallery->create($data);
            $this->doUploadImage($gallery->id, $img_info, $_token);

            DB::commit();
        } catch (Exception $e) {
            Session::flash('error',Lang::get("general.error"));
            DB::rollback();
            return Redirect::back();
        }

        Session::flash('success', Lang::get('general.success'));
        return Redirect::route('admin.gallery');
    }

    private function checkEmptyImage($img_info) {
        foreach ($img_info as $key => $value) {
            if (strpos($value, '0,') !== false) 
                return true;
        }
        return false;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $data = $this->gallery->where('id',$id)->first();
        if (!count($data)) 
            return Redirect::route('admin.gallery');
        return view('admin.gallery.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id = -1)
    {
        //
        $data = $this->gallery->where('id',$id)->first();
        if ($data->is_active == 0) 
            return Redirect::route('admin.gallery');
        return view('admin.gallery.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //Check empty content
        if (!isset($request->content)) {
           Session::flash('error',Lang::get('general.content_empty'));
           return Redirect::back();
        }
        //Check empty image
        $img_info = $request->img_info;
        if (!isset($img_info) || !$this->checkEmptyImage($img_info)) {
            Session::flash('error',Lang::get('general.image_empty'));
            return Redirect::back();
        }
        foreach ($img_info as $key => $value) {
            if ($value == null) unset($img_info[$key]);
        }

        $this->savePreviewData($id);

        DB::beginTransaction();
        try {
            $data = array(
                'title'         =>  $request->title,
                'title_slug'    =>  $this->slug($request->title).'-'.time(),
                'content'       =>  $request->content,
                'updated_by'    =>  Auth::user()->id,
                'is_active'     =>  0,
                );
            $old_data = $this->gallery->where('id',$id)->first();
            //Avatar
            $old_avatar = $old_data->avatar;
            $folder_avatar = 'public/images/gallery/avatar/';
            $data['avatar'] = $old_avatar;
            if ($request->avatar) {
                $new_avatar = $request->avatar; 
                $new_name = 'avatar_'.time().'.'.$new_avatar->getClientOriginalExtension();
                $new_avatar = Storage::disk('local')->putFileAs($folder_avatar,$new_avatar,$new_name);
                $data['avatar'] = $new_avatar;
            }

            $gallery = $this->gallery->where('id',$id)->update($data);
            $this->doUploadImage($id, $img_info, $request->_token, $model='gallery_image_temp');
            DB::commit();
           
        } catch (Exception $e) {
            Session::flash('error', Lang::get('general.error'));
            // Storage::delete($new_avatar);
            DB::rollback();
        }

        Session::flash('success', Lang::get('general.success'));
        return Redirect::route('admin.gallery');
    }

    private function savePreviewData($id) {
        $old_data = $this->gallery->where('id',$id)->first();

        if (!isset($old_data)) {
            Session::flash('error', Lang::get('general.error'));
            return Redirect::back();
        }

        DB::beginTransaction();
        try {
            $old_gallery_images = $old_data->images()->get(['url_image']);
            $old_data = $old_data->toArray();
            $old_data['gallery_id'] = $id;
            unset($old_data['id']);

            $gallery = $this->gallery_temp->create($old_data);

            foreach ($old_gallery_images as $key => $value) {
                $this->gallery_image_temp->create([
                    'gallery_id'    =>  $id,
                    'url_image'     =>  $value->url_image,
                    ]);
            }
            DB::commit();
        } catch (Exception $e) {
            Session::flash('error', Lang::get('general.error'));
            DB::rollback();
            return Redirect::back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $gallery = $this->gallery->where('id', $id)->first();
        $gallery_images = $this->gallery_image->where('gallery_id', $id)->get(['url_image']);
        $old_gallery = $this->gallery_temp->where('gallery_id', $id)->first();
        $old_gallery_images = $this->gallery_image_temp->where('gallery_id', $id)->get(['url_image']);

        DB::beginTransaction();

        //Case deny new edit gallery
        if (count($old_gallery)) {
           $old_gallery = $old_gallery->toArray();
           unset($old_gallery['gallery_id']);
           unset($old_gallery['id']);

           try {
                $this->gallery->where('id', $id)->update($old_gallery);
                $this->gallery_image->where('gallery_id', $id)->delete();

                foreach ($old_gallery_images as $key => $value) {
                    $this->gallery_image->create([
                        'gallery_id'    =>  $id,
                        'url_image'     =>  $value->url_image,
                        ]);
                }
                $this->gallery_temp->where('gallery_id', $id)->delete();
                $this->gallery_image_temp->where('gallery_id', $id)->delete();
                DB::commit();
            } catch (Exception $e) {
                Session::flash('error', Lang::get('general.error'));
                DB::rollback();
                return -1;
            }

            //Remove avatar
            if ($gallery->avatar != $old_gallery['avatar'])Storage::delete($gallery->avatar);

            //Remove old image
            $directory = 'public/images/gallery/'.$id;
            $files = Storage::allFiles($directory);
            foreach ($old_gallery_images as $key => $value) {
                $index = array_search(str_replace('\\','', $value->url_image), $files);
                unset($files[$index]);
            }
            foreach ($files as $key => $value) {
                Storage::delete($value);
            }
            
        } else {//Case delete new gallery
            try {
                $this->gallery->where('id', $id)->delete();
                $this->gallery_image->where('gallery_id', $id)->delete();

                DB::commit();
            } catch (Exception $e) {

                Session::flash('error', Lang::get('general.error'));
                DB::rollback();
                return -1;
            }

            Storage::delete($gallery->avatar);
            $gallery_folder = 'public/images/gallery/'.$id;
            foreach ($gallery_images as $key => $value) {
                Storage::delete($value->url_image);
            }
            Storage::deleteDirectory($gallery_folder);
        }   
        
        Session::flash('success', Lang::get('general.success'));
        return 1;
    }



    //Upload phan create new
    public function uploadImage(Request $request){
        //Khoi tao 
        $type = $request->type;
        $temp_folder = 'public/images/temp/'.$request->_token;

        $file = $request->file;
        $new_name = rand(1,1000).time().'.'.$file->getClientOriginalExtension();
        // $file->move($temp_folder,$new_name.'.'.$ext);
        Storage::disk('local')->putFileAs($temp_folder,$file,$new_name);
        return $new_name;
    }

    public function removeImage(Request $request){
        $id = $request->id?$request->id:-1;
        $name = $request->name;
        $temp_folder = 'public/images/temp/'.$request->_token;
        $real_folder = 'public/images/gallery/'.$id.'/';
        $data = $this->gallery_image->where('url_image',$real_folder.'\\'.$name)->first();
        if(count($data) != 0){
            return json_encode($data);
        }
        return -1;
    }

    public function doUploadImage($id,$data_img=null,$_token){
        //Khoi tao thu muc
        $temp_folder = 'public/images/temp/'.$_token.'/';
        $real_folder = 'public/images/gallery/'.$id.'/';
        $old_images = array();
        Storage::makeDirectory($real_folder,0777,true);
        //Luu anh vao server
        try {
            foreach ($data_img as $key => $value) {
                $temp = explode(",", $value);
                $is_oldImage = $temp[0];//0-newfile, 1-oldfile
                $file_name = $temp[1];
                if ($file_name != "undefined") {
                    if($is_oldImage == 0){
                        Storage::move($temp_folder.$file_name,$real_folder.$file_name);
                        $this->gallery_image->create([
                            'gallery_id'    =>  $id,
                            'url_image'     =>  $real_folder.'\\'.$file_name,
                            ]);
                    }else{
                        array_push($old_images, $real_folder.$file_name);
                        $this->gallery_image->where('url_image',$real_folder.'\\'.$file_name)->delete();
                    }
                }
            }//end foreach
            //Xoa sau khi da thuc hien xong
            Storage::deleteDirectory($temp_folder);
            Session::flash('success', Lang::get('general.success'));
        } catch (Exception $e) {
            Session::flash('error',Lang::get('general.error'));
            dd($e);
        }
    }

    public function getImage(Request $request){
        $id = $request->id;
        $real_folder = 'public/stores/img_hotel/'.$id.'/';
        $data = $this->gallery->find($id)->images()->get();
        foreach ($data as $key => $value) {
            $value->url = Storage::disk('local')->url(str_replace('\\', '', $value->url_image));
        }
        return $data;
    }

    public function getGalleryWaiting() {
        return $this->gallery->getGalleryWaiting();
    }

    public function getGalleryPosted() {
        return $this->gallery->getGalleryPosted();
    }

    public function postGallery(Request $request) {
        $id = $request->id;
        $old_gallery = $this->gallery_temp->where('gallery_id',$id)->first();
        $new_gallery = $this->gallery->where('id', $id)->first();

        if (!count($old_gallery)){
            $this->gallery->postGallery($id);
            return 1;
        }
        else {
            $old_gallery_images = $this->gallery_image_temp->where('gallery_id',$id)->get(['url_image']);
            $new_gallery_images = $this->gallery_image->where('gallery_id', $id)->get(['url_image']);
        
            //Remove old data in database
            DB::beginTransaction();
            try {
                $this->gallery_temp->where('gallery_id',$id)->delete();
                $this->gallery_image_temp->where('gallery_id',$id)->delete();
                DB::commit();
            } catch (Exception $e) {
                DB::rollback();
                return 0;
            }

            //Remove old avatar
            if ($old_gallery->avatar != $new_gallery->avatar) Storage::delete($old_gallery->avatar);

            //Remove old image
            $old_images = array();
            $new_images = array();
            foreach ($old_gallery_images as $key => $value) {
                array_push($old_images, $value->url_image);
            }
            foreach ($new_gallery_images as $key => $value) {
                array_push($new_images, $value->url_image);
            }
            foreach ($old_images as $key => $value) {
                if (in_array($value, $new_images)) unset($old_images[$key]);
            }

            foreach ($old_images as $key => $value) {
                Storage::delete($value);
            }
        }
        $this->gallery->postGallery($id);
        return 1;
    }

    public function getDetail(Request $request) {
        if ($request->id) {
            $id = $request->id;
            $data = $this->gallery->where('id', $id)->get(['id','title'])->first();

            if (count($data))
                return $data;
        }

        return -1;
    }
}
