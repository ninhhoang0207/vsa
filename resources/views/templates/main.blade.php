<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Hiệp Hội Nuôi Biển Việt Nam</title>
	<!-- Bootstrap library-->
	<link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
	<link href="{{asset('css/normalize.css')}}" rel="stylesheet">
	<link href="{{asset('css/styles.css')}}" rel="stylesheet">
	<link href="{{asset('css/responsive.css')}}" rel="stylesheet">
	<link href="{{asset('css/bootstrap-theme.min.css')}}" rel="stylesheet">
	<!-- Toastr -->
	<link href="{{asset('css/toastr.min.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="shortcut icon" sizes="100x100" href="{{ asset('images/vsalogo1.png') }}">
	@stack('styles')
</head>
<body>
	<header>
		@include('includes/homepage.header_top')
		@yield('content')
	</header>
	@include('includes/homepage.contact');
	@include('includes/homepage.footer')
</body>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/style1.js')}}"></script>
<!-- Toastr -->
<script type="text/javascript" src="{{ asset('js/toastr.min.js') }}"></script>
<script type="text/javascript">
	jQuery(document).ready(function($){ 	
		if($(".btn-top").length > 0){
			$(window).scroll(function () {
				var e = $(window).scrollTop();
				if (e > 300) {
					$(".btn-top").show()
				} else {
					$(".btn-top").hide()
				}
			});
			$(".btn-top").click(function () {
				$('body,html').animate({
					scrollTop: 0
				})
			})
		}		
	});
</script>
<script type="text/javascript">
	@if (Session::has('success')) 
	toastr.success('{{ Session::get("success") }}')
	@endif
	@if (Session::has('error')) 
	toastr.error('{{ Session::get("error") }}')
	@endif
</script>
<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': '{{ csrf_token() }}',
		}
	});
	$('#btn-login').on('click', function(e) {
		e.preventDefault();
		var email = $('#login-email').val();
		var password = $('#login-password').val();
		$('#login-model').modal('hide');
		$.ajax({
			url : '{{ route("quickLogin") }}',
			data : {email:email, password:password},
			type : 'POST',
		}).done(function(data) {
			if(data[1] == 1){
				setTimeout(function(){
					// $('#right-menu-bar').empty();
					// $('#right-menu-bar').append(data[0]);
					// toastr.success('Đăng nhập thành công.');
					location.reload();
				},350);
			}else{
				toastr.error(data[1]);
				$('#login-model').modal('show');
			}
		});
	});

	$('#btn-register').on('click', function(e) {
		e.preventDefault();
		var email = $('#register-email').val();
		var name = $('#register-name').val();
		var password = $('#register-password').val();
		var password_confirmation = $('#register-password-confirmation').val();
		$('#login-model').modal('hide');
		$.ajax({
			url : '{{ route("quickRegister") }}',
			data : {
				email:email, 
				password:password, 
				password_confirmation:password_confirmation, 
				name:name,
			},
			type : 'POST',
		}).done(function(data) {
			if(data[1] == 1){
				setTimeout(function(){
					$('#right-menu-bar').empty();
					$('#right-menu-bar').append(data[0]);
					toastr.success("Đăng ký thành công");
					location.reload();
				},350);
			}else{
				toastr.error(data[0]);
				$('#login-model').modal('show');
			}
		});
	});
</script>
<!-- Tìm kiếm -->
@stack('scripts')
</html>