@extends('templates.master')
@section('content')
<form class="form-horizontal form-label-left" id="form" method="POST" enctype="multipart/form-data">
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
						<h2>@lang('users/backend.add')</h2>
						<div class="clearfix"></div>
					</div>
					<!-- X-title -->

					<!-- X-content -->
					<div class="x_content">
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">@lang('users/backend.username') <span class="description">*</span>
							</label>
							<div class="col-md-2"></div>
							<div class="col-md-4 col-sm-4 col-xs-12 " >
								<input type="text" name="title" id="title" required="required" class="form-control col-md-7 col-xs-12" value="{{old('name')}}">
							</div>
						</div>

						<div class="form-group">
							<label for="email" class="control-label col-md-3 col-sm-3 col-xs-12">@lang('users/backend.email')<span class="description">*</span></label>
							<div class="col-md-2"></div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<input type="email" name="email" id="email" required="required" class="form-control col-md7 col-xs-7 col-xs-12">
								<span id="email_result"></span>
							</div>
						</div>
						<div class="form-group">
							<label for="categories" class="control-label col-md-3 col-sm-3 col-xs-12">@lang('users/backend.pass')<span class="required">*</span></label>
							<div class="col-md-2"></div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<input type="password" name="password" id="password" required="requird" class="form-control col-md7 col-xs-7 col-xs-12">
							</div>
						</div>

						<div class="form-group">
							<label for="categories" class="control-label col-md-3 col-sm-3 col-xs-12">@lang('users/backend.phone')<span class="required"></span></label>
							<div class="col-md-2"></div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<input type="text" name="phone" id="phone"  class="form-control col-md7 col-xs-7 col-xs-12">
							</div>
						</div>
						<div class="form-group">
							<label for="categories" class="control-label col-md-3 col-sm-3 col-xs-12">@lang('users/backend.address')<span class="required"></span></label>
							<div class="col-md-2"></div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<input type="text" name="address" id="address"  class="form-control col-md7 col-xs-7 col-xs-12">
							</div>
						</div>
						<div class="form-group">
							<label for="categories" class="control-label col-md-3 col-sm-3 col-xs-12">@lang('users/backend.role')<span class="required">*</span></label>
							<div class="col-md-2"></div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<select class="form-control" name="role">
									<option value="admin">Admin</option>
									<option value="collaborator">Cộng tác viên</option>
								</select>
							</div>
						</div>

						
						<div class="form-group">
							<div class="col-md-4 col-sm-4 col-xs-12"></div>
							<div class="col-md-6 col-sm-6 col-xs-12 text-center">
								<button class="btn btn-default">@lang('news/backend.cancel')</button>
								<button class="btn btn-primary">@lang('news/backend.add')</button>
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
<script src="http://demo.expertphp.in/js/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>

<script type="text/javascript">
	 $(document).ready(function () {
    $('#form').validate({ // initialize the plugin

    	messages : {
    		email : {
    			required : "Email không được để trống",
    			email : "Email không đúng định dạng",

    		},
    		password : {
    			required : "Mật khẩu không được để trống",
    			minlength : "Mật khẩu phải có ít nhất 8 ký tự"
    		},
    		title: {
    			required:" Tên đăng nhập không được để trống",
    		}
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
<script>
	$(document).ready(function(){
		$('#email').change(function(){
			var email = $('#email').val();
			if(email!=''){
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					url:"{{route('user.check_email')}}",
					method:"POST",
					data:{email:email},
					success:function(data){
						$('#email_result').html(data);  
						
					}
				});
			}

		});
	});
</script>
@endpush

