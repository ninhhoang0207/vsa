@extends('templates/main')

@section('content')
<content>
	<div id="page" class="main-page-news">
		<div class="container">
			<div class="row">
				<div class="left-fix">
					<div class="col-md-9 col-sm-12 col-xs-12">
						<div class="left-block">
							<!-- ./nav news -->
							<div class="news-content">
								<ul class="breadcrumb">
									<li><a href="#">Trang chủ</a></li>
									<li><a href="#"> Hội viên</a></li>
									<li><a href="#"> Hội viên chính thức</a></li>
									<li>
										<a href="#">Hội viên cá nhân</a>
									</li>
								</ul>
								<div class="row">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="tintuc_left">
											<div class="link-block">
												<a href="# " class="tintuc left-news ">Hội viên pháp nhân</a>
												<div class="border-bottom "></div>
											</div>
											<div class="left-news top-block">


												<!-- ./row-1 -->
												<div class="block-item">
													<div class="row">
														<div class="col-md-4 col-sm-4 col-xs-12">
															<div class="items text-center">
																<img id="preview-avatar" src="{{ asset('images/3.png') }}" alt="avata" class="img-responsive" style="display: none;">
															</div>
															<div class="select-img">
																<input type="file" id="avatar" name="avatar" value="" class="select-file-item">
															</div>
														</div>
														<div class="col-md-8 col-sm-4 col-xs-12">
															<div class="items ">
																<!--Item-->
																<div class="row">
																	<div class="col-md-4">
																		<p><strong>Tên doanh nghiệp :</strong></p>
																	</div>
																	<div class="col-md-8">
																		<input type="text" name="" value="">
																	</div>
																</div>
																<!--Item-->
																<div class="row distance-top">
																	<div class="col-md-4">
																		<p><strong>Tên thương mại :</strong></p>
																	</div>
																	<div class="col-md-8">
																		<input type="text" name="" value="">
																	</div>
																</div>
																<!--Item-->
																<div class="row distance-top">
																	<div class="col-md-4">
																		<p><strong>Logo :</strong></p>
																	</div>
																	<div class="col-md-8">
																		<input type="file" name="logo" id="logo" value="" class="select-file-item">
																	</div>
																	<div class="col-md-8 col-md-offset-4">
																		<img id="preview-logo" src="{{ asset('images/3.png') }}" alt="avata" class="img-responsive" style="display: none;">
																	</div>
																</div>
																<!--Item-->
																<div class="row distance-top">
																	<div class="col-md-4">
																		<p><strong>Địa chỉ :</strong></p>
																	</div>
																	<div class="col-md-8 ">
																		<input type="text" name="" value="">
																	</div>
																</div>
																<!--Item-->
																<div class="row distance-top">
																	<div class="col-md-4">
																		<p><strong>Tỉnh(TP) :</strong></p>
																	</div>
																	<div class="col-md-8">
																		<input type="text" name="" value="">
																	</div>
																</div>
																<!--Item-->
																<div class="row distance-top">
																	<div class="col-md-4">
																		<p><strong>Lĩnh vực hoạt động :</strong></p>
																	</div>
																	<div class="col-md-8">
																		<textarea name="" class="textarea-item"></textarea>
																	</div>
																</div>
																<!--Item-->
																<div class="row distance-top">
																	<div class="col-md-4">
																		<p><strong>Điện thoại công ty :</strong></p>
																	</div>
																	<div class="col-md-8">
																		<input type="text" name="" value="">
																	</div>
																</div>
																<!--Item-->
																<div class="row distance-top">
																	<div class="col-md-4">
																		<p><strong>Fax :</strong></p>
																	</div>
																	<div class="col-md-8">
																		<input type="text" name="" value="">
																	</div>
																</div>
																<!--Item-->
																<div class="row distance-top">
																	<div class="col-md-4">
																		<p><strong>Email :</strong></p>
																	</div>
																	<div class="col-md-8">
																		<input type="text" name="" value="">
																	</div>
																</div>
																<!--Item-->
																<div class="row distance-top">
																	<div class="col-md-4">
																		<p><strong>Website :</strong></p>
																	</div>
																	<div class="col-md-8">
																		<input type="text" name="" value="">
																	</div>
																</div>
																<!--Item-->
																<div class="row distance-top">
																	<div class="col-md-4">
																		<p><strong>HT QLCL :</strong></p>
																	</div>
																	<div class="col-md-8">
																		<textarea name="" class="textarea-item"></textarea>
																	</div>
																</div>
																<!--Item-->
																<div class="row distance-top">
																	<div class="col-md-4">
																		<p><strong>Sản phẩm :</strong></p>
																	</div>
																	<div class="col-md-8">
																		<textarea name="" class="textarea-item"></textarea>
																	</div>
																</div>
																<!--Item-->
																<div class="row distance-top">
																	<div class="col-md-4">
																		<p><strong>Thông tin thêm :</strong></p>
																	</div>
																	<div class="col-md-8">
																		<textarea name="" class="textarea-item"></textarea>
																	</div>
																</div>
																<div class="col-md-8 pull-right btn-register">
																	<button type="">Đăng ký</button>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					@include('includes/homepage.right_content')
				</div>
			</div>
		</div>
	</div>
</content>
@endsection

@push('scripts')
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

	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#preview-logo').attr('src', e.target.result);
				$('#preview-logo').css('display', 'block');
				console.log(e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#logo").change(function() {
		readURL(this);
	});
</script>
@endpush