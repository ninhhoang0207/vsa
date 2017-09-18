<!-- ./right-2 -->
<div class="right-fix-home fixed">
	<div class="col-md-3 col-xs-12 col-sm-12">
		<!-- form hoivien-->
		<div class="news-right block-home-right">
			<!-- form search-->
			<div class="form-search hidden-xs search-md ">
				<div class="">
					<form id="form-search" method="GET" action="{{ route('searchNews') }}">
						{{ csrf_field() }} 
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Tìm kiếm..." name="keyword" required>
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
							</span>
						</div>
					</form>
					<!-- /input-group -->
				</div>
				<!-- /.col-lg-9 -->
			</div>
			<!-- new-best -->
			<div class="tintuc_right form-right-t ">
				<div class="link-block padd-block text-center-title">
					<a href="{{ route('news.hotNews') }}" class="tintuc left-news">Tin hot</a>
					<div class="border-bottom"></div>
				</div>
				<div class="left-news">
					@if (!count($news_hot))
					Không tìm thấy dữ liệu
					@else
					<!-- ./slide-images -->
					<div class="new-best project-list">
						<?php foreach ($news_hot as $key => $value): ?>
							<a href="{{ route('news.show',['title_slug'=>$value->title_slug]) }}" class="a-link" title="{{ $value->title }}">
								<div class="text-top">
									<div class="row ">
										<div class="col-md-5 col-sm-6 col-xs-12">
											<div class="left-img">
												<img src="{{ Storage::disk('local')->url($value->title_image) }}" class="img-responsive">
											</div>
										</div>
										<div class="col-md-7 col-sm-6 col-xs-12">
											<div class="text-new-1 text-news-hot-t">
												<span class="a-link">{{ str_limit($value->title,$limit=30,$end='...') }}
													<br>
													<span class="h5-tt">{{ Carbon\Carbon::parse($value->posted_at)->format('d/m/Y') }}</span>
												</div>
											</div>
										</div>
									</div>
								</a>
							<?php endforeach ?>
						</div>
						@endif
					</div>
				</div>
				<!-- banner -->
				<!-- tinhot -->
				<div class="tintuc_right form-right-t">
					<div class="link-block padd-block text-center-title">
						<a href="{{ route('news.branchNews') }}" class="tintuc left-news">Tin mới nhất</a>
						<div class="border-bottom"></div>
					</div>
					<div class="left-news">
						@if (!count($news_recent))
						Không có dữ liệu
						@else
						<div class="row">
							<a href="{{ route('news.show',['title_slug'=>$news_recent[0]->title_slug]) }}" title="{{ $news_recent[0]->title }}">
								<div class="col-md-5 col-sm-6 col-xs-12">
									<div class="left-img">
										<img src="{{ Storage::disk('local')->url($news_recent[0]->title_image) }}" class="img-responsive" title="{{ $news_recent[0]->title }}">

									</div>
								</div>
								<div class="col-md-7 col-sm-6 col-xs-12">
									<div class="text-new-1 text-news-hot-t">
										<p class="p-text">{{ $news_recent[0]->title }}</p>
										<div class="tag-link">
											<span class="h5-tt">{{ Carbon\Carbon::parse($news_recent[0]->posted_at)->format('d/m/Y') }}</span>
										</div>
									</div>
								</div>
							</div>
						</a>
						ádas
						<div class="project-list-ul">
							<div class="list-block">
								<ul class="tintuc-list">
									<?php foreach ($news_recent as $key => $value): ?>
										@if ($key > 0)
										<li "><a href="{{ route('news.show',['title_slug'=>$value->title_slug]) }}" title="{{ $value->title }}"><i class="fa fa-plus-circle "></i>{{ str_limit($value->title,$limit=30,$end='...') }}</a></li>
										@endif
									<?php endforeach ?>
								</ul>
							</div>
						</div>
						@endif
					</div>
				</div>
				<!--Form Send-Email -->
				<div class="tintuc_right send-email form-right-t">
					<div class="link-block padd-block text-center-title">
						<a href="#" class="tintuc left-news">Đăng ký để nhận tin ngày </a>
						<div class="border-bottom"></div>
					</div>
					<div class="left-news">
						<!-- ./slide-images -->
						<div class="row">
							<div class="form-search ">
								<div class="col-md-12 pull-right">
									<p>Quý khách vui lòng nhập Email và gửi về cho chúng tôi:</p>
									<div class="input-group top-form-right ">
										<input type="text" class="form-control" placeholder="Nhập email để nhận bản tin">
										<span class="input-group-btn">
											<button class="btn btn-default" type="button"><span class="glyphicon glyphicon-envelope"></span></button>
										</span>
									</div>
									<div class="contact-online">
										<p class="box-title">Liên hệ tin bài và hội viên:</p>
										<div class="text fa fa-phone-square">
											<strong>Ms. Hồng Liên</strong>
											<p>Email:lehonglien.vsa@gmail.com</p>
											<p>Phone:0912319864</p>
										</div>
									</div>

									<div class="contact-online">
										<p class="box-title">Truyền thông và quảng cáo:</p>
										<div class="text fa fa-phone-square">
											<strong>Ms. Minh Thu</strong>
											<p>Email:thunm.vnp@gmail.com</p>
											<p>Phone:0983922298</p>
										</div>
									</div>
									<!-- /input-group -->
								</div>
								<!-- /.col-lg-9 -->
							</div>
						</div>
					</div>
				</div>
				<!--  new-hot -->
				<div class="row">
					<div class="poster col-xs-12">
						<img src="{{ asset('images/banner-1.png') }}" alt="poster" class="img-responsive" style="width: 100%;">
					</div>
				</div>
				<div class="row">
					<div class="poster col-xs-12 ">
						<img src="{{ asset('images/banner-2.png') }}" alt="poster" class="img-responsive" style="width: 100%;">
					</div>
				</div>
				<div class="row">
					<div class="poster col-xs-12">
						<img src="{{ asset('images/banner-3.png') }}" alt="poster" class="img-responsive" style="width: 100%;">
					</div>
				</div>
			</div>
		</div>
		<!--  END-RIGHT -->
	</div>
	<!--3-->
</div>