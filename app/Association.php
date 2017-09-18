<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Association extends Model
{
    //
    protected $table = "associations";
    protected $fillable = array('id','type', 'fullname','email', 'bussiness_name', 'logo', 'province','action_status','fax', 'site', 'code','train_process','hotline','fax','action_process','birthday','company','position');

    public function user() {
        return $this->hasOne('App\User','assoc_id');
    }

    public function remove($id) {
    	$this->where('id',$id)->delete();
    }
}
