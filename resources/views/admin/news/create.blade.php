@extends('templates.master')

@section('content')
<form class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data">
	{{ csrf_field() }}
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>@lang('news/backend.news')</h3>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="clearfix"></div>
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<!-- X-title -->
					<div class="x_title">
						<h2>@lang('news/backend.add')</h2>
						<div class="clearfix"></div>
					</div>
					<!-- X-title -->

					<!-- X-content -->
					<div class="x_content">
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">@lang('news/backend.title') <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="title" id="title" required="required" class="form-control col-md-7 col-xs-12">
							</div>
						</div>
						<div class="form-group">
							<label for="categories" class="control-label col-md-3 col-sm-3 col-xs-12">@lang('news/backend.categories') <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select id="categories" class="form-control col-md-7 col-xs-12" name="categories[]" multiple="multiple" required>
										<?php foreach ($category_list as $key => $value): ?>
											<option value="{{ $value->id }}"><b>{{ $value->title}}</b> - {{"({$value->parent($value->parent_id)})"}}</option>
										<?php endforeach ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">@lang('news/backend.hot')</label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<div class="">
									<label>
										<input type="checkbox" class="js-switch" name="is_hot" value="1" checked /> 
									</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">@lang('news/backend.view_mode')</label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<div class="">
									<label>
										<input type="radio" name="view_mode" id="view_mode_all" class="flat" checked value="all" /> @lang('news/backend.all') &nbsp
										<input type="radio" name="view_mode" id="view_mode_member" class="flat" value="member" />&nbsp @lang('news/backend.only_member')
										<input type="radio" name="view_mode" id="view_mode_event" class="flat" value="event" />&nbsp @lang('news/backend.event')
										<input type="radio" name="view_mode" id="view_mode_association" class="flat" value="association" {{ Auth::user()->role =='collaborator'?"disabled":"" }}/>&nbsp @lang('news/backend.association')
									</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="categories" class="control-label col-md-3 col-sm-3 col-xs-12">@lang('news/backend.title_image') <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="file" class="form-control" name="title_image" id="title_image" required>
								<div class="form-group">
									<img src="" class="img img-thumbnail" id="preview_title_image" width="500px" height="auto" style="display: none;">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="categories" class="control-label col-md-3 col-sm-3 col-xs-12">@lang('news/backend.description')<span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<textarea class="form-control" rows="5" name="description" id="description" required></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="content">@lang('news/backend.content') <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<textarea id="content" name="content" class="form-control col-md-7 col-xs-12 my-editor"></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-3 col-sm-3 col-xs-12"></div>
							<div class="col-md-6 col-sm-6 col-xs-12 text-center">
								<a class="btn btn-default" href="{{ route('admin.news.index') }}">@lang('news/backend.cancel')</a>
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
<script type="text/javascript" >
	// CKEDITOR.replace( 'content');
	$('#categories').select2({
		placeholder : "{{ Lang::get('news/backend.select_category') }}",
	});
</script>
<script type="text/javascript">
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#preview_title_image').attr('src', e.target.result);
				$('#preview_title_image').css('display', 'block');
				console.log(e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#title_image").change(function() {
		readURL(this);
	});
</script>
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
    '//www.tinymce.com/css/codepen.min.css'],

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
@endpush

