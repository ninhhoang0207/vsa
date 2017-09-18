<div class="icon-top">
	<button id="fat-menu" class="dropdown">
		<a href="#" class="dropdown-toggle" id="drop3" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> 
			<img src="{{ asset('images/vietnam_icon.png') }}" alt="tiengviet" class="langu">
			Tiếng Việt 
			<span class="caret"></span>
		</a>
		<ul class="dropdown-menu" aria-labelledby="drop3">
			<div class="arrow"></div>
			<li class="select-lg">
				<div class="title-acount">Select your language</div>
				<ul class="info-lg">
					<li>
						<a class="language-vi"><img src="{{ asset('images/vietnam_icon.png') }}" alt=""><span>Tiếng Việt</span></a>
					</li>
					<li>
						<a class="language-vi"><img src="{{ asset('images/english_icon.png') }}" alt=""><span>English</span></a>
					</li>
				</ul>
			</li>
		</ul>
	</button>
	@if (Auth::check())
	<button id="fat-menu" class="dropdown">
		<a href="#" class="dropdown-toggle" id="drop3" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="{{ Auth::user()->name }}"> 
			<span class="glyphicon glyphicon-user"></span>
			Xin chào: {{ str_limit(Auth::user()->name,$limit=8,$end='...') }}
			<span class="caret"></span>
		</a>
		<ul class="dropdown-menu" aria-labelledby="drop3">
			<div class="arrow"></div>
			<li class="select-lg">
				<div class="title-acount">Chọn chức năng</div>
				<ul class="info-lg">
					@if (Auth::check() && (Auth::user()->role != 'user'))
					<li>
						<a href="{{ route('admin.news.index') }}"><span class="glyphicon glyphicon-cog"> Hệ thống </span></a>
					</li>
					@endif
					@if (Auth::user()->role == 'member_personal' || Auth::user()->role == 'member_association' || Auth::user()->role == 'collaborator')
					<li>
						<a href="{{ route('member.edit') }}"><span class="glyphicon glyphicon-user">Thông tin chi tiết</span></a>
					</li>
					@endif
					<li>
						<a href="{{ route('logout') }}"
						onclick="event.preventDefault();
						document.getElementById('logout-form').submit();">
						<span class="glyphicon glyphicon-arrow-left"> Đăng xuất</span></a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							{{ csrf_field() }}
						</form>
					</li>
				</ul>
			</li>
		</ul>
	</button>
	@else
	<button class="drop-modal" type="button" data-toggle="modal" data-target="#login-model">
		<span class="glyphicon glyphicon-user"></span> Tài Khoản
	</button>
	<!-- Modal -->
	<div class="modal fade" id="login-model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="arrow-modal"></div>
				<div>
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active">
							<a href="#login" aria-controls="home" role="tab" data-toggle="tab">Đăng nhập</a>
						</li>
						<li role="presentation" class="register-text">
							<a href="#register" aria-controls="profile" role="tab" data-toggle="tab">Đăng ký</a>
						</li>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</ul>
					<!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="login">
							<div class="col-sm-12 form-login-fb-g">
								<p>Bạn có thể sử dụng tài khoản:</p>
								<div class="col-sm-6 col-xs-12">
									<a class="btn-danger form-facebook" href="{{ route('socialite.redirect',['provider'=>'facebook']) }}">
										<span class="fa fa-facebook-z"></span>
										<span class="sp-icon">Facebook</span>
									</a>
								</div>
								<div class="col-sm-6 col-xs-12">
									<a class="btn-danger form-google" href="{{ route('socialite.redirect',['provider'=>'google']) }}">
										<span class="fa fa-google-plus-z"></span>
										<span class="sp-icon">Google</span>
									</a>
								</div>
							</div>
							<div class="form-input-login">
								<p>Đăng nhập bằng tài khoản của VSA</p>
								<input placeholder="Địa chỉ email" id="login-email" class="form-control" type="email">
								<input placeholder="Mật khẩu" id="login-password" class="form-control" type="password">
								@if (isset($login_error))
								<span class="help-block">
									<strong>{{ $login_error }}</strong>
								</span>
								@endif
							</div>
							<div class="form-question">
								<input id="checkbox1" name="checkbox" value="1" checked="checked" type="checkbox">
								<label for="checkbox1">Lưu mật khẩu?</label>
							</div>
							<a href="">Quên mật khẩu?</a>
							<button type="button" id="btn-login" class="btn btn-primary">Đăng nhập</button>
							<div class="modal-footer">
								<p>Chưa có tài khoản?<a href=""> Đăng ký</a></p>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane form-register" id="register">
							<p>Đăng ký tài khoản mới tại VSA</p>
							<input placeholder="Tên người dùng" id="register-name" class="form-control" type="email">
							<input placeholder="Tài khoản, email" id="register-email" class="form-control" type="email">
							<input placeholder="Mật khẩu" id="register-password" class="form-control" type="password">
							<input placeholder="Nhập lại mật khẩu" id="register-password-confirmation" class="form-control" type="password">
							<p class="text-condition">Chọn đăng ký là bạn đã đồng ý với các <span>Điều khoản, Điều kiện</span> cũng như các <span>Chính sách bảo mật</span> của VSA</p>
							<button type="button" id="btn-register" class="btn btn-primary">Đăng ký</button>
							<div class="modal-footer">
								<p>Đã có tài khoản?<a href=""> Đăng nhập</a></p>
							</div>
						</div>
					</div>
				</div>
				<!--End Tabs -->
			</div>
			<!--End modal-content -->
		</div>
	</div>
	@endif
</div>
<!--End Modal-->