<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GalleryTemp extends Model
{
    //
	protected $table = 'gallery_temps';
	protected $guarded = array();

	public function images() {
		return $this->hasMany('App\GalleryImageTemp','gallery_id','gallery_id');
	}
}
