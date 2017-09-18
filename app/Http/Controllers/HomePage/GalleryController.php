<?php

namespace App\Http\Controllers\Homepage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect, Session, Storage, Auth;
use App\User;
use App\Gallery;
use Carbon\Carbon;
use App\NewsModel;
use App\CategoryModel;

class GalleryController extends Controller
{
	private $news;
	private $news_recent;
	private $news_hot;
	private $categories;
	private $user;
	private $gallery;

	public function __construct() {
        $this->user = new User;
        $this->news = new NewsModel;
        $this->news_hot = $this->news->getHotNews();//Right content
        $this->news_recent = $this->news->getRecentNews();//Right content
        $category = new CategoryModel;
        $this->categories = $category->getCategoryMenu();
        $this->gallery = new Gallery;
    }
    //
	public function index() {
		$galleries = $this->gallery->getGallery();
		$news_hot = $this->news_hot;
		$news_recent = $this->news_recent;
		$categories = $this->categories;

		return view('gallery.index',compact(['galleries','news_hot','news_recent','categories']));
	}

	public function show($title_slug = ''){
		if ($title_slug == '')
			return Redirect::route('homepage.index');
		
		$gallery = $this->gallery->where('is_active',1)->where('title_slug',$title_slug)->get(['id','title','posted_at','created_by'])->first();
		$galleries = $this->gallery->getGallery();
		$news_hot = $this->news_hot;
		$news_recent = $this->news_recent;
		$categories = $this->categories;

		
		return view('gallery.show',compact(['gallery','news_hot','news_recent','categories']));
	}
}
