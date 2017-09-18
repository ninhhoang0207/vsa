<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\Datatables\Facades\Datatables;
use Storage, Lang, Auth, DB;


class Gallery extends Model
{
    //
	protected $table = 'galleries';
	protected $guarded = array();

	public function images() {
		return $this->hasMany('App\GalleryImage','gallery_id');
	}

	public function author() {
		return $this->belongsTo('App\User','created_by');
	}

	public function getGallery($page = 5) {
		return $this->where('is_active', 1)->orderBy('posted_at')->select('id','title','title_slug','avatar')->paginate($page);
	}

	public function getOthers($id, $count = 3) {
		return $this->where('is_active',1)->where('id', $id)->get(['id','title','title_slug']);
	} 

	public function isUpdateGallery() {
		return $this->hasOne('App\GalleryTemp','gallery_id');
	}

	public function getGalleryWaiting() {
		$user = Auth::user();

		if (!isset($user->role)) return null;

		if ($user->role == 'admin') {
			$data = $this->where('is_active',0);
		} else {
			$data = $this->where('is_active',0)->where('created_by',$user->id);
		}

		return Datatables::eloquent($data)
			->editColumn('created_at', function ($value) {
				return $value->created_at->format('d/m/Y H:i');
			})
			->filterColumn('created_at', function ($query, $keyword) {
				$query->whereRaw("DATE_FORMAT(created_at,'%Y/%m/%d %H:%i') like ?", ["%$keyword%"]);
			})
			->editColumn('avatar', function ($value) {
				return Storage::disk('local')->url($value->avatar);
			})
			->editColumn('posted_at', function($value) {
				return count($value->isUpdateGallery()->first())?Lang::get('news/backend.update'):Lang::get('news/backend.new');
			})
			->make(true);
	}

	public function getGalleryPosted() {
		$user = Auth::user();

		if (!isset($user->role)) return null;

		if ($user->role == 'admin') {
			$data = $this->where('is_active',1);
		} else {
			$data = $this->where('is_active',1)->where('created_by',$user->id);
		}

		return Datatables::eloquent($data)
			->editColumn('created_at', function ($value) {
				return $value->created_at->format('d/m/Y H:i');
			})
			->filterColumn('created_at', function ($query, $keyword) {
				$query->whereRaw("DATE_FORMAT(created_at,'%Y/%m/%d %H:%i') like ?", ["%$keyword%"]);
			})
			->editColumn('avatar', function ($value) {
				return Storage::disk('local')->url($value->avatar);
			})
			->editColumn('posted_at', function($value) {
				$date = $value->posted_at;
				// $date = str_replace('/', '-', $date);
				return Carbon::parse($date)->format('d/m/Y H:i');
			})
			->filterColumn('posted_at', function ($query, $keyword) {
				$query->whereRaw("DATE_FORMAT(posted_at,'%Y/%m/%d %H:%i') like ?", ["%$keyword%"]);
			})
			->make(true);
	}

	public function postGallery($id) {
		$this->where('id',$id)->update(['is_active'=>1, 'posted_at'	=>	Carbon::now()]);
	}
}
