<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Yajra\Datatables\Facades\Datatables;
use Storage;

class Member extends Model
{
	protected $table = 'users';
	protected $guarded = array();
    //

	public function association() {
		return $this->hasOne('App\Association','id','assoc_id');
	}

	public function getWaitingPersonalMember() {
		return  $this->where('role','member_personal')->where('is_active',0)->get();
	}

	public function getActivedPersonalMember() {
		return  $this->where('role','member_personal')->where('is_active',1)->get();
	}

	public function getWaitingAssociationMember() {
		return  $this->where('role','member_association')->where('is_active',0)->get();
	}

	public function getActivedAssociationMember() {
		return  $this->where('role','member_association')->where('is_active',1)->get();
	}

	public function activeMember($id) {
		return $this->where('id',$id)->update(['is_active'=>1]);
	}

	public function deleteMember($id) {
		return $this->where('id',$id)->delete();
	}
}
