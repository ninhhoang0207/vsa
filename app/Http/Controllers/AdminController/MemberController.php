<?php

namespace App\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Member;
use App\Association;
use Redirect;
use DB;
use Session;

class MemberController extends Controller
{
	private $member;
	private $association;

	public function __construct() {
		$this->member = new Member;
		$this->association = new Association;
	}
    //
	public function personalMember() {
		$member_waiting = $this->member->getWaitingPersonalMember();
		$member_actived = $this->member->getActivedPersonalMember();
		return view('admin.member.personal_member',compact(['member_waiting','member_actived']));
	}

	public function associationMember() {
		$member_waiting = $this->member->getWaitingAssociationMember();
		$member_actived = $this->member->getActivedAssociationMember();
		// dd($member_waiting[0]->association()->get()[0]->hotline);
		return view('admin.member.association_member',compact(['member_waiting','member_actived']));
	}

	public function activeMember($id) {
		$this->member->activeMember($id);
		return Redirect::back();
	}

	public function deleteMember($id) {
		$member = $this->member->where('id',$id)->first();
		$association = $this->association->where('id',$member->assoc_id)->first();
		if ($member) 
			$this->association->where('id',$member->assoc_id)->delete();
		$this->member->deleteMember($id);
		if (file_exists($member->avatar)) 
            unlink($member->avatar);
        if (file_exists($association->logo)) 
            unlink($association->logo);
		Session::flash('success',"Success");
		return Redirect::back();
	}
}
