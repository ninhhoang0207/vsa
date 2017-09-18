@extends('templates.master')

@section('header')
<link rel="stylesheet" type="text/css" href="{{ asset('css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/switchery.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('iCheck/skins/flat/green.css') }}">
<link rel="stylesheet" href="{{asset('css/style.css')}}">
@endsection

@section('content')

<form class="form-horizontal form-label-left" id="frm" method="POST" enctype="multipart/form-data">
	{{ csrf_field() }}
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>@lang('users/backend.users')</h3>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="clearfix"></div>
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<!-- X-title -->
					<div class="x_title">
						<h2>@lang('users/backend.edit')</h2>
						<div class="clearfix"></div>
					</div>
					<!-- X-title -->

					<!-- X-content -->
					<div class="x_content">

						<div class="form-group">
							<label for="email" class="control-label col-md-3 col-sm-3 col-xs-12">@lang('users/backend.email')<span class="description">*</span></label>
							<div class="col-md-2"></div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<input type="email" name="email" id="email"  class="form-control col-md7 col-xs-7 col-xs-12" value="{{$user['email']}}" readonly>
								<span id="email_result"></span>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">@lang('users/backend.username') <span class="description">*</span>
							</label>
							<div class="col-md-2"></div>
							<div class="col-md-4 col-sm-4 col-xs-12 " >
								<input type="text" name="title" id="title"  class="form-control col-md-7 col-xs-12" value="{{$user['name']}}"></input>
							</div>
						</div>
						<div class="form-group">
							<label for="categories" class="control-label col-md-3 col-sm-3 col-xs-12">@lang('users/backend.phone')<span class="required"></span></label>
							<div class="col-md-2"></div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<input type="text" name="phone" id="phone"  class="form-control col-md7 col-xs-7 col-xs-12" value="{{$user['phone']}}">
							</div>
						</div>
						<div class="form-group">
							<label for="categories" class="control-label col-md-3 col-sm-3 col-xs-12">@lang('users/backend.address')<span class="required"></span></label>
							<div class="col-md-2"></div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<input type="text" name="address" id="address"  class="form-control col-md7 col-xs-7 col-xs-12" value="{{$user['address']}}">
							</div>
						</div>
						<div class="form-group">
							<label for="categories" class="control-label col-md-3 col-sm-3 col-xs-12">@lang('users/backend.role')<span ></span></label>
							<div class="col-md-2"></div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<select class="form-control" name="role">

									<option value="admin"
									<?php echo ($user['role']=="admin" ? "selected" : '');?>

									>Admin</option>
									<option value="collaborator" 
									<?php echo ($user['role']=="cộng tác viên" ? "selected" : '');?>

									>Cộng tác viên</option>

								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="old-password" class="control-label col-md-3 col-sm-3 col-xs-12">@lang('users/backend.old_password')<span class="required"></span></label>
							<div class="col-md-2"></div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<input type="password" name="old_password" id="old-password"  class="form-control col-md7 col-xs-7 col-xs-12">
							</div>
						</div>
						<div class="form-group">
							<label for="categories" class="control-label col-md-3 col-sm-3 col-xs-12">@lang('users/backend.new_pass')<span class="required"></span></label>
							<div class="col-md-2"></div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<input type="password" name="password" id="password"  class="form-control col-md7 col-xs-7 col-xs-12">
							</div>
						</div>
						<div class="form-group">
							<label for="categories" class="control-label col-md-3 col-sm-3 col-xs-12">@lang('users/backend.re_password')<span class="required"></span></label>
							<div class="col-md-2"></div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<input type="password" name="password_confirmation" id="password-confirm"  class="form-control col-md7 col-xs-7 col-xs-12">
							</div>
						</div>
						<div class="form-group">
							<label for="categories" class="control-label col-md-3 col-sm-3 col-xs-12">@lang('users/backend.avatar')<span class="required"></span></label>
							<div class="col-md-2"></div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<input type="file" name="file" class="form-control" id="avatar">
								<img src="{{ asset($user['avatar']) }}" width="324px" id="preview-avatar">
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-4 col-sm-4 col-xs-12"></div>
							<div class="col-md-6 col-sm-6 col-xs-12 text-center">
								
								<button class="btn btn-primary">@lang('users/backend.update')</button>
							</div>
						</div>
						
					</div>
					
					<!-- X-content -->
				</div>
			</div>
		</div>
	</div>
</form>
@endsection
@push('scripts')
<script type="text/javascript" src="{{ asset('ckeditor_full/ckeditor.js') }}"></script>
<script type="text/javascript" src="{{ asset('ckfinder/ckfinder.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/select2.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/switchery.js') }}"></script>
<script type="text/javascript" src="{{ asset('iCheck/icheck.js') }}"></script>

<script src="http://demo.expertphp.in/js/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script type="text/javascript">
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#preview-avatar').attr('src', e.target.result);
				$('#preview-avatar').css('display', 'block');
				console.log(e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#avatar").change(function() {
		readURL(this);
	});
	$(document).ready(function () {
	    $('#frm').validate({ // initialize the plugin

	    	messages : {
	    		password : {
	    			required : "Mật khẩu không được để trống",
	    			minlength : "Mật khẩu phải có ít nhất 8 ký tự"
	    		},
	    	},

	    });
	 });
	</script>
	<script>
		$("#phone").mask("(99) 99999-9999");
		$("#phone").on("blur", function() {
			var last = $(this).val().substr( $(this).val().indexOf("-") + 1 );

			if( last.length == 3 ) {
				var move = $(this).val().substr( $(this).val().indexOf("-") - 1, 1 );
				var lastfour = move + last;
				var first = $(this).val().substr( 0, 9 );
				$(this).val( first + '-' + lastfour );
			}
		});
	</script>
	@endpush