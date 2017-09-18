@extends('templates.master')

@section('header')
<link href="{{ asset('css/dropzone.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<form id="form-create" class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data">
	{{ csrf_field() }}
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>@lang('gallery/backend.gallery')</h3>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="clearfix"></div>
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<!-- X-title -->
					<div class="x_title">
						<h2>@lang('gallery/backend.add')</h2>
						<div class="clearfix"></div>
					</div>
					<!-- X-title -->

					<!-- X-content -->
					<div class="x_content">
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">@lang('gallery/backend.title') <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" name="title" id="title" required="required" class="form-control col-md-7 col-xs-12">
							</div>
						</div>
						
						<div class="form-group">
							<label for="categories" class="control-label col-md-3 col-sm-3 col-xs-12">@lang('gallery/backend.avatar') <span class="required">*</span></label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="file" class="form-control" name="avatar" id="avatar" required>
								<div class="form-group">
									<img src="" class="img img-thumbnail" id="preview_avatar" width="500px" height="auto" style="display: none;">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="content">@lang('gallery/backend.content') <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								  <textarea class="form-control my-editor" rows="10" id="content" name="content" placeholder="Nội Dung">{{ old('desciption') }}</textarea>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="content">@lang('gallery/backend.image') <span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="dropzone" id="dz">
									<div class="fallback">
										<input name="file" type="file" multiple />
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-3 col-sm-3 col-xs-12"></div>
							<div class="col-md-6 col-sm-6 col-xs-12 text-center">
								<button class="btn btn-default">@lang('gallery/backend.cancel')</button>
								<button class="btn btn-primary">@lang('gallery/backend.add')</button>
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
<script type="text/javascript" src="{{ asset('js/dropzone.min.js') }}"></script>
<script type="text/javascript">
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#preview_avatar').attr('src', e.target.result);
				$('#preview_avatar').css('display', 'block');
				console.log(e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#avatar").change(function() {
		readURL(this);
	});
</script>
<script type="text/javascript">
	Dropzone.options.dz = {
        url : '{{ route("admin.gallery.uploadImage") }}',
        maxFilesize: 2, // MB
        addRemoveLinks: true,
        acceptedFiles : 'image/jpeg, images/jpg, image/png',
        init : function(){
            var fileList = new Array;
            var fileList_count = 0;
            var thisDropzone = this;

            this.on("removedfile", function(file) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route("admin.gallery.removeImage") }}',
                    data : {
                        _token: $('input[name = "_token"]').val(), 
                        name: file.serverFileName,
                    }
                }).done(function(data){
                    if(data == -1){//New Image
                        var index = fileList.indexOf(file);
                        delete fileList[index];
                        var img_info_id = "img_info"+index;
                        $("#"+img_info_id).val('');
                    }else{ //Old image
                        var img_info_id = "img_info"+fileList_count;
                        var hidden_data = '<input name = "img_info[]" type="hidden" value="1,' + file.serverFileName+'" id="'+img_info_id+'" />';
                        $('#form-create').append(hidden_data);
                    }
                });
            } );
            this.on("success", function(file, serverFileName) {
                // Change the name of image
                var name = file.previewElement.querySelector("[data-dz-name]");
                name.dataset.dzName = serverFileName;
                name.innerHTML = serverFileName;
                file.serverFileName = serverFileName;
                // Add a image into list of images
                // fileList[fileList_count++] = file;
                fileList[++fileList_count] = file;
                // Append a div to save information for saving
                var img_info_id = "img_info"+fileList_count;
                var hidden_data = '<input name = "img_info[]" type="hidden" value="' + 0 +","+file.serverFileName+'" id="'+img_info_id+'" />';
                $('#form-create').append(hidden_data);
            } );

            this.on("sending", function(file, xhr, formData){
                formData.append("_token", "{{ csrf_token() }}");
            });

        }//Init function
};//Dropzoen
</script>
@endpush