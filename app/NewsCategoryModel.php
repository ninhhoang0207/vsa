<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsCategoryModel extends Model
{
    //
	protected $table = "news_category";
	protected $guarded = array();
	protected $fillable = ['news_id','category_id','news_befor_update_id'];
}
