<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsBeforUpdate extends Model
{
    //
	protected $table = 'news_befor_updates';
	protected $guarded = array();

	public function categories() {
		return $this->belongsToMany('App\CategoryModel','news_category','news_befor_update_id', 'category_id');
	}
}
