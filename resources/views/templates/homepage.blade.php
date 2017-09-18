<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>HOMEPAGE</title>
	<!-- Bootstrap library-->
	<link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
	<link href="{{asset('css/normalize.css')}}" rel="stylesheet">
	<link href="{{asset('css/styles.css')}}" rel="stylesheet">
	<link href="{{asset('css/responsive.css')}}" rel="stylesheet">
	<link href="{{asset('css/bootstrap-theme.min.css')}}" rel="stylesheet">
	 <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">
	<!-- <link rel="stylesheet" href="css/bootstrap-theme.min.css"> -->
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"> -->
	@stack('styles')
</head>
<body>
<header>
	@include('includes/homepage.header_top')
	@yield('content')
</header>
	@include('includes/homepage.footer')
</body>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>

<script src="{{asset('js/style1.js')}}"></script>
 @stack('scripts')
</html>