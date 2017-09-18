@extends('templates.main')

@section('content')
@include('includes/homepage.slide_content')
<div class="clear"></div>
<!-- contet -->
<div id="new-page" class="main-page-news">
	<div class="container">
		<div class="row">
			<!--tintuc-left -->
			<div class="left-fix">
				<div class="col-md-9 col-sm-12 col-xs-12">		
					<div class="newss-tt1">
						<!-- phan1-tintuc-moitruong -->
						<div class="row">
							<!-- tintuc -->
							<div class="col-md-6 col-sm-6 col-xs-12 left">
								<!-- Recent news -->
								<div class="tintuc_left">
									<div class="link-block padd-block">
										<a href="{{ route('news.getNewsFromCategory',['category_slug'=>App\CategoryModel::where('title','Tin tức')->first()?App\CategoryModel::where('title','Tin tức')->first()->title_slug:'']) }}" class="tintuc left-news">Tin Tức</a>
										<div class="border-bottom"></div>
									</div>
									<!-- Tin tuc -->
									@if (!count($news_news))
									Không tìm thấy dữ liệu
									@else
									<div class="left-news">
										<div class="text-top">
											<div class="title-text">
												<a href="{{ route('news.show',['title_slug'=>$news_news[0]->title_slug]) }}" title="{{ $news_news[0]->title }}" class="a-link">
													<!-- <a href="{{ route('news.show',['id'=>$news_news[0]->id]) }}" title="{{ $news_news[0]->title }}" class="a-link"> -->
													{{ str_limit($news_news[0]->title,$limit = 50, $end = '...') }}
													<span><img src="{{ asset('images/new-1.gif') }}" border="0"></span>
												</a>
											</div>
											<div class="content-text">
												<div class="col-md-5">
													<a href="{{ route('news.show',['title_slug'=>$news_news[0]->title_slug]) }}" title="{{ $news_news[0]->title }}">
														<img src="{{ Storage::disk('local')->url($news_news[0]->title_image) }}" class="img-news" width="167px" >
													</a>
												</div>
												<div class="col-md-7">
													<p class="p-text">{{ $news_news[0]->description }} <span><img src="{{ asset('images/new-1.gif') }}" border="0"></span></p>
													<div class="tag-link">
														<a href="#" class="link-thoisu"> <span class="glyphicon glyphicon-forward"></span> Tin thời sự </a>
													</div>
												</div>
											</div>
										</div>
										<div class="list-block">
											<ul class="tintuc-list">
												<?php foreach ($news_news as $key => $value): ?>
													@if ($key > 0)
													<li ">
														<a href="{{ route('news.show',['title_slug'=>$value->title_slug]) }}" title="{{ $value->title }}"><i class="fa fa-plus-circle "></i>{{ str_limit($value->title,$limit=50,$end='...') }}
														</a>
													</li>
													@endif
												<?php endforeach ?>
											</ul>
										</div>
									</div>
									@endif
								</div>
								<!-- End recent news -->
							</div>
							<!--1-->
							<!-- moitruong -->
							<div class="col-md-6 col-sm-6 col-xs-12 right ">
								<div class="tintuc_left ">
									<div class="link-block padd-block ">
										<a href="{{ App\CategoryModel::where('title','Môi trường biển')->first()?route('news.getNewsFromCategory',['category_slug'=>App\CategoryModel::where('title','Môi trường biển')->first()->title_slug]):'' }}" class="tintuc left-news ">Môi trường</a>
										<div class="border-bottom "></div>
									</div>
									@if (!count($news_environment))
									Không tìm thấy dữ liệu
									@else
									<div class="left-news ">
										<div class="text-top ">
											<div class="title-text">
												<a href="{{ route('news.show',['title_slug'=>$news_environment[0]->title_slug]) }}" title="{{ $news_environment[0]->title }}" class="a-link ">{{ str_limit($news_environment[0]->title,$limit = 50,$end = '...') }}</a>
											</div>
											<div class="content-text ">
												<div class="col-md-5 ">
													<a href="{{ route('news.show',['title_slug'=>$news_environment[0]->title_slug]) }}" title="{{ $news_environment[0]->title }}">
														<img src="{{ Storage::disk('local')->url($news_environment[0]->title_image) }}" class="img-news ">
													</a>
												</div>
												<div class="col-md-7 ">
													<p class="p-text ">{{ str_limit($news_environment[0]->description,$limit = 200,'...') }}</p>
													<div class="tag-link ">
														<a href="# " class="link-thoisu "> <span class="glyphicon glyphicon-forward "></span> Tin thời sự </a>
													</div>
												</div>
											</div>
										</div>
										<div class="list-block ">
											<ul class="tintuc-list ">
												<?php foreach ($news_environment as $key => $value): ?>
													@if ($key > 0)
													<li>
														<a href="{{ route('news.show',['title_slug'=>$value->title_slug]) }}" title=" {{ $value->title }} ">
															<i class="fa fa-plus-circle "></i>
															{{ str_limit($value->title,$limit=50,$end = '...') }}
															<span>
														</a>
														<img src="{{ asset('images/new-1.gif') }}" border="0"></span>
													</li>
													@endif
												<?php endforeach ?>
											</ul>
										</div>
									</div>
									@endif
								</div>
								<!-- End evironment news -->
							</div>
							<!--1-->
						</div>
					</div>
					<!--Baner-->
					<div class="row banner-info">
					<div class="col-xs-12 ">
						<img src="images/banner5.gif" alt="" class="img-responsive">
					</div>
					</div>
					<!-- phan2-tintuc-video -->
						<div class="newss-tt1 info-video">
						<div class="tintuc_left">
							<div class="link-block padd-block video-content">
								<a href="{{-- {{route('video.show',['id'=>$list->title_slug])}} --}}" class="tintuc left-news "> <span class="glyphicon glyphicon-facetime-video"></span> Video chọn lọc </a>
								<div class="border-bottom "></div>
							</div>
								{{-- tao video id khac nhau ko bi trung --}}
							<div class="left-news">
							@if (!count($video))
		                    Không tìm thấy dữ liệu
		                    @else
								<div class="row">
										@php
											$first = $video->shift();
										@endphp
											<div class="col-md-7 col-xs-6 col-sm-7 top-video hidden-xs">
												<div class="video-left-one">
													<a href="{{route('video.show',$first->title_slug)}}">
													<img src="{{URL::asset($first->title_image)}}" class="img-responsive video-right" style="width: 100%;">
													{{-- <span class='bg'><span class='icon'>&nbsp;</span></span> --}}
													</a>
												</div>
												<div class="title"> 
							                           <a href="{{route('video.show',$first->title_slug)}}">{{$first['title']}}
							                           	<span><img src="{{ asset('images/hot_1.gif') }}" border="0"></span>
							                           </a>
							          </div>
		                    <div class="news-video-p">
		                    <p>{{ $first->created_at->diffForHumans() }} </p>
		                    </div>
											</div>
										<div class="col-md-5 col-xs-12 col-sm-5 top-video">
										<div class="project-list-video">
												@foreach( $video as $key => $list)
												<div class="video-top ">
													<div class="row">
														<div class="col-md-5 col-sm-6 col-xs-6">
															<div class="left-img">
																<a href="{{route('video.show',$list->title_slug)}}">
																<img src="{{URL::asset($list->title_image)}}" class="img-responsive video-right">
																</a>
																 <div class="news-video-p">
											                  <p>{{ $list->created_at->diffForHumans() }} </p>
							                  </div>
															</div>
														</div>
														<div class="col-md-7 col-sm-6 col-xs-6">
															<div class="title-right">
																<a href="{{route('video.show',$list->title_slug)}}">{{$list['title']}}
																	<span><img src="{{ asset('images/new-1.gif') }}" border="0"></span>
																</a>
															</div>
														</div>
													</div>
												</div>
												@endforeach
										</div>
										</div>
										{{-- copy here --}}
											
										<!-- video-4-->	
								</div>
								@endif
							</div>
							</div>
							<!-- row-1-->
						</div>
					<!-- row-1-->
				<!--Baner-->
				<div class="row banner-info">
				<div class="col-xs-12 ">
					<img src="images/banner5.gif" alt="" class="img-responsive">
				</div>
				</div>
				<!-- phansp+congnghe -->
				<div class="newss-tt1">
					<div class="row">
						<!-- sanpham -->
						<div class="col-md-6 col-sm-6 col-xs-12 left">
							<div class="tintuc_left ">
								<div class="link-block padd-block ">
									<a href="{{ route('news.getNewsFromCategory',['category_slug'=>App\CategoryModel::where('title','Sản phẩm')->first()?App\CategoryModel::where('title','Sản phẩm')->first()->title_slug:'']) }}" class="tintuc left-news ">Sản phẩm</a>
									<div class="border-bottom "></div>
								</div>
								<div class="left-news ">
									@if (!count($news_product))
									<div class="text-top ">
										<div class="left-img ">
											<h3>Không tìm thấy dữ liệu</h3>
										</div>
									</div>
									@else
									<div class="text-top ">
										<div class="left-img ">
											<a href="{{ route('news.show',['title_slug'=>$news_product[0]->title_slug]) }}" title="{{ $news_product[0]->title }}"><img src="{{ Storage::disk('local')->url($news_product[0]->title_image) }}" class="img-news"></a>
										</div>
										<div class="text-new-1 ">
											<div> 
												<a href="{{ route('news.show',['title_slug'=>$news_product[0]->title_slug]) }}" title="{{ $news_product[0]->title }}" class="a-link">{{ str_limit($news_product[0]->title,$limit=50,$end = '...') }} <span><img src="{{ asset('images/hot_1.gif') }}" border="0"></a> 
											</div>
											<div class="tag-link ">
												<a href="#" class="link-thoisu ">Tin thời sự  <span class="h5-tt pull-right ">{{ Carbon\Carbon::parse($news_product[0]->posted_at)->format('d/m/Y') }}</span></a>
											</div>
											<p class="p-text ">{{ str_limit($news_product[0]->description,$limit=200,$end = '...') }}</p>
										</div>
									</div>
									<div class="list-block ">
										<ul class="tintuc-list ">
											<?php foreach ($news_product as $key => $value): ?>
												@if ($key > 0)
												<li><a href="{{ route('news.show',['title_slug'=>$value->title_slug]) }}" title="{{ $value->title }}"><i class="fa fa-plus-circle "></i>{{ str_limit($value->title,$limit=50,$end = '...') }} 	<span><img src="{{ asset('images/new-1.gif') }}" border="0"></a></li>
												@endif
											<?php endforeach ?>
										</ul>
									</div>
									@endif
								</div>
							</div>
						</div>
						<!--1-->
						<!-- congnghe -->
						<div class="col-md-6 col-sm-6 col-xs-12 right ">
							<div class="tintuc_left ">
								<div class="link-block padd-block ">
									<a href="{{ route('news.getNewsFromCategory',['category_slug'=>App\CategoryModel::where('title','Công nghệ')->first()?App\CategoryModel::where('title','Công nghệ')->first()->title_slug:'']) }}" class="tintuc left-news ">Công nghệ</a>
									<div class="border-bottom "></div>
								</div>
								<div class="left-news ">
									@if (!count($news_tech))
									<div class="text-top ">
										<div class="left-img ">
											<h3>Không tìm thấy dữ liệu</h3>
										</div>
									</div>
									@else
									<div class="text-top ">
										<div class="left-img ">
											<a href="{{ route('news.show',['title_slug'=>$news_tech[0]->title_slug]) }}" title="{{ $news_tech[0]->title }} "><img src="{{ Storage::disk('local')->url($news_tech[0]->title_image) }}" class="img-news "></a>
										</div>
										<div class="text-new-1 ">
											<div> <a href="{{ route('news.show',['title_slug'=>$news_tech[0]->title_slug]) }}" title="{{ $news_tech[0]->title }}" class="a-link ">{{ str_limit($news_tech[0]->title,$limit=50,$end = '...') }}</a> <span><img src="{{ asset('images/new-1.gif') }}" border="0"></span> </div>
											<div class="tag-link ">
												<a href="# " class="link-thoisu ">Tin thời sự  <span class="h5-tt pull-right ">{{ Carbon\Carbon::parse($news_tech[0]->posted_at)->format('d/m/Y') }}</span></a>
											</div>
											<p class="p-text ">{{ str_limit($news_tech[0]->description,$limit=200,$end = '...') }}</p>
										</div>
									</div>
									<div class="list-block">
										<ul class="tintuc-list">
											<?php foreach ($news_tech as $key => $value): ?>
												@if ($key > 0)
												<li><a href="{{ route('news.show',['title_slug'=>$value->title_slug]) }}" title="{{ $value->title }}"><i class="fa fa-plus-circle "></i>{{ str_limit($value->title,$limit=50) }} <span><img src="{{ asset('images/new-1.gif') }}" border="0"></span></a></li>
												@endif
											<?php endforeach ?>
										</ul>
									</div>
									@endif
								</div>
							</div>
						</div>
						<!--1-->
						<!--2-->
					</div>
				</div>
			</div>
			</div>
		
		<!-- phan3-tintuc-right -->
		<!-- ./right-2 -->
		@include('includes/homepage.right_content_homepage')
		<!-- row-1 -->
	</div>
</div>
</div>
<!--contact-->
<!-- slide-anh -->
<!-- slide-anh -->
<div class="container">
	<div class="slide-show">
		<div class="row">
			<div class="col-xs-12 col-md-12">
				<div id="carousel-example" class="carousel slide team team-web-view" data-ride="carousel">
					<!-- Wrapper for slides -->
					<div class="carousel-inner">
						<div class="item active hovergallery text-center">
							<div class="row">
								<div class="col-md-2 col-sm-4 col-xs-6">
									<div class="col-item">
										<div class="photo-shadow"></div>
										<div class="photo">
											<img src="http://www.charlottenursey.co.uk/wp-content/themes/charlotte-nursey/images/charlotte-nursey-profile.jpg" alt="User one">
										</div>
										<div class="info">
											<div class="name">Rohit Sharma</div>
											<div class="degination">Director</div>
											<div class="social-connect">
												<a href="javascript:void(0);"><i class="fa fa-facebook cricle"></i></a>
												<a href="javascript:void(0);"><i class="fa fa-twitter cricle"></i></a>
												<a href="javascript:void(0);"><i class="fa fa-google-plus cricle"></i></a>
												<a href="javascript:void(0);"><i class="fa fa-linkedincricle"></i></a>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								<div class="col-md-2 col-sm-4 col-xs-6">
									<div class="col-item">
										<div class="photo-shadow"></div>
										<div class="photo">
											<img src="http://www.charlottenursey.co.uk/wp-content/themes/charlotte-nursey/images/charlotte-nursey-profile.jpg" class="img-responsive" alt="Charles John">
										</div>
										<div class="info">
											<div class="name">Giselle Childs</div>
											<div class="degination">Expert Agent</div>
											<div class="social-connect">
												<a href="javascript:void(0);"><i class="fa fa-facebook cricle"></i></a>
												<a href="javascript:void(0);"><i class="fa fa-twitter cricle"></i></a>
												<a href="javascript:void(0);"><i class="fa fa-google-plus cricle"></i></a>
												<a href="javascript:void(0);"><i class="fa fa-linkedin cricle"></i></a>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								<div class="col-md-2 col-sm-4 col-xs-6">
									<div class="col-item">
										<div class="photo-shadow"></div>
										<div class="photo">
											<img src="http://www.appstate.edu/academics/profiles/_images/scott-collier-400x400.jpg" class="img-responsive" alt="Charlotte Law">
										</div>
										<div class="info">
											<div class="name">Scott Collier</div>
											<div class="degination">Expert Agent</div>
											<div class="social-connect">
												<a href="javascript:void(0);"><i class="fa fa-facebook cricle"></i></a>
												<a href="javascript:void(0);"><i class="fa fa-twitter cricle"></i></a>
												<a href="javascript:void(0);"><i class="fa fa-google-plus cricle"></i></a>
												<a href="javascript:void(0);"><i class="fa fa-linkedin cricle"></i></a>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								<div class="col-md-2 col-sm-4 col-xs-6">
									<div class="col-item">
										<div class="photo-shadow"></div>
										<div class="photo">
											<img src="http://ina-law.co.za/wp-content/uploads/Illse-Nieuwoudt-Profile.jpg" alt="Coleman Harmon">
										</div>
										<div class="info">
											<div class="name">Notary</div>
											<div class="degination">Expert Agent</div>
											<div class="social-connect">
												<a href="javascript:void(0);"><i class="fa fa-facebook cricle"></i></a>
												<a href="javascript:void(0);"><i class="fa fa-twitter cricle"></i></a>
												<a href="javascript:void(0);"><i class="fa fa-google-plus cricle"></i></a>
												<a href="javascript:void(0);"><i class="fa fa-linkedin cricle"></i></a>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								<div class="col-md-2 col-sm-4 col-xs-6">
									<div class="col-item">
										<div class="photo-shadow"></div>
										<div class="photo">
											<img src="http://ina-law.co.za/wp-content/uploads/Illse-Nieuwoudt-Profile.jpg" alt="Coleman Harmon">
										</div>
										<div class="info">
											<div class="name">Notary</div>
											<div class="degination">Expert Agent</div>
											<div class="social-connect">
												<a href="javascript:void(0);"><i class="fa fa-facebook cricle"></i></a>
												<a href="javascript:void(0);"><i class="fa fa-twitter cricle"></i></a>
												<a href="javascript:void(0);"><i class="fa fa-google-plus cricle"></i></a>
												<a href="javascript:void(0);"><i class="fa fa-linkedin cricle"></i></a>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								<div class="col-md-2 col-sm-4 col-xs-6">
									<div class="col-item">
										<div class="photo-shadow"></div>
										<div class="photo">
											<img src="http://ina-law.co.za/wp-content/uploads/Illse-Nieuwoudt-Profile.jpg" alt="Coleman Harmon">
										</div>
										<div class="info">
											<div class="name">Notary</div>
											<div class="degination">Expert Agent</div>
											<div class="social-connect">
												<a href="javascript:void(0);"><i class="fa fa-facebook cricle"></i></a>
												<a href="javascript:void(0);"><i class="fa fa-twitter cricle"></i></a>
												<a href="javascript:void(0);"><i class="fa fa-google-plus cricle"></i></a>
												<a href="javascript:void(0);"><i class="fa fa-linkedin cricle"></i></a>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="item hovergallery text-center ">
							<div class="row">
								<div class="col-md-2 col-sm-4 col-xs-6">
									<div class="col-item">
										<div class="photo-shadow"></div>
										<div class="photo">
											<img src="http://www.charlottenursey.co.uk/wp-content/themes/charlotte-nursey/images/charlotte-nursey-profile.jpg" alt="User one">
										</div>
										<div class="info">
											<div class="name">Rohit Sharma</div>
											<div class="degination">Director</div>
											<div class="social-connect">
												<a href="javascript:void(0);"><i class="fa fa-facebook cricle"></i></a>
												<a href="javascript:void(0);"><i class="fa fa-twitter cricle"></i></a>
												<a href="javascript:void(0);"><i class="fa fa-google-plus cricle"></i></a>
												<a href="javascript:void(0);"><i class="fa fa-linkedin cricle"></i></a>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								<div class="col-md-2 col-sm-4 col-xs-6">
									<div class="col-item">
										<div class="photo-shadow"></div>
										<div class="photo">
											<img src="http://www.charlottenursey.co.uk/wp-content/themes/charlotte-nursey/images/charlotte-nursey-profile.jpg" class="img-responsive" alt="Charles John">
										</div>
										<div class="info">
											<div class="name">Giselle Childs</div>
											<div class="degination">Expert Agent</div>
											<div class="social-connect">
												<a href="javascript:void(0);"><i class="fa fa-facebook cricle"></i></a>
												<a href="javascript:void(0);"><i class="fa fa-twitter cricle"></i></a>
												<a href="javascript:void(0);"><i class="fa fa-google-plus cricle"></i></a>
												<a href="javascript:void(0);"><i class="fa fa-linkedin cricle"></i></a>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								<div class="col-md-2 col-sm-4 col-xs-6">
									<div class="col-item">
										<div class="photo-shadow"></div>
										<div class="photo">
											<img src="http://www.appstate.edu/academics/profiles/_images/scott-collier-400x400.jpg" class="img-responsive" alt="Charlotte Law">
										</div>
										<div class="info">
											<div class="name">Scott Collier</div>
											<div class="degination">Expert Agent</div>
											<div class="social-connect">
												<a href="javascript:void(0);"><i class="fa fa-facebook cricle"></i></a>
												<a href="javascript:void(0);"><i class="fa fa-twitter cricle"></i></a>
												<a href="javascript:void(0);"><i class="fa fa-google-plus cricle"></i></a>
												<a href="javascript:void(0);"><i class="fa fa-linkedin cricle"></i></a>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								<div class="col-md-2 col-sm-4 col-xs-6">
									<div class="col-item">
										<div class="photo-shadow"></div>
										<div class="photo">
											<img src="http://ina-law.co.za/wp-content/uploads/Illse-Nieuwoudt-Profile.jpg" alt="Coleman Harmon">
										</div>
										<div class="info">
											<div class="name">Notary</div>
											<div class="degination">Expert Agent</div>
											<div class="social-connect">
												<a href="javascript:void(0);"><i class="fa fa-facebook cricle"></i></a>
												<a href="javascript:void(0);"><i class="fa fa-twitter cricle"></i></a>
												<a href="javascript:void(0);"><i class="fa fa-google-plus cricle"></i></a>
												<a href="javascript:void(0);"><i class="fa fa-linkedin cricle"></i></a>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								<div class="col-md-2 col-sm-4 col-xs-6">
									<div class="col-item">
										<div class="photo-shadow"></div>
										<div class="photo">
											<img src="http://ina-law.co.za/wp-content/uploads/Illse-Nieuwoudt-Profile.jpg" alt="Coleman Harmon">
										</div>
										<div class="info">
											<div class="name">Notary</div>
											<div class="degination">Expert Agent</div>
											<div class="social-connect">
												<a href="javascript:void(0);"><i class="fa fa-facebook cricle"></i></a>
												<a href="javascript:void(0);"><i class="fa fa-twitter cricle"></i></a>
												<a href="javascript:void(0);"><i class="fa fa-google-plus cricle"></i></a>
												<a href="javascript:void(0);"><i class="fa fa-linkedin cricle"></i></a>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								<div class="col-md-2 col-sm-4 col-xs-6">
									<div class="col-item">
										<div class="photo-shadow"></div>
										<div class="photo">
											<img src="http://ina-law.co.za/wp-content/uploads/Illse-Nieuwoudt-Profile.jpg" alt="Coleman Harmon">
										</div>
										<div class="info">
											<div class="name">Notary</div>
											<div class="degination">Expert Agent</div>
											<div class="social-connect">
												<a href="javascript:void(0);"><i class="fa fa-facebook cricle"></i></a>
												<a href="javascript:void(0);"><i class="fa fa-twitter cricle"></i></a>
												<a href="javascript:void(0);"><i class="fa fa-google-plus cricle"></i></a>
												<a href="javascript:void(0);"><i class="fa fa-linkedin cricle"></i></a>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection