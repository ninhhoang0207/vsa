@extends('templates.main')
@section('content')
<content>
	<!-- contet -->
	<div id="page" class="main-page-news">
		<div class="container">
			<div class="row">
				<!--tintuc-left -->
				<div class="left-fix">
					<div class="col-md-9 col-sm-12 col-xs-12">
						<div class="left-block">
							<!-- ./nav news -->
							<div class="news-content">
								<ul class="breadcrumb">
									<li><a href="{{ route('homepage.index') }}">Trang chủ</a></li>
									<li>
										<a href="#" class="active">Thư viện ảnh</a>
									</li>
								</ul>
								<div class="row">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="tintuc_left">
											<div class="link-block">
												<a href="# " class="tintuc left-news ">Thư viện ảnh</a>
												<div class="border-bottom "></div>
											</div>
											<div class="left-news">

												<!-- ./row-1 -->
												<div class="row">
													<div class="block-item">
														@foreach($galleries as $value)
														<div class="col-md-3 col-sm-3 col-xs-4">
															<div class="items items-img text-center ">
																<img src="{{ Storage::url($value->avatar) }}" alt="avata" class="img-responsive avata-hv">
																<a href="{{ route('gallery.show',['title_slug'=>$value->title_slug]) }}">{{$value->title}}</a>
																<h5>{{Carbon\Carbon::parse($value->posted_at)->format('d/m/Y H:i')}}</h5>
															</div>
														</div>
														@endforeach
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
				<!-- phan3-tintuc-right -->
				@include('includes/homepage.right_content')
				<!-- ./right-2 -->
				<!-- row-1 -->
			</div>
		</div>
	</div>
	<!--contact-->
</content>
@endsection