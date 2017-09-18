@extends('templates.main')

@section('content')
<div class="clear"></div>
<!-- contet -->
<div id="new-page" class="main-page-news">
	<div class="container">
		<div class="row">
			<!--tintuc-left -->
			<div class="left-fix">
				<div class="col-md-9 col-sm-12 col-xs-12">	
					@include('includes.homepage.slide_content')
					<!--Baner-->
					<div class="row banner-info">
						<div class="col-xs-12 ">
							<img src="{{ asset('images/banner5.gif') }}" alt="" class="img-responsive">
						</div>
					</div>
					<div class="newss-tt1 news-environment">
						<!-- phan1-tintuc-moitruong -->
						<div class="row">
							<!-- tintuc -->
							<div class="col-md-6 col-sm-6 col-xs-12 left">
								<!-- Recent news -->
								<div class="tintuc_left">
									<div class="link-block padd-block text-center-title box-title-t">
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
													{{ str_limit($news_news[0]->title,$limit = 50, $end = '...') }}
												</a>
											</div>
											<div class="row content-text">
												<div class="col-md-5 col-sm-5 col-xs-12">
													<a href="{{ route('news.show',['title_slug'=>$news_news[0]->title_slug]) }}" title="{{ $news_news[0]->title }}">
														<img src="{{ Storage::disk('local')->url($news_news[0]->title_image) }}" class="img-responsive" style="width:100%;">
													</a>
												</div>
												<div class="col-md-7 col-sm-7 col-xs-12">
													<p class="p-text">{{ $news_news[0]->description }}</p>
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
													<li>
														<a href="{{ route('news.show',['title_slug'=>$value->title_slug]) }}" title="{{ $value->title }}"><i class="fa fa-plus-circle "></i>{{ str_limit($value->title,$limit=50,$end='...') }}
															@if (Carbon\Carbon::parse($value->posted_at)->diffInDays(Carbon\Carbon::now()) == 0 && $key < 3)
															<span><img src="{{ asset('images/new.gif') }}"></span>
															@elseif ($value->is_hot == 1)
															<span><img src="{{ asset('images/hot.gif') }}"></span>
															@endif
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
									<div class="link-block padd-block text-center-title box-title-t">
										<a href="{{ App\CategoryModel::where('title','Môi trường biển')->first()?route('news.getNewsFromCategory',['category_slug'=>App\CategoryModel::where('title','Môi trường biển')->first()->title_slug]):'' }}" class="tintuc left-news ">Môi trường biển</a>
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
											<div class="row content-text ">
												<div class="col-md-5 col-sm-5 col-xs-12">
													<a href="{{ route('news.show',['title_slug'=>$news_environment[0]->title_slug]) }}" title="{{ $news_environment[0]->title }}">
														<img src="{{ Storage::disk('local')->url($news_environment[0]->title_image) }}" class="img-responsive " style="width:100%;">
													</a>
												</div>
												<div class="col-md-7 col-sm-7 col-xs-12">
													<p class="p-text ">{{ str_limit($news_environment[0]->description,$limit = 200,$end='...') }}</p>
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
															@if (Carbon\Carbon::parse($value->posted_at)->diffInDays(Carbon\Carbon::now()) == 0 && $key < 3)
															<span><img src="{{ asset('images/new.gif') }}"></span>
															@elseif ($value->is_hot == 1)
															<span><img src="{{ asset('images/hot.gif') }}"></span>
															@endif
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
								<img src="{{ asset('images/banner5.gif') }}" alt="" class="img-responsive">
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
												<a href="{{route('video.show',$first->title_slug)}}">{{$first['title']}}</a>
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
															<div class="left-img video-list">
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
																	@if (Carbon\Carbon::parse($list->updated_at)->diffInDays(Carbon\Carbon::now()) == 0 && $key < 3)
																	<span><img src="{{ asset('images/new.gif') }}"></span>
																	@elseif ($list->is_hot == 1)
																	<span><img src="{{ asset('images/hot.gif') }}"></span>
																	@endif
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
								<img src="{{ asset('images/banner5.gif') }}" alt="" class="img-responsive">
							</div>
						</div>
						<!-- phansp+congnghe -->
						<div class="newss-tt1 product-technology">
							<div class="row">
								<!-- sanpham -->
								<div class="col-md-6 col-sm-6 col-xs-12 left">
									<div class="tintuc_left ">
										<div class="link-block padd-block text-center-title box-title-t">
											<a href="{{ route('news.getNewsFromCategory',['category_slug'=>App\CategoryModel::where('title','Sản phẩm mới')->first()?App\CategoryModel::where('title','Sản phẩm mới')->first()->title_slug:'']) }}" class="tintuc left-news ">Sản phẩm mới</a>
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
														<a href="{{ route('news.show',['title_slug'=>$news_product[0]->title_slug]) }}" title="{{ $news_product[0]->title }}" class="a-link">{{ str_limit($news_product[0]->title,$limit=50,$end = '...') }} 
														</a> 
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
														<li><a href="{{ route('news.show',['title_slug'=>$value->title_slug]) }}" title="{{ $value->title }}">
															<i class="fa fa-plus-circle "></i>
															{{ str_limit($value->title,$limit=50,$end = '...') }}
															@if (Carbon\Carbon::parse($value->posted_at)->diffInDays(Carbon\Carbon::now()) == 0 && $key < 3)
															<span><img src="{{ asset('images/new.gif') }}"></span>
															@elseif ($value->is_hot == 1)
															<span><img src="{{ asset('images/hot.gif') }}"></span>
															@endif
															@endif
														</a>
													</li>
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
									<div class="link-block padd-block text-center-title box-title-t">
										<a href="{{ route('news.getNewsFromCategory',['category_slug'=>App\CategoryModel::where('title','Công nghệ mới')->first()?App\CategoryModel::where('title','Công nghệ mới')->first()->title_slug:'']) }}" class="tintuc left-news ">Công nghệ mới</a>
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
												<div> <a href="{{ route('news.show',['title_slug'=>$news_tech[0]->title_slug]) }}" title="{{ $news_tech[0]->title }}" class="a-link ">{{ str_limit($news_tech[0]->title,$limit=50,$end = '...') }}</a></div>
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
													<li><a href="{{ route('news.show',['title_slug'=>$value->title_slug]) }}" title="{{ $value->title }}">
														<i class="fa fa-plus-circle "></i>
														{{ str_limit($value->title,$limit=50) }} 
														@if (Carbon\Carbon::parse($value->posted_at)->diffInDays(Carbon\Carbon::now()) == 0 && $key < 3)
														<span><img src="{{ asset('images/new.gif') }}"></span>
														@elseif ($value->is_hot == 1)
														<span><img src="{{ asset('images/hot.gif') }}"></span>
														@endif
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



		<!-- slide-anh -->
		<div class="banner container">
			<section id="dg-container">
				<div class="dg-container">
					<div class="row">
						<div class="col-xs-12">
							<div class="title">
								<a href="{{ route('gallery') }}">Thư viện ảnh</a>
							</div>
							<div class="dg-wrapper">
								<?php foreach ($galleries as $key => $value): ?>
									<a href="#" title="{{ $value->title }}" class="gallery-image-link">
										<img src="{{ Storage::url($value->avatar) }}" class="img-responsive">
									</a>
								<?php endforeach ?>
							</div>
							<ol class="button" id="lightButton">
								<?php foreach ($galleries as $key => $value): ?>
									<li index="{{ $key }}">
									<?php endforeach ?>
								</li>
							</ol>
							<nav>
								<span class="dg-prev"></span>
								<span class="dg-next"></span>
							</nav>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
	<!--contact-->
	<!-- slide-anh -->

	{{-- fix-nhanthongbao --}}
	@endsection
@push('scripts')
<script>
	console.log($('.gallery-image-link').attr('href'));
	$('.gallery-image-link').attr('href','#');
</script>
@endpush