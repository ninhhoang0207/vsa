<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}" />

	<title>@yield('title') | @lang('general.title')</title>
	@yield('header')
	<!-- Bootstrap library-->
	<link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
	<!-- Font-awsome -->
	<link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
	<!-- Bootstrap library-->
	<link href="{{asset('css/nprogress.css')}}" rel="stylesheet">
	<!-- Toastr -->
	<link href="{{asset('css/toastr.min.css')}}" rel="stylesheet">
	<!-- Select 2 -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/select2.css') }}">
	<!-- Swtich button -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/switchery.css') }}">
	<!-- Check button -->
	<link rel="stylesheet" type="text/css" href="{{ asset('iCheck/skins/flat/green.css') }}">
	<!-- Custom Theme Style -->
	<link href="{{asset('build/css/custom.min.css')}}" rel="stylesheet">
</head>
<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			@include('includes/sidebar_menu')
			@include('includes/top_menu')
			<!-- page content -->
			<div class="right_col" role="main">
				@yield('content')
			</div>
		</div>
	</div>
<!-- Modal delete-->
<div id="modal-delete" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" id="title-delete">@lang('general.confirm_delete')</h4>
			</div>
			<div class="modal-body">
				<p>@lang('news/backend.warning_delete')</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">@lang('news/backend.cancel')</button>
				<a href="" id="confirm-delete"  class="btn btn-danger" >@lang('news/backend.delete')</a>
			</div>
		</div>
	</div>
</div>
</body>
<!-- jQuery -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
<script src="{{asset('js/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!-- Moment -->
<script src="{{asset('js/moment.min.js')}}"></script>
<!-- NProgress -->
<script src="{{asset('js/nprogress.js')}}"></script>

<!-- Select 2 -->
<script type="text/javascript" src="{{ asset('js/select2.js') }}"></script>
<!-- Switch button -->
<script type="text/javascript" src="{{ asset('js/switchery.js') }}"></script>
<!-- Toastr -->
<script type="text/javascript" src="{{ asset('js/toastr.min.js') }}"></script>
<!-- Checkbox -->
<script type="text/javascript" src="{{ asset('iCheck/icheck.js') }}"></script>
<!-- Custom Theme Scripts -->
<script src="{{asset('build/js/custom.min.js')}}"></script>
	{{-- Tinymce --}}
<script src="{{ asset('vendor/laravel-filemanager/js/lfm.js') }}"></script>
<script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script> 
<script type="text/javascript">
	@if (Session::has('success')) 
	toastr.success('{{ Lang::get("general.success") }}')
	@endif
	@if (Session::has('error')) 
  toastr.error('{{ Session::get("error") }}')
	// toastr.error('{{ Lang::get("general.error") }}')
	@endif
  @if (Session::has('required')) 
  toastr.error('{{ Lang::get("general.required") }}')
  @endif
</script>

@stack('scripts')
<script>
  var editor_config = {
    path_absolute : "/",
    selector: "textarea.my-editor",
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor textcolor colorpicker textpattern"
    ],
    toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
    toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",
    toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | visualchars visualblocks nonbreaking template pagebreak restoredraft",
    relative_urls: false,
    content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '{{ asset("css/tinymce.min.css") }}'],

  menubar: false,
  toolbar_items_size: 'small',

  style_formats: [{
    title: 'Bold text',
    inline: 'b'
  }, {
    title: 'Red text',
    inline: 'span',
    styles: {
      color: '#ff0000'
    }
  }, {
    title: 'Red header',
    block: 'h1',
    styles: {
      color: '#ff0000'
    }
  }, {
    title: 'Example 1',
    inline: 'span',
    classes: 'example1'
  }, {
    title: 'Example 2',
    inline: 'span',
    classes: 'example2'
  }, {
    title: 'Table styles'
  }, {
    title: 'Table row 1',
    selector: 'tr',
    classes: 'tablerow1'
  }],

  templates: [{
    title: 'Test template 1',
    content: 'Test 1'
  }, {
    title: 'Test template 2',
    content: 'Test 2'
  }],
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  };

  tinymce.init(editor_config);
</script>
</html>
