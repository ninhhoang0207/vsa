@extends('templates.main')

@section('title')

@endsection

@section('content')
<content>
	<form id="form-contact" method="POST">
	{{ csrf_field() }}
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
										<li><a href="#">Liên hệ</a></li>
									</ul>
									<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="tintuc_left">
												<div class="link-block">
													<a href="# " class="tintuc left-news ">Liên hệ</a>
													<div class="border-bottom "></div>
												</div>
												<div class="form-left top-block">
													<!-- ./row-1 -->
													<form action="" method="POST" role="form">
														<div class="row">
															<div class="col-md-6 col-sm-6 col-xs-12">
																<div class="form-group">
																	<input type="text" class="form-control form-text" id="" placeholder="Họ và tên *" name="name" required>
																	<input type="text" class="form-control form-text" id="" placeholder="Email *" name="email" required>
																	<input type="text" class="form-control form-text" id="" placeholder="Số điện thoại *" name="phone">
																</div>
															</div>
															<div class="col-md-6 col-sm-6 col-xs-12">
																<div class="form-group">
																	<input type="text" class="form-control form-text letter-text" id="" placeholder="Nội dung *" name="content" required>
																	<button type="submit" class="btn btn-submit-letter">Gửi </button>
																</div>
															</div>
														</div>
													</form>
													<div id="map" style="max-width: 100%; height: 500px;"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- phan3-tintuc-right -->
					@include('includes.homepage.right_content')
					<!-- row-1 -->
				</div>
			</div>
		</div>
		<!--contact-->
	</form>
</content>
@endsection
@push('scripts')
<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
  <script type="text/javascript">
  var locations = [
    ['Hiệp Hội nuôi biển Việt Nam - 30 ngõ 24, 24 ngõ 298 Ngọc Lâm, Long Biên, Hà Nội, Việt Nam', 21.042820, 105.866954,1]
  ];

  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 14,
    center: new google.maps.LatLng(21.043421, 105.866911),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  

  var infowindow = new google.maps.InfoWindow({
    });
  var marker, i;

  for (i = 0; i < locations.length; i++) {
    marker = new google.maps.Marker({
      position: new google.maps.LatLng(locations[i][1], locations[i][2]),
      map: map
       // icon: icon
    });

    google.maps.event.addListener(marker, 'click', (function(marker, i) {
      return function() {
        infowindow.setContent(locations[i][0]);
        infowindow.open(map, marker);
      }
    })(marker, i));
  }
  </script>


@endpush