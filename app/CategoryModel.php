<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Lang;

class CategoryModel extends Model
{
    //
	protected $table = 'categories';
	protected $guarded = array();

	public function getCategoryMenu() {
		return $this->where('parent_id',0)->where('status',1)->orderBy('queue')->get(['id','title','title_slug']);
	}
	
	public function children() {
		return $this->hasMany('App\CategoryModel','parent_id');
	}

	public function parent($id) {
		$parent = $this->where('id',$id)->get(['title']);
		if (count($parent))
			return $parent->first()->title;
		return Lang::get('category/backend.root');
	}

	public function news() {
		return $this->belongsToMany('App\NewsModel','news_category','category_id','news_id')->orderBy('news.updated_at','desc');
	}

	public function lists() {
		return $this->where('level','<',3)->orderBy('level','asc')->orderBy('queue','asc')->get(['id','title','level','parent_id']);
	}

}
