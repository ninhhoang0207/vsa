@extends('templates.main')

@section('content')
<content>
	<!-- contet -->
	<div id="page" class="main-page-news">
		<div class="container">
			<div class="row">
				<div class="left-fix">
					<div class="col-md-9 col-sm-12 col-xs-12">
						<div class="left-block">
							<!-- ./nav news -->

							<div class="news-content">
								<ul class="breadcrumb">
									<li><a href="{{ route('home') }}">Trang chủ</a></li>
									<li><a href="#">Video</a></li>
									<li><a href="#" class="active">{{ $data->title }}</a></li>
								</ul>
							</div>
							<div class="row ">
								<div class=" video-contex col-xs-12 col-md-12">
									<h3>{{ $data->title }}</h3>
									<a href="#" class="link-a"> <span class="glyphicon glyphicon-forward"></span> Tin thời sự </a>
									<div class="video-play">{!!$data->desciption!!}</div>
									<div class="tag-link pull-left">

										<h4>Đăng bởi : {{ $data->user['name'] }}</h4>
										<h4>Thời gian đăng: {{ $data->created_at->diffForHumans() }}</h4>

									</div>
									<div class="fl-r pull-right">
										<span><i class="fa fa-eye"></i>123</span>
										<span><i class="fa fa-comment"></i>2</span>
									</div>
									
									<div class="pull-right share-cm">
										<a href="javascript:void(0);"><i class="fa fa-facebook cricle"></i></a>
										<a href="javascript:void(0);"><i class="fa fa-twitter cricle"></i></a>
										<a href="javascript:void(0);"><i class="fa fa-google-plus cricle"></i></a>
										<a href="javascript:void(0);"><i class="fa fa-linkedincricle"></i></a>
									</div>
									<!-- ./video -->
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12 left">
									<div class="tintuc_left ">
										<div class="link-block padd-block ">
											<a href="# " class="tintuc left-news ">Video khác</a>
											<div class="border-bottom "></div>
										</div>
										<div class="left-news">
											@if (!count($video))
											Không tìm thấy dữ liệu
											@else
											<div class="row">
												@php
												$first = $video->shift();
												@endphp
												<div class="col-md-7 col-xs-6 col-sm-7 top-video">
													<div class="video-left-one">
														<a href="{{route('video.show',$first->title_slug)}}">
															<img src="{{URL::asset($first->title_image)}}" class="img-responsive video-right" style="width: 100%;">
															{{-- <span class='bg'><span class='icon'>&nbsp;</span></span> --}}
														</a>
													</div>
													<div class="title"> 
														<a href="{{route('video.show',$first->title_slug)}}">{{$first['title']}}
															<span><img src="{{ asset('images/hot_1.gif') }}" border="0"></span>
														</a>
													</div>
													<div class="news-video-p">
														<p>{{ $first->created_at->diffForHumans() }} </p>
													</div>
												</div>
												<div class="col-md-5 col-xs-6 col-sm-5 top-video">
													<div class="project-list-video">
														@foreach( $video as $key => $list)
														<div class="video-top ">
															<div class="row">
																<div class="col-md-5 col-sm-6 col-xs-6">
																	<div class="left-img-home">
																		<a href="{{route('video.show',$list->title_slug)}}">
																			<img src="{{URL::asset($list->title_image)}}" class="img-responsive video-right">
																		</a>
																		<div class="news-video-p">
																			<p>{{ $list->created_at->diffForHumans() }} </p>
																		</div>
																	</div>
																</div>
																<div class="col-md-7 col-sm-6 col-xs-6">
																	<div class="title-right">
																		<a href="{{route('video.show',$list->title_slug)}}">{{$list['title']}}
																			<span><img src="{{ asset('images/new-1.gif') }}" border="0"></span>
																		</a>
																	</div>
																</div>
															</div>
														</div>
														@endforeach
													</div>
												</div>
												{{-- copy here --}}
												
												<!-- video-4--> 
											</div>
											@endif
										</div>
									</div>
								</div>
							</div>
							<div class="row comment">
								<div class="col-md-12 col-sm-12 col-xs-12 left">
									<div class="tintuc_left ">
										<div class="link-block padd-block ">
											<a href="# " class="tintuc left-news ">Bình luận</a>
											<div class="border-bottom "></div>
										</div>
										@if(Auth::user())
										<input type="hidden" id="avatar" value="{{URL::asset(Auth::user()->avatar)}}" >
										<input type="hidden" id="username" value="{{Auth::user()->name}}">
										<div class="left-news ">
											<form id="form"  class=" comments" action="{{route('comment',$data['id'])}}" method="POST" role="form">
												{{csrf_field()}}
												<textarea placeholder="Viết bình luận ..." class="form-control comments" name="content" id="content"></textarea>
												<button class="btn btn-gui" id="btn-save">Gửi</button>
												{{-- <div class="form-group">
												<input type="text" class="form-control comments-text" name="content" id="content" placeholder="Viết bình luận">
											</div> --}}
											{{-- <textarea placeholder="Viết bình luận ..."></textarea> --}}
											{{-- <button class="btn btn-primary" id="btn-save">Gửi</button> --}}
										</form>
										<div class="data-comment" id="showComments">
											@foreach( $comment as $key => $list_comment)
											<div class="comments-1">  
												<img src="{{URL::asset($list_comment->user['avatar'])}}" style="height:50px; width: 50px;" alt="avata-comment" class="pull-left">
												<h4>{{ $list_comment->user->name }} </h4>
												
												<p>{{$list_comment->content}}
												</p><p>
											</p>
										</div>
										@endforeach 
										
									</div>
								</div>
								@else
								<div class="left-news ">
									Bạn cần đăng nhập để bình luận
								</div> 
								@endif
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
</content>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
	$(document).ready(function(){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
		})
		$(document.body).on('click','#btn-save',function(e){
			e.preventDefault();
			var cmt  = $('#content').val();
			var url = $('#form').attr('action');
			var id = {{$user['id']}};
			var name = $('#username').val();
			var avatar = $('#avatar').val();
			$.ajax({
				type : "POST",
				url  : url,
				data : {'content':cmt,'id':id ,'name':name, 'avatar':avatar},
				dataType : 'JSON',
				success: function(data){
					console.log(data);
					$('#showComments').append("<div class='comments-1'><img src='"+data.avatar+"' style='height:50px; width: 50px;' alt='avata-comment' class='pull-left'><h4>"+data.name+" </h4><p>"+data.content+"</p><p></p></div>");
					$('#content').val("");  
				}
			});
		});
	});
</script>
@endsection