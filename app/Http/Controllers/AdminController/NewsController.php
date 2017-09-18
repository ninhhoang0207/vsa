<?php

namespace App\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\NewsModel;
use App\NewsCategoryModel;
use App\CategoryModel;
use App\User;
use App\NewsBeforUpdate;
use App\Http\Controllers\AdminController\CategoryController;
use Auth;
use Session;
use Redirect;
use Carbon\Carbon;
use Storage;
use Validator;
use Lang;

class NewsController extends Controller
{

	private $news;
	private $category;

	public function __construct() {
		$this->news = new NewsModel;
		$this->category = new CategoryModel;
	}

	public function index() {
		$category_list = $this->category->lists();
		return view('admin.news.index',compact('category_list'));
	}

	public function getNewsPostedData(Request $request) {
		return $this->news->getNewsPosted(Auth::user(),$request);
	}

	public function getNewsWaitingData(Request $request) {
		return $this->news->getNewsWaiting(Auth::user(),$request);
	}

	public function getDetail(Request $request) {
		$id = $request->id;
		if (isset($id)) {
			$data = NewsModel::where('id',$id)
			->get(['id','title','created_by','updated_by','updated_at','view_mode','description'])
			->first();
			$data['created_by'] = isset($data['created_by'])?User::where('id',$data['created_by'])->first():null;
			$data['created_by'] = isset($data['created_by'])?$data['created_by']['name']:null;
			$data['updated_by'] = isset($data['updated_by'])?User::where('id',$data['updated_by'])->first():null;
			$data['updated_by'] = isset($data['updated_by'])?$data['updated_by']['name']:null;
			$updated_at = $data['updated_at']->toDateTimeString();
			$updated_at = Carbon::parse($updated_at);
			$updated_at = $updated_at->format('d/m/Y H:i');
			$data['updated'] = $updated_at;
			return $data;
		} 
		return -1;
	}

	public function create( Request $request ) {
		$category_list = $this->category->lists();
		return view('admin.news.create',compact('category_list'));
	}

	public function store(Request $request) {
		$validator = Validator::make(['content'=>$request->content],
						['content' => 'required']);

		if ($validator->fails()) {
			Session::flash('required',Lang::get('news.backend.reuired'));
			return Redirect::back();
		}

		$data = $request->all();
		$file = $data['title_image'];
		$extension = $file->getClientOriginalExtension();
		$id = DB::getPdo()->lastInsertId()+1;
		$path = 'images/news';
		$new_file_name = $id.'_'.time().".".$extension;
		$store = Storage::disk('local')->putFileAs($path,$file,$new_file_name);
		DB::beginTransaction();
		try {
			$title_slug = str_replace(' ', '-', strtolower($this->convert_vi_to_en($data['title']))).time() ;
			$save = array(
				'title'			=>	$data['title'],
				'title_slug'	=>	$title_slug,
				'is_hot'			=>	isset($data['is_hot'])?1:0,
				'view_mode'		=>	$data['view_mode'],
				'content'		=>	$data['content'],
				'title_image'	=>	$store,
				'views'			=>	0,
				'description'	=>	$data['description'],
				'content'		=>	$data['content'],
				'is_valid'		=>	0,
				'created_by'	=>	Auth::user()->id,
				'updated_by'	=>	Auth::user()->id,
				'created_at'	=>	Carbon::now(),
				'updated_at'	=>	Carbon::now(),
				);
			$news = DB::table('news')->insert($save);
			$id = DB::getPdo()->lastInsertId();
			foreach ($data['categories'] as $key => $value) {
				DB::table('news_category')->insert(['category_id'=>$value,'news_id'=>$id]);
			}
			DB::commit();
		} catch (\Exception $e) {
			DB::rollback();
			Storage::delete($store);
			throw $e;
    		// something went wrong
		}
		Session::flash('success','Success');
		return Redirect::route('admin.news.index');
	}

	public function edit ($id = -1) {
		$category_list = CategoryModel::all();
		$categories_selected = NewsCategoryModel::where('news_id',$id)->get(['category_id']);
		if(isset($categories_selected)) {
			$categories_selected = $categories_selected->toArray();
		}
		$data = NewsModel::where('id',$id)->select('title','title_image','is_hot','view_mode','content','description','is_valid')->first();
		return view('admin.news.edit',compact(['data','category_list','categories_selected']));
	}

	public function update (Request $request, $id = -1) {
		$data = $request->all();
		$file = isset($data['title_image'])?$data['title_image']:null;
		$old_data = NewsModel::where('id',$id)->select('title_image')->first();
		$old_file_name = isset($old_data)?$old_data['title_image']:"";
		$store = $old_file_name;
		$path = 'images/news';
		//If modify image
		if (isset($file)) {
			$new_file_name = $id.'_'.time();
			$extension = $file->getClientOriginalExtension();
			$new_file_name .= ".".$extension;
			$store = Storage::disk('local')->putFileAs($path,$file,$new_file_name);
		}

		DB::beginTransaction();
		try {
			$title_slug = str_replace(' ', '-', strtolower($this->convert_vi_to_en($data['title']))).time() ;
			$save = array(
				'title'			=>	$data['title'],
				'title_slug'	=>	$title_slug,
				'is_hot'			=>	isset($data['is_hot'])?1:0,
				'view_mode'		=>	$data['view_mode'],
				'content'		=>	$data['content'],
				'title_image'	=>	$store,
				'description'	=>	$data['description'],
				'content'		=>	$data['content'],
				'is_valid'		=>	0,
				'updated_by'	=>	Auth::user()->id,
				'updated_at'	=>	Carbon::now(),
				'posted_at'		=>	null,
				);
			
			//Update category
			$old_categories = NewsCategoryModel::where('news_id',$id)->get();
			$old_news = $this->news->where('id',$id)->first()->toArray();
			$old_news['news_id'] = $old_news['id'];
			unset($old_news['id']);
			//Update new categories
			NewsCategoryModel::where('news_id',$id)->delete();
			foreach ($data['categories'] as $key => $value) {
				NewsCategoryModel::create(array(
					'news_id'		=>	$id,
					'category_id'	=>	$value,
					));
			}
			//Save old news
			$news_befor_update = NewsBeforUpdate::create($old_news);
			foreach ($old_categories as $key => $value) {
				NewsCategoryModel::create(['category_id'=>$value->category_id,'news_befor_update_id'=>$news_befor_update->id]);
			}
			NewsModel::where('id',$id)->update($save);
			DB::commit();
			Session::flash('success',"Success");
		} catch (\Exception $e) {
			DB::rollback();
			Session::flash('error',"Error");
			throw $e;
		}
		return Redirect::route('admin.news.index');
	}

	public function delete($id = -1) {
		DB::beginTransaction();
		try {
			$old_news = NewsBeforUpdate::where('news_id',$id)->first();
			$recent_news = $this->news->where('id',$id)->first();
			$old_image = '';
			$recent_image = $recent_news->title_image;
			if (count($old_news)) { //If this is update post
				//Take preview post;
				$old_news_id = $old_news->id;
				$old_categories = $old_news->categories()->get();
				$old_image = $old_news->title_image;
				$old_news = $old_news->toArray();
				unset($old_news['id']);
				unset($old_news['news_id']);
				$recovery_news = $recent_news->update($old_news);//Recovery preview news;
				NewsCategoryModel::where('news_id',$id)->delete();
				foreach ($old_categories as $key => $value) {
					NewsCategoryModel::where('news_befor_update_id',$old_news_id)
					->where('category_id',$value->id)
					->update(['news_id'=>$id]);
				}
				NewsBeforUpdate::where('news_id',$id)->delete();
			}else {
				NewsCategoryModel::where('news_id',$id)->delete();
				$recent_news->delete();
			}
			//Recovery old news if have
			DB::commit();
			if ($old_image != $recent_image) 
				Storage::disk('local')->delete($recent_image);
		} catch(\Exception $e) {
			DB::rollback();
			return -1;
		}
		return 1;
	}

	public function postNews(Request $request) {
		$news = new NewsModel;
		if (isset($request->id)){
			$old_news = NewsBeforUpdate::where('news_id',$request->id)->first();
			$recent_news = $news->where('id',$request->id)->first();
			if (count($old_news)) {
				// If old post and recent post have same img url
				$old_news->title_image!=$recent_news->title_image?
				Storage::disk('local')->delete($old_news->title_image):'';
				NewsCategoryModel::where('news_befor_update_id',$old_news->id)->delete();
				$old_news->delete();
			}
			return $news->postNews($request->id);
		}
		return false;
	}

	public function show($id=-1) {
		$category_list = CategoryModel::all();
		$categories_selected = NewsCategoryModel::where('news_id',$id)->get(['category_id']);
		if(isset($categories_selected)) {
			$categories_selected = $categories_selected->toArray();
		}
		$data = NewsModel::where('id',$id)->select('id','title','title_image','is_hot','view_mode','content','description','is_valid')->first();
		return view('admin.news.show',compact(['data','category_list','categories_selected']));
	}
}
