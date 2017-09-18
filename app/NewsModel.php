<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Yajra\Datatables\Facades\Datatables;
use Storage, Lang, Auth;
use DB;

class NewsModel extends Model
{
    //
	protected $table = 'news';
	protected $guarded = array();

	public function author() {
		return $this->belongsTo('App\User','created_by');
	}

	public function isUpdatePost() {
		return $this->hasOne('App\NewsBeforUpdate','news_id');
	}

	public function categories() {
		return $this->belongsToMany('App\CategoryModel','news_category','news_id','category_id');
	}

	public function getAssociationNews() {
		return $this->where('is_valid',1)
						->where('view_mode','association')
						->select('title','title_slug')
						->get()
						->take(3);
	}

	public function getNewsByCategory($title,$count=5) {
		$data = CategoryModel::where('title',$title)->select('id','title')->first();
		if (Auth::check())
			$data = count($data)?
						$data->news()
							  ->where('news.is_valid',1)
							  ->orderBy('news.posted_at','desc')
							  ->where('view_mode','<>','association')
							  ->where('view_mode','<>','event')
							  ->select(['news.id','title','title_slug','title_image','description','news.posted_at','view_mode','is_hot'])
							  ->paginate($count):array();
		else
			$data = count($data)?
						$data->news()
							  ->where('news.is_valid',1)
							  ->where('view_mode','all')
							  ->orderBy('news.posted_at','desc')
							  ->select(['news.id','title','title_slug','title_image','description','news.posted_at','view_mode'])
							  ->paginate($count):array();
		return $data;
	}

	public function getRecentNews($count = 5) {
		if (Auth::check())
			return $this->where('is_valid',1)
							->where('view_mode','<>','association')
							->where('view_mode','<>','event')
							->orderBy('posted_at','desc')
							->select(['id','title','title_slug','title_image','posted_at','description','view_mode'])
							->paginate($count);

		return $this->where('is_valid',1)
						->where('view_mode','<>','association')
						->where('view_mode','all')
						->orderBy('posted_at','desc')
						->select(['id','title','title_slug','title_image','posted_at','description','view_mode'])
						->paginate($count);
	}

	public function getHotNews($count = 5) {
		if (Auth::check())
			return $this->where('is_hot',1)
					->where('is_valid',1)
					->where('view_mode','<>','association')
					->where('view_mode','<>','event')
					->orderBy('posted_at','desc')
					->orderBy('views','asc')
					->select(['id','title','title_slug','description','title_image','content','posted_at','view_mode'])
					->paginate($count);
					
		return $this->where('is_hot',1)
					->where('is_valid',1)
					->where('view_mode','all')
					->orderBy('posted_at','desc')
					->orderBy('views','asc')
					->select(['id','title','title_slug','description','title_image','content','posted_at','view_mode'])
					->paginate($count);
	}

	public function getEvents($count = 5) {

		return $this->where('is_valid',1)
					->where('view_mode','event')
					->orderBy('posted_at','desc')
					->orderBy('views','asc')
					->select(['id','title','title_slug','description','title_image','content','posted_at','view_mode'])
					->paginate($count);
	}

	public function getNewsPosted($user, Request $request) {
		if (!isset($user->role))
			return null;
		if ($user->role == 'admin'){
			$data = NewsModel::where('is_valid',1)->with('categories');
		} else {
			$data = NewsModel::where('is_valid',1)->where('created_by',$user->id)->with('categories');
		}
		if ($request->categories_search){
			if ($request->categories_search) {
				$category_id = array();
				foreach ($request->categories_search as $key => $value) {
					array_push($category_id, $value);
				}
				$news_id = DB::table('news_category')
				->whereIn('category_id',$category_id)
				->where('news_id','>','0')
				->orderBy('news_category.category_id')
				// ->groupBy('news_category.news_id')
				->get(['news_id']);
				$news_list = array();
				foreach ($news_id as $key => $value) {
					array_push($news_list, $value->news_id);
				}
				$data = NewsModel::where('is_valid',1)->whereIn('news.id',$news_list)->orderBy('posted_at','desc')->with('categories');
			}
		}
		return Datatables::eloquent($data)
			->editColumn('created_at', function ($value) {
				return $value->created_at->format('d/m/Y H:i');
			})
			->filterColumn('created_at', function ($query, $keyword) {
				$query->whereRaw("DATE_FORMAT(created_at,'%Y/%m/%d %H:%i') like ?", ["%$keyword%"]);
			})
			->editColumn('posted_at', function ($value) {
				return Carbon::parse($value->posted_at)->format('d/m/Y H:i');
			})
			->filterColumn('posted_at', function ($query, $keyword) {
				$query->whereRaw("DATE_FORMAT(posted_at,'%Y/%m/%d %H:%i') like ?", ["%$keyword%"]);
			})
			->editColumn('title_image', function ($value) {
				return Storage::url($value->title_image);
			})
			->addColumn('categories_list', function ($value) {
           	$categories = $value->categories;
           	$list = '';
           	foreach ($categories as $key => $value) {
           	 	$list .= $value->title;
           	 	$list .= ' - ';
           	 }
           	$list = substr($list, 0, strlen($list) - 3);
           	return $list;
			})
			->make(true);
	}

	public function getNewsWaiting($user,$request) {
		if (!isset($user->role))
			return null;
		if ($user->role == 'admin') {
			$data = NewsModel::where('is_valid',0)->with('categories');
		} else {
			$data = NewsModel::where('is_valid',0)->where('created_by',$user->id)->with('categories');
		}
		if ($request->categories_search){
			if ($request->categories_search) {
				$category_id = array();
				foreach ($request->categories_search as $key => $value) {
					array_push($category_id, $value);
				}
				$news_id = DB::table('news_category')
				->whereIn('category_id',$category_id)
				->where('news_id','>','0')
				->orderBy('news_category.category_id')
				// ->groupBy('news_category.news_id')
				->get(['news_id']);
				$news_list = array();
				foreach ($news_id as $key => $value) {
					array_push($news_list, $value->news_id);
				}
				$data = NewsModel::where('is_valid',0)->whereIn('news.id',$news_list)->with('categories');
			}
		}

		return Datatables::eloquent($data)
			->editColumn('created_at', function ($value) {
				return $value->created_at->format('d/m/Y H:i');
			})
			->filterColumn('created_at', function ($query, $keyword) {
				$query->whereRaw("DATE_FORMAT(created_at,'%Y/%m/%d %H:%i') like ?", ["%$keyword%"]);
			})
			->editColumn('updated_at', function ($value) {
				return $value->updated_at->format('d/m/Y H:i');
			})
			->filterColumn('updated_at', function ($query, $keyword) {
				$query->whereRaw("DATE_FORMAT(updated_at,'%Y/%m/%d %H:%i') like ?", ["%$keyword%"]);
			})
			->editColumn('title_image', function ($value) {
				return Storage::disk('local')->url($value->title_image);
			})
			->editColumn('posted_at', function($value) {
				return count($value->isUpdatePost()->first())?Lang::get('news/backend.update'):Lang::get('news/backend.new');
			})
			->make(true);
	}

	//Allow a news that is created recently is available to show in homepage
	public function postNews($id) {
		return $this->where('id',$id)->update(['is_valid'=>1,'posted_at'=>Carbon::now()]);
	}

	public function getNewsFromCategory() {
		return $this->belongsToMany('App\CategoryModel','news_category','news_id','category_id');
	}

	public function searchNews($keyword, $count=9) {
		if (Auth::check())
			return $this->where('is_valid',1)
					->where('title_slug','like',$keyword)
					->orderBy('news.posted_at','desc')
					// ->where('view_mode','<>','association')
					->select(['news.id','title','title_slug','title_image','description','news.posted_at'])
					->paginate($count);
		else
			return $this->where('is_valid',1)
					->where('title_slug','like',$keyword)
					->where('view_mode','all')
					->orderBy('news.posted_at','desc')
					// ->where('view_mode','<>','association')
					->select(['news.id','title','title_slug','title_image','description','news.posted_at'])
					->paginate($count);
	}
}
