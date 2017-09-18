@extends('templates.master')

@section('content')
<form class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data">
	{{ csrf_field() }}
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
								<input type="text" name="title" id="title" required="required" class="form-control col-md-7 col-xs-12">
							</div>
						</div>
						
						<div class="form-group">
							<label for="categories" class="control-label col-md-3 col-sm-3 col-xs-12">@lang('video/backend.avatar') <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="file" class="form-control" name="title_image" id="title_image" required>
								<div class="form-group">
									<img src="" class="img img-thumbnail" id="preview_title_image" width="500px" height="auto" style="display: none;">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="content">@lang('video/backend.content') <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								  <textarea class="form-control my-editor" rows="10" id="desciption" name="desciption" placeholder="Nội Dung">{{ old('desciption') }}</textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">@lang('video/backend.hot')</label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<div class="">
									<label>
										<input type="checkbox" class="js-switch" name="is_hot" value="1" checked /> 
									</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">@lang('video/backend.valid')</label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<div class="">
									<label>
										<input type="checkbox" class="js-switch" name="is_valid" value="1" checked /> 
									</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12">@lang('video/backend.type')</label>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<div class="">
									<label>
										<input type="checkbox" class="js-switch" name="type" value="1" checked /> 
									</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-3 col-sm-3 col-xs-12"></div>
							<div class="col-md-6 col-sm-6 col-xs-12 text-center">
								<button class="btn btn-default">@lang('video/backend.cancel')</button>
								<button class="btn btn-primary">@lang('video/backend.add')</button>
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
