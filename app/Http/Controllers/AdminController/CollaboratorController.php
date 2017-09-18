<?php

namespace App\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Collaborator;
use App\Association;
use Redirect;
use Session;
use DB;
use Lang;

class CollaboratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $collaborator;
    private $association;

    public function __construct() {
        $this->collaborator = new Collaborator;
        $this->association = new Association;
    }

    public function index()
    {
        //
        $collaborator_waiting = $this->collaborator->getWaitingCollaborator();
        $collaborator_actived = $this->collaborator->getActivedCollaborator();
        return view('admin.collaborator.index',compact(['collaborator_waiting','collaborator_actived']));
    }

    public function activeCollaborator($id) {
        $this->collaborator->activeCollaborator($id);
        return Redirect::back();
    }

    public function deleteCollaborator($id) {
        $collaborator = $this->collaborator->where('id',$id)->first();
        $this->association->where('id',$collaborator->assoc_id)->delete();
        $this->collaborator->deleteCollaborator($id);
        Session::flash('success',lang::get('general.success'));
        return Redirect::back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
