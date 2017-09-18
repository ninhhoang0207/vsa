<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collaborator extends Model
{
    //
    protected $table = 'users';
    protected $guarded = array();

    public function association() {
		return $this->hasOne('App\Association','id','assoc_id');
	}

	public function getWaitingCollaborator() {
		return  $this->where('role','collaborator')->where('is_active',0)->get();
	}

	public function getActivedCollaborator() {
		return  $this->where('role','collaborator')->where('is_active',1)->get();
	}

	public function activeCollaborator($id) {
		return $this->where('id',$id)->update(['is_active'=>1]);
	}

	public function deleteCollaborator($id) {
		return $this->where('id',$id)->delete();
	}
}
