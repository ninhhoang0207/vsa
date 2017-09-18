<?php

namespace App\Http\Controllers\HomePage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\NewsModel;
use App\CategoryModel;
use App\Video;
use App\User;
use App\Gallery;
use Carbon\Carbon;

class HomeController extends Controller
{

	private $news;
	private $user;
	private $gallery;

	public function __construct() {
		$this->news = new NewsModel;
		$this->user = new User;
		$this->gallery = new Gallery;
	}
    //

	public function index() {
		$news = new NewsModel;
		$news_association = $news->getAssociationNews();
		$news_environment = $news->getNewsByCategory('Môi trường biển',7);
		$news_news = $news->getNewsByCategory('Tin tức',7);
		$news_product = $news->getNewsByCategory('Sản phẩm mới');
		$news_tech = $news->getNewsByCategory('Công nghệ mới');
		
		$news_hot = $news->getHotNews(6);//Right content
		$news_recent = $news->getRecentNews();//Right content
		$events = $news->getEvents();
		$category = new CategoryModel;
		$categories = $category->getCategoryMenu();
		$video = Video::orderBy('id', 'DESC')->paginate(5);
		
		$galleries = $this->gallery->getGallery();
		$personal_association = $this->user->where('is_active',1)->where('role','member_personal')->get();
		$official_association = $this->user->where('is_active',1)->where('role','member_association')->get();
		return view('homepage.index')
					->with([
						'news_association'	=>	$news_association,
						'news_hot'				=>	$news_hot,
						'news_environment'	=>	$news_environment,
						'news_recent'			=>	$news_recent,
						'news_news'				=>	$news_news,
						'news_product'			=>	$news_product,
						'news_tech'				=>	$news_tech,
						'events'					=>	$events,
						'categories'			=>	$categories,
						'video'					=>	$video,
						'galleries'				=>	$galleries,
						'personal_association'	=>	$personal_association,
						'official_association'	=>	$official_association,
						]);
	}
}
