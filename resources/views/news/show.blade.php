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
									<li><a href="{{ route('homepage.index') }}">Trang chủ</a></li>
									<li>Tin tức</li>
									@if (isset($title))
									<li><a href="#">{{ $title }}</a></li>
									@endif
									<li class="active">{{ $news->title }}</li>
								</ul>
								<h3>{{ $news->title }}</h3>
								<h5><i>Ngày đăng: {{ Carbon\Carbon::parse($news->posted_at)->format('d/m/Y') }}</i></h5>
								<?php echo $news->content; ?>
								<strong style="color: #0080ce"><i>Người viết:</i> {{ isset($news->author->name)?$news->author->name:"Không rõ" }}</strong>
							</div>
							<div class="row comment">
								<div class="col-md-12 col-sm-12 col-xs-12 left">
									<div class="tintuc_left ">
										<div class="link-block padd-block ">
											<a href="# " class="tintuc left-news ">Bình luận</a>
											<hr>
										</div>
										@if(Auth::user())
										<input type="hidden" id="avatar" value="{{URL::asset('')}}{{Auth::user()->avatar}}" >
										<input type="hidden" id="username" value="{{Auth::user()->name}}">
										<div class="left-news ">
											<form id="form"  class=" comments" action="{{route('comment.news',$news['id'])}}" method="POST" role="form">
												{{csrf_field()}}
												{{-- <div class="form-group">
												<input type="text" class="form-control comments" name="content" id="content" placeholder="Viết bình luận">
											</div> --}}
											<textarea placeholder="Viết bình luận ..." class="form-control comments" name="content" id="content"></textarea>
											<button class="btn btn-gui" id="btn-save">Gửi</button>

										</form>
										<div class="data-comment" id="showComments">
											@foreach( $comment as $key => $list_comment)
											<div class="comments-1">  
												<img src="{{URL::asset('')}}{{$list_comment->user['avatar']}}" style="height:50px; width: 50px;" alt="avata-comment" class="pull-left">
												<h4>{{ $list_comment->user->name }} </h4>
												<p>{{$list_comment->content}}</p>
												<p></p>
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

					if (data == -1) 
						alert('Vui lòng nhập nội dung bình luận');
					else {
						$('#showComments').append("<div class='comments-1'><img src='"+data.avatar+"' style='height:50px; width: 50px;' alt='avata-comment' class='pull-left'><h4>"+data.name+" </h4><p>"+data.content+"</p><p></p></div>");
						$('#content').val(""); 
					} 
				}
			});
		});
	});
</script>
@endsection