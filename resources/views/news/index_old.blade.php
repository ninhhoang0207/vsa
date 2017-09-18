@extends('templates.main')

@section('content')
<content>
	<!-- contet -->
	<div id="page" class="main-page-news">
		<div class="container">
			<div class="row">
				<div class="left-fix">
					<div class="col-md-9 col-sm-12 col-xs-12">
						<div class="left-block">
							<!-- ./nav news -->
							<div class="news-content">
								<ul class="breadcrumb">
									<li><a href="{{ route('home') }}">Trang chủ</a></li>
									<li><a href="#">Danh mục tin tức</a></li>
									<li></li>
								</ul>
								<div class="row">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="tintuc_left">
											<div class="link-block">
												<a href="# " class="tintuc left-news ">Danh sách tin tức</a>
												<div class="border-bottom "></div>
											</div>
											<div class="left-news top-block">
												<!-- ./row-1 -->
												<div class="block-item">
													<div class="row">
														<div class="list-content">
															<ul class="news-list-content">
																@if (!$news->total())
																<i>Không có tin tức nào</i>
																@endif
																<?php foreach ($news as $key => $value): ?>
																	<li class="news-item-content">
																		<div class="col-md-2 col-sm-3 ">
																			<a class="img-content" href="{{ route('news.show',['title_slug'=>$value->title_slug]) }}" title="{{ $value->title }}" > 
																				<img src="{{ Storage::disk('local')->url($value->title_image) }}" class="img-news">
																			</a>
																		</div>
																		<div class="col-md-10 col-sm-9 ">
																			<div class="title">
																				<a href="{{ route('news.show',['title_slug'=>$value->title_slug]) }}" title="{{ $value->title }}">{{ str_limit($value->title,$limit=100,$end='...') }} </a>
																				<p class="p-text">{{ str_limit($value->description,$limit=200,$end='...') }}</p>
																			</div>
																			<!--End#title-->
																			<!--End#share-->
																			<p class="comment-share fl-r">Chia sẻ
																				<a href="javascript:void(0);"><i class="fa fa-facebook cricle"></i></a>
																				<a href="javascript:void(0);"><i class="fa fa-twitter cricle"></i></a>
																				<a href="javascript:void(0);"><i class="fa fa-google-plus cricle"></i></a>
																				<a href="javascript:void(0);"><i class="fa fa-linkedincricle"></i></a>
																			</p>
																		</div>
																	</li>
																<?php endforeach ?>
															</ul>
															<!--End#news-list-content-->
															<div class="page-next">
																<nav aria-label="Page navigation">
																	{{ $news->links() }}
																</nav>
															</div>
															<!--End#page-next-->
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
				@include('includes/homepage.right_content')
			</div>
		</div>
	</div>
</content>
@endsection