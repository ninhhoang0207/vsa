<header>
	<div id="header-top">
		<div class="header-top">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-md-12">
						<div class="icon-header col-md-8 col-xs-12">
							<a href="#"><i class="fa fa-facebook cricle"></i></a>
							<a href="#"><i class="fa fa-twitter cricle"></i></a>
							<a href="#"><i class="fa fa-linkedin cricle"></i></a>
						</div>
						<!-- User Model -->
						<div class="hidden-xs col-md-4 pull-right" id="right-menu-bar">
							@include('includes/homepage.login_model')
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--row-1-->
	<div class="header-winner">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-md-9 ">
					<div class="col-xs-12 col-md-3 text-center ">
						<a href="#"><img src="{{ asset('images/vsalogo.png') }}" alt="vsalogo" class="img responsive"></a>
					</div>
					<div class="col-xs-12 col-md-9 text-center text-info-vsa">
						<div class="title-header">
							<h1 class="text-logo font-text-h1">HIỆP HỘI NUÔI BIỂN VIỆT NAM</h1>
							<h2 class="text-logo font-text-h2">VIETNAM SEACULTURE ASSOCIATION</h2>
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-md-3 ">
					<div class="map-time">
						<div class="address-time">
							<div class="address-info">
								<p>
									<span class="glyphicon "></span> Hà Nội, Việt Nam
									<span class="weather-text">   +12° C</span>
								</p>
							</div>
							<div id="calendar">
								<p class="calendar-info">
									<span id="calendar-day"></span>,
									<span id="calendar-date"></span>/<span id="calendar-month-year"></span>
								</p>
							</div>
						</div>
						<div class="weather-img">
							<img src="{{ asset('images/300.png') }}" alt="">
						</div>
					</div>
					<div class="form-search">
						<div class="col-md-12 pull-right">
							<div class="input-group">
								<input type="text" class="form-control" placeholder="Tìm kiếm...">
								<span class="input-group-btn">
									<button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
								</span>
							</div>
							<!-- /input-group -->
						</div>
						<!-- /.col-lg-9 -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--Menu-->
	<div class="container submenu-reponsive">
		<div class="row">
			<nav class="navbar navbar-default header-nav " role="navigation">
				<div class="container">
					<div class="header-menu">
						<div class="navbar-header ul-menu">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" href="#"><span class="glyphicon glyphicon-home"></span></a>
						</div>
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="text-uppercase">
							<!-- <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1" aria-expanded="true"> -->
							<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

								<ul class="nav navbar-nav menu-i menu-top">
									<form class="navbar-form hidden-lg">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Search">
										</div>
										<button type="submit" class="btn btn-default">Submit</button>
									</form>
									<div class="hidden-md hidden-lg icon-hidden ">
										<li> <a href="#"><i class="fa fa-user"></i>Tài khoản</a> </li>
										<li><a href="#"><img src="images/english_icon.png" class="" alt="english">EN</a></li>
										<li><a href="#"><img src="images/vietnam_icon.png" alt="tiengviet" class="">TV</a></li>
									</div>
									@include('includes/homepage.menu_bar')
								</ul>
							</div>
						</div>
						<!-- /.navbar-collapse -->
					</div>
				</div>
				<!--row-->
				<!-- /.container -->
			</nav>
		</div>
	</div>
</div>
</header>