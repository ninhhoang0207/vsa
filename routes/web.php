<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return view('welcome');
});
Route::group(['prefix' => 'admin', 'middleware' =>	'collaborator'], function() {
	Route::get('','AdminController\NewsController@index')->name('system');
	// =========================================News=======================================
	Route::group(['prefix' => 'news'], function() {
		Route::get('index','AdminController\NewsController@index')->name('admin.news.index');
		Route::get('show/{id?}','AdminController\NewsController@show')->name('admin.news.show');
		Route::post('posted-data','AdminController\NewsController@getNewsPostedData')->name('admin.news.data');
		Route::post('waiting-data','AdminController\NewsController@getNewsWaitingData')->name('admin.news.newsWaitingData');
		Route::get('add','AdminController\NewsController@create')->name('admin.news.add');
		Route::post('add','AdminController\NewsController@store')->name('admin.news.create');
		Route::get('edit/{id?}','AdminController\NewsController@edit')->name('admin.news.edit');
		Route::post('edit/{id?}','AdminController\NewsController@update')->name('admin.news.update');
		Route::get('detail','AdminController\NewsController@getDetail')->name('admin.news.detail');
		Route::get('delete/{id?}','AdminController\NewsController@delete')->name('admin.news.delete');
		Route::get('post-news','AdminController\NewsController@postNews')->name('admin.news.post');
	});
	// =========================================Category=======================================
	Route::group(['prefix' => 'category','middleware'=>'admin'], function() {
		Route::get('index','AdminController\CategoryController@index')->name('admin.category.index');
		Route::get('create','AdminController\CategoryController@create')->name('admin.category.create');
		Route::post('create','AdminController\CategoryController@store')->name('admin.category.createNew');
		Route::get('edit/{id?}','AdminController\CategoryController@edit')->name('admin.category.edit');
		Route::post('edit/{id?}','AdminController\CategoryController@update');
		Route::get('delete/{id?}','AdminController\CategoryController@destroy')->name('admin.category.delete');
		Route::get('detail/{id?}','AdminController\CategoryController@detail')->name('admin.category.detail');
		Route::get('get-child-node','AdminController\CategoryController@get_child_node')->name('admin.category.getChildNode');
		Route::get('add-child/{id?}','AdminController\CategoryController@addChild')->name('admin.category.addChild');
		Route::post('add-child/{id?}','AdminController\CategoryController@store');
	});
	// =========================================Gallery=======================================
	Route::group(['prefix' => 'gallery'], function() {
		Route::get('','AdminController\GalleryController@index')->name('admin.gallery');
		Route::get('create','AdminController\GalleryController@create')->name('admin.gallery.create');
		Route::post('create','AdminController\GalleryController@store');
		Route::get('edit/{id?}','AdminController\GalleryController@edit')->name('admin.gallery.edit');
		Route::post('edit/{id}','AdminController\GalleryController@update');
		Route::get('show/{id?}','AdminController\GalleryController@show')->name('admin.gallery.show');
		Route::post('upload-image','AdminController\GalleryController@uploadImage')->name('admin.gallery.uploadImage');
		Route::post('remove-image','AdminController\GalleryController@removeImage')->name('admin.gallery.removeImage');
		Route::get('delete-image','AdminController\GalleryController@deleteImage')->name('admin.gallery.deleteImage');
		Route::get('get-image','AdminController\GalleryController@getImage')->name('admin.gallery.getImage');
		Route::get('detail','AdminController\GalleryController@getDetail')->name('admin.gallery.detail');
		Route::get('delete/{id?}','AdminController\GalleryController@destroy')->name('admin.gallery.delete');
		Route::post('waiting-data','AdminController\GalleryController@getGalleryWaiting')->name('admin.gallery.galleryWaiting');
		Route::post('posted-data','AdminController\GalleryController@getGalleryPosted')->name('admin.gallery.galleryPosted');
		Route::get('post','AdminController\GalleryController@postGallery')->name('admin.gallery.post');
	});
	// =========================================Video=======================================
	Route::group(['prefix' => 'video'], function() {
		Route::get('/','AdminController\VideoController@admin_index')->name('admin.video.index');
		Route::get( 'show/{id?}', 'AdminController\VideoController@show' )->name('admin.video.show');
		Route::get('video-data','AdminController\VideoController@get_video_data')->name('admin.video.data');
		Route::get('create','AdminController\VideoController@create')->name('admin.video.create');
		Route::post('create','AdminController\VideoController@store')->name('admin.video.store');
		Route::get('detail','AdminController\VideoController@get_detail')->name('admin.video.detail');
		Route::get('edit/{id?}','AdminController\VideoController@edit')->name('admin.video.edit');
		Route::put('edit/{id?}','AdminController\VideoController@update')->name('admin.video.update');
		Route::get('delete/{id?}','AdminController\VideoController@delete')->name('admin.video.delete');
		Route::get('/laravel-filemanager', '\Unisharp\Laravelfilemanager\controllers\LfmController@show');
		Route::post('/laravel-filemanager/upload', '\Unisharp\Laravelfilemanager\controllers\LfmController@upload');
	});
	// =========================================User=======================================
	Route::group(['prefix'=> 'users'],function(){
		
		Route::group(['middleware'=>'admin'], function() {
			// Route::get('create','AdminController\UserController@admin_index')->name('user.index');
			// Route::post('create','AdminController\UserController@add')->name('user.create');
			Route::post('check_mail','AdminController\UserController@check_email')->name('user.check_email');
			Route::get('list','AdminController\UserController@list_users')->name('user.list');
			Route::get('user-data','AdminController\UserController@get_user_data')->name('user.data');
			Route::get('detail','AdminController\UserController@get_detail')->name('user.detail');
			Route::post('delete/{id?}','AdminController\UserController@delete')->name('user.delete');
		});

		Route::group(['middleware'=>'user_info'], function() {
			Route::get('edit/{id?}','AdminController\UserController@edit')->name('user.edit');
			Route::post('edit/{id}','AdminController\UserController@update')->name('user.update');
		});
	});
	// =========================================Member=======================================
	Route::group(['prefix'=> 'members','middleware'=>'admin'],function(){
		Route::get('personal','AdminController\MemberController@personalMember')->name('admin.member.personalMember');
		Route::get('association','AdminController\MemberController@associationMember')->name('admin.member.associationMember');
		Route::get('active-member/{id}','AdminController\MemberController@activeMember')->name('admin.member.activeMember');
		Route::get('delete-member/{id?}','AdminController\MemberController@deleteMember')->name('admin.member.deleteMember');
	});
	// =========================================Collaborator=======================================
	Route::group(['prefix'=> 'collaborator','middleware'=>'admin'],function(){
		Route::get('','AdminController\CollaboratorController@index')->name('admin.collaborator');
		Route::get('active-collaborator/{id}','AdminController\CollaboratorController@activeCollaborator')->name('admin.collaborator.activeCollaborator');
		Route::get('delete-collaborator/{id?}','AdminController\CollaboratorController@deleteCollaborator')->name('admin.collaborator.deleteCollaborator');
	});
	// =========================================Contact=======================================
	Route::group(['prefix'=> 'contact','middleware'=>'admin'],function(){
		Route::get('','AdminController\ContactController@index')->name('admin.contact');
		Route::get('delete/{id?}','AdminController\ContactController@destroy')->name('admin.contact.delete');
		Route::get('detail','AdminController\ContactController@detail')->name('admin.contact.detail');
	});
});
Auth::routes();
Route::post('quick-log-in', 'Auth\LoginController@quickLogin')->name('quickLogin');
Route::post('quick-register', 'Auth\RegisterController@quickRegister')->name('quickRegister');
Route::group(['prefix'=>'socialite'], function() {
	Route::get('redirect/{provider}','Auth\SocialiteController@redirectToProvider')->name('socialite.redirect');
	Route::get('callback/{provider}','Auth\SocialiteController@handleProviderCallback')->name('socialite.callback');
});

Route::get('/home', 'HomeController@index')->name('home');

// ============================================Home Page=============================================
Route::get('','HomePage\HomeController@index')->name('homepage.index');
Route::get('show/{id}','HomePage\HomeController@show')->name('homepage.show');

Route::get('news/{id?}','HomePage\NewsController@index')->name('news.index');
Route::get('news-association','HomePage\NewsController@getNewsAssociation')->name('news.association');
Route::get('news/show/{slug?}','HomePage\NewsController@show')->name('news.show');
Route::get('news/category/{category_slug}','HomePage\NewsController@getNewsFromCategory')->name('news.getNewsFromCategory');
Route::get( 'video/{slug}','AdminController\VideoController@showDetail' )->name( 'video.show' );
Route::post('addcomment/{slug}','AdminController\VideoController@addcomment')->name('comment');
Route::post('addcommentNews/{slug}','HomePage\NewsController@addcomment')->name('comment.news');
Route::get('category/tin-tuc','HomePage\NewsController@getNewsPost');
Route::get('category/moi-truong-bien','HomePage\NewsController@getEnvironmentNews');
Route::get('hot-news','HomePage\NewsController@getHotNews')->name('news.hotNews');
Route::get('branch-news','HomePage\NewsController@getBranchNews')->name('news.branchNews');
Route::get('event','HomePage\NewsController@getEvents')->name('news.event');
//Search news
Route::get('search-news','HomePage\NewsController@searchNews')->name('searchNews');
// Route::group(['prefix'=>'member'], function() {
// 	Route::group(['prefix'=>'register'], function() {
// 		Route::get('private-member', 'HomePage\MemberController@createPrivateMember')->name('member.createPrivateMember');
// 	});
// });
// Association
Route::group(['prefix'=>'members'],function(){
	Route::group(['prefix'=>'register'],function(){
		Route::get('','HomePage\MemberController@index')->name('member.register');
		Route::get('personal','HomePage\MemberController@registerMember')->name('member.register.personal');
		Route::post('personal','HomePage\MemberController@postRegisterMember');
		Route::get('association','HomePage\MemberController@registerAssociation')->name('member.register.association');
		Route::post('association','HomePage\MemberController@postRegisterAssociation');
	});
	Route::get('personal','HomePage\MemberController@list_personal')->name('member.personal');
	Route::get('personal/{id}','HomePage\MemberController@detail_personal')->name('member.personal.show');
	Route::get('association','HomePage\MemberController@list_association')->name('member.association');
	Route::get('association/{id}','HomePage\MemberController@detail_association')->name('member.association.show');
	Route::get('edit','HomePage\MemberController@edit')->name('member.edit');
	Route::post('edit','HomePage\MemberController@update');
});
//Gallery
Route::group(['prefix'=>'gallery'], function() {
	Route::get('', 'HomePage\GalleryController@index')->name('gallery');
	Route::get('show/{title_slug}','HomePage\GalleryController@show')->name('gallery.show');
});
// Contact
Route::group(['prefix'=>'contact'], function() {
	Route::get('','HomePage\ContactController@index')->name('contact');
	Route::post('','HomePage\ContactController@sendContact');
});
//Collaborator
Route::group(['prefix'=>'collaborator'], function() {
	Route::get('register','HomePage\CollaboratorController@register')->name('collaborator.register');
	Route::post('register','HomePage\CollaboratorController@postRegister');
});

