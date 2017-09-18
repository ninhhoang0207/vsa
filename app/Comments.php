<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comments extends Model
{	
	use SoftDeletes;
    /**
	 * @var string table
	 */
	protected $table = 'comments';

	/**
	 * @var array guarded column
	 */
	protected $fillable = array('id','content', 'user_id', 'new_id', 'video_id');
	
	public function user(){
    	 return $this->belongsTo('App\User','user_id');
    }
}
