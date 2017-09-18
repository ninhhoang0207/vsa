<?php

namespace App\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Video;
use Auth;
use Session;
use Redirect;
use Carbon\Carbon;
use Yajra\Datatables\Facades\Datatables;
use Input;
use Log;
use App\CategoryModel;
use App\NewsModel;
use App\Comments;
use Response;

class VideoController extends Controller
{   

    private $news;

    public function __construct() {
        $this->news = new NewsModel;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_index()
    {
        return view('admin.video.index');
    }

    public function get_video_data() {
        $data = Video::select(['id','title','title_image','created_at']);
        return Datatables::of($data)
        ->editColumn('created_at', function ($user) {
            return $user->created_at->format('d/m/Y');
        })
        ->filterColumn('created_at', function ($query, $keyword) {
            $query->whereRaw("DATE_FORMAT(created_at,'%Y/%m/%d') like ?", ["%$keyword%"]);
        })
        ->make(true);
    }

    public function get_detail(Request $request) {
        $id = $request->id;
        if (isset($id)) {
            $data = Video::where('id',$id)->get(['id','title'])->first();
            return $data;
        } 
        return -1;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('admin.video.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $data = $request->all();
        // dd($data);
        $title_slug      = str_slug( $data['title'] );
        $mytime    = strtotime( Carbon::now()->toDateTimeString() );
        unset($data['_token']);
        $file = $data['title_image'];
        $extension = $file->getClientOriginalName();
        $path = 'images/videos/';
        $avatar_file_name = 'images/videos/'.time().".".$extension;
        $file->move($path,$avatar_file_name);
        try {

            $data['title_slug'] =  $title_slug.$mytime;
            $data['title_image']   =$avatar_file_name;
            $data['is_hot']        =  isset($data['is_hot'])?1:0;
            $data['is_valid']  = Auth::user()->role=='admin'?1:0;
            $data['type']        =  isset($data['type'])?1:0;
            $data['created_by']    = Auth::user()->id;
            $data['updated_by']    = Auth::user()->id;
            
            $video = Video::create( $data );
        } catch (\Exception $e) {
            throw $e;
        }
    // somethig went wrong
        Session::flash('success','Success');
        return redirect(route('admin.video.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Video::find( $id );
        // dd($data['url']);
        $this ->viewData = array(
            'data' => $data,
            );
        return view( 'admin.video.show', $this->viewData);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Video::find( $id );
        $this ->viewData = array(
            'data' => $data, 
            );
        return view ( 'admin.video.edit', $this->viewData );
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
    }

    public function update( Request $request, $id )
    {
        $data = $request->all();
        unset($data['_token']);
        unset($data['_method']);
            if(!$request->hasFile('title_image')){
            $video = Video::where('id', $id)->first();
            $video->update($data);
            Session::flash( 'success', 'Sửa thành công !!!!!');
            return redirect(route('admin.video.index'));
        }else{
            $file = $data['title_image'];
            $extension = $file->getClientOriginalName();
            $path = 'images/videos/';
            $avatar_file_name = 'images/videos/'.time().".".$extension;
            $file->move($path,$avatar_file_name);
            $data['title_image']   =$avatar_file_name;
            $video = Video::where('id', $id)->first();
            $video->update($data);
            Session::flash( 'success', 'Sửa thành công !!!!!');
            return redirect(route('admin.video.index'));
        }

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request, $id= -1)
    {
        DB::beginTransaction();
        try {
            Video::find( $id )->delete();
            DB::commit();
        } catch(\Exception $e) {
            \Log::info( $e->getMessage() );
            DB::rollback();
            return -1;
        }
        Session::flash( 'success', 'Xóa thành công !!!!!');
        return Redirect::back();
    }

    public function showDetail( $title_slug )
    {
    $data = Video::where( 'title_slug', $title_slug )->first();
    $id = $data['id'];
    $user = Auth::User();
    $video = Video::where('id', '<>', $id)->paginate(5);
    $news = new NewsModel;
    $news_recent = $news->getRecentNews();
    $news_hot = $this->news->getHotNews();
    $category = new CategoryModel;
    $categories = $category->getCategoryMenu();
    $comment = Comments::where('video_id','=',$id)->get();
    $this->viewData = array(
        'data' => $data,
        'news_hot' => $news_hot,
        'news_recent' => $news_recent,
        'news' => $news,
        'category'   => $category,
        'categories'  => $categories,
        'video'  => $video,
        'comment'  => $comment,
        'user' => $user
              );
      return view( 'video.index', $this->viewData);
  }

  public function addcomment(Request $request , $id){
    
    $data = $request->all();
    Comments::insert([
        'user_id' => Auth::User()->id,
        'video_id' => $id,
        'content'=> $data['content'],
        "created_at" => Carbon::now(),
        "updated_at" => Carbon::now(),
      ]);
    $id = Comments::select('id')->where('video_id','=',$id)->where('content','=',$data['content'])->where('user_id','=',Auth::User()->id)->get();
    foreach($id as $value){
      $data['id'] = $value['id'];
    }
    return Response::json($data);
  }  


}
