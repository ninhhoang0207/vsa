@extends('templates.master')

@section('header')
<link rel="stylesheet" type="text/css" href="{{ asset('css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/switchery.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('iCheck/skins/flat/green.css') }}">
@endsection

@section('content')
<form class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data">
	{{ csrf_field() }}
    {{ method_field('PUT') }}
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>@lang('video/backend.video')</h3>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="clearfix"></div>
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<!-- X-title -->
					<div class="x_title">
						<h2>@lang('video/backend.add')</h2>
						<div class="clearfix"></div>
					</div>
					<!-- X-title -->

					<!-- X-content -->
					<div class="x_content">
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">@lang('video/backend.title') <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="title" id="title" required="required" class="form-control col-md-7 col-xs-12" value="{{ $data[ 'title' ]}}">
							</div>
						</div>
						
						<div class="form-group">
							<label for="categories" class="control-label col-md-3 col-sm-3 col-xs-12">@lang('video/backend.avatar') <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="file" class="form-control" name="title_image" id="title_image">
								<div class="form-group">
									<img src="{{URL::asset('')}}{{$data->title_image}}" class="img img-thumbnail" id="preview_title_image" width="500px" height="auto">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="content">@lang('video/backend.desciption') <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								  <textarea class="form-control my-editor" rows="10" id="desciption" name="desciption" placeholder="Nội Dung">{{ $data[ 'desciption' ]}}</textarea>
							</div>
						</div>
						{{-- <div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="content">@lang('video/backend.video') <span class="required">*</span>
							</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="input-group">
							   <span class="input-group-btn">
							     <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
							       <i class="fa fa-video-camera"></i> @lang('video/backend.pick')
							     </a>
							   </span>
						   		<input id="thumbnail" class="form-control" type="text" name="url">
						 	</div>
						 </div>
						 	
						</div>
						<video style="margin-top:15px; margin-left: 26%; height: 200px" controls>
							  <source id="holder" src="{{ url($data->url) }}" type="video/mp4" >
						</video> --}}
						{{-- <div class="form-group">
							<label for="categories" class="control-label col-md-3 col-sm-3 col-xs-12">@lang('news/backend.video')</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="file" class="form-control" name="url" id="url">
							</div>
						</div> --}}
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">@lang('video/backend.hot')</label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<div class="">
									<label>
									@if( $data[ 'is_hot' ] ==1 )
										<input type="checkbox" class="js-switch" name="is_hot" value="1" checked /> 
										@else
										<input type="checkbox" class="js-switch" name="is_hot" value="0"/>
									@endif
									</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">@lang('video/backend.valid')</label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<div class="">
									<label>
										@if( $data[ 'is_valid' ] ==1 )
										<input type="checkbox" class="js-switch" name="is_valid" value="1" checked /> 
										@else
										<input type="checkbox" class="js-switch" name="is_valid" value="0"/>
										@endif
									</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">@lang('video/backend.type')</label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<div class="">
									<label>
										@if( $data[ 'type' ] ==1 )
											<input type="checkbox" class="js-switch" name="type" value="1" checked /> 
											@else
											<input type="checkbox" class="js-switch" name="type" value="0"/>
										@endif
									</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-3 col-sm-3 col-xs-12"></div>
							<div class="col-md-6 col-sm-6 col-xs-12 text-center">
								<button class="btn btn-default">@lang('video/backend.cancel')</button>
								<button class="btn btn-primary">@lang('video/backend.update')</button>
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
<!-- <script src="http://cdn.ckeditor.com/4.7.1/standard-all/ckeditor.js"></script> -->
<!-- <script src="//cdn.ckeditor.com/4.7.1/full/ckeditor.js"></script> -->
<script type="text/javascript" src="{{ asset('ckfinder/ckfinder.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/select2.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/switchery.js') }}"></script>
<script type="text/javascript" src="{{ asset('iCheck/icheck.js') }}"></script>
<script>
  var domain = "";
 $('#lfm').filemanager('file', {prefix: domain});

</script>

<script type="text/javascript">
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#preview_title_image').attr('src', e.target.result);
				// $('#preview_title_image').css('display', 'block');
				// console.log(e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#title_image").change(function() {
		readURL(this);
	});
</script>
@endpush