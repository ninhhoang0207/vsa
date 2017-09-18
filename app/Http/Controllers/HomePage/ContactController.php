<?php

namespace App\Http\Controllers\HomePage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\NewsModel;
use App\CategoryModel;
use App\Contact;
use Carbon\Carbon;
use Session;
use Redirect;


class ContactController extends Controller
{
    //
	private $news;

	public function __construct() {
		$this->news = new NewsModel;
	}

	public function index() {
		$news_hot = $this->news->getHotNews();//Right content
		$news_recent = $this->news->getRecentNews();//Right content
		
		$category = new CategoryModel;
		$categories = $category->getCategoryMenu();
		return view('contact.index',compact(['news_hot','news_recent','categories']));
	}

	public function sendContact(Request $request) {
		$data = $request->except('_token');
		Session::flash('success', 'Nội dung liên hệ của bạn đã được gửi về hệ thống.');
		Contact::create($data);
		return Redirect::route('homepage.index');
	}
}
