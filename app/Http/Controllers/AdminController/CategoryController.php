<?php

namespace App\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CategoryModel;
use Redirect;
use Session;
use DB;
use Lang;

class CategoryController extends Controller
{
	
	public function index() {
		$list = CategoryModel::where('parent_id',0)->orderBy('queue')->get(['id','title','parent_id','status']);
		return view('admin.category.index',compact('list'));
	}

	public function get_child_node(Request $request) {
		$parent_id = $request->parent_id;
		$node = CategoryModel::where('parent_id',$parent_id)->get(['id','parent_id','title','status']);
		if (count($node)) {
			foreach ($node as $key => $value) {
				$value->status = $value->status == 0?Lang::get('category/backend.hide'):Lang::get('category/backend.show');
				$value->count = count($value->children()->get());
			}
			return $node->toArray();
		}
		return null;
	}

	public function detail(Request $request) {
		$id = $request->id;
		$data = CategoryModel::where('id',$id)->get(['id','title'])->first();
		if (isset($data)) {
			return $data;
		} 
		return -1;
	}

    //
	public function create() {
		$category = new CategoryModel;
		$list = $category->lists();
		return view('admin.category.create',compact('list'));
	}

	public function store(Request $request) {

		$data = $request->all();
		$parent = CategoryModel::where('id',$data['category_list'])->get(['id','level'])->first();
		$save = array();
		$queue = null;
		if (!isset($parent)) {
			$queue = CategoryModel::find(1);
			$queue = isset($queue)?CategoryModel::find(1)->max('queue')+1:null;
		}
		if (isset($data['title'])) {
			$title_slug = strtolower(str_replace(' ', '-', $this->convert_vi_to_en($data['title']))).time();
			$save = array(
				'title'			=>	$data['title'],
				'title_slug'	=>	$title_slug,
				'level'			=>	isset($parent)?$parent->level+1:1,
				'parent_id'		=>	isset($parent)?$parent->id:0,
				'status'			=>	$data['status'],
				'queue'			=>	$queue,
				);
		}
		$create = CategoryModel::create($save);
		Session::flash('succes','Success!');
		return Redirect::route('admin.category.index');
	}

	public function edit($id = -1) {
		$data = CategoryModel::where('id',$id)->get(['id','title','parent_id','status'])->first();
		$children = CategoryModel::where('parent_id',$id)->get(['id']);
		$category_id = array($data->id);
		foreach ($children as $key => $child) {
			array_push($category_id, $child->id);
		}
		$maxLevel = $this->maxLevel(3,$id);
		$list = CategoryModel::whereNotIn('id',$category_id)->where('level','<',$maxLevel)->orderBy('level')->get(['id','title','level','parent_id']);
		if (isset($data)) 
			return view('admin.category.edit',compact(['data','list']));
	}

	//Check maximum level available that current category can move

	private function maxLevel($level,$id) {
		$child = CategoryModel::where('parent_id',$id)->first();
		if (count($child)) {
			$level--;
			return $this->maxLevel($level,$child->id);
		}
		return $level;
	}

	public function update(Request $request, $id = -1) {
		$data = array(
			'title'		=>	$request->title,
			'title_slug'=> strtolower(str_replace(' ', '-', $this->convert_vi_to_en($request->title))),
			'parent_id'	=>	$request->category_list,
			'status'	=>	$request->status,
			);
		DB::beginTransaction();
		try {
			CategoryModel::where('id',$id)->update($data);//Update data;
			if ($request->status == 0)
				CategoryModel::where('parent_id',$id)->update(['status'=>0]);
			DB::commit();
		} catch (Exception $e) {
			Session::flash('error',Lang::get('general.errors'));
			DB::rollback();
		}
		Session::flash('success',Lang::get('general.success'));
		return Redirect::back();
	}

	public function destroy($id=-1) {
		$category = new CategoryModel;
		$queue = $category->where('id',$id)->get(['queue'])->first();//Update queue
		DB::beginTransaction();
		try {
			if (isset($queue->queue)) {
				$queue_behind = $category->where('queue','>',$queue->queue)->get();
				foreach ($queue_behind as $key => $value) {
					$category->where('id',$value->id)->update(['queue'=>$value->queue-1]);
				}
			}
			DB::commit();
		} catch (Exception $e) {
			DB::rollback();
			Session::flash('error',Lang::get('general.error'));
			return Redirect::back();
		}
		$delete = CategoryModel::where('id',$id)->orWhere('parent_id',$id)->delete();
		Session::flash('success',Lang::get('general.success'));
		return Redirect::back();
	}

	public function addChild($id) {
		if (!isset($id)){
			Session::flash('error',Lang::get('general.error'));
			return Redirect::route('admin.category.index');
		}
		$parent = CategoryModel::where('id',$id)->get(['id','title'])->first();
		return view('admin.category.create_child',compact('parent'));
	}

}
