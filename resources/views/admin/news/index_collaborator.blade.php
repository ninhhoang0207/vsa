@extends('templates.master')

@section('header')
<link rel="stylesheet" type="text/css" href="{{ asset('css/dataTables.bootstrap.css') }}"/>
@endsection


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
						<h2>@lang('news/backend.list_posted')</h2>
						<div class="nav navbar-right">
							<a class="btn btn-primary" href="{{ route('admin.news.create') }}">@lang('news/backend.add')</a>
						</div>
						<div class="clearfix"></div>
					</div>
					<!-- X-title -->
					
					<!-- X-content -->
					<div class="x_content">
						<div id="list_posted">
							<div class="form-group">
								<table id="news-posted" class="table table-condensed">
									<thead>
											<th>@lang('news/backend.id')</th>
											<th width="40%">@lang('news/backend.title')</th>
											<th>@lang('news/backend.avatar')</th>
											<th>@lang('news/backend.created_at')</th>
											<th>@lang('news/backend.posted_at')</th>
											<th>@lang('news/backend.function')</th>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-3 col-sm-3 col-xs-12"></div>
							<div class="col-md-6 col-sm-6 col-xs-12 text-center">
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
<script type="text/javascript" src="{{ asset('js/dataTables.min.js') }}"></script>
<script type="text/javascript">
	function getDetail(id) {
		$.ajax({
			url : "{{ route('admin.news.detail') }}",
			data : { id:id },
			type : "GET",
		}).done(function(data) {
			console.log(data);
			$('.modal-title').text("{{Lang::get('news/backend.article')}}: "+data.title);
			$('#confirm-delete').attr('href',"{{ route('admin.news.delete') }}"+"/"+data.id);
			$('#modal-delete').modal("show");
		});
	}

	$('#confirm-delete').on('click', function(e) {
		e.preventDefault();
		$('#modal-delete').modal('hide');
		$.ajax({
			url : $(this).attr('href'),
			type : "GET",
		}).done(function(data) {
			if (data == 1) {
				tbl_news_posted.draw();
				tbl_news_wating.draw();
				toastr.success('{{ Lang::get("news/backend.success") }}');
			} else {
				toastr.error('{{ Lang::get("news/backend.errors") }}');
			}
			$('#modal-delete').modal('hide');
		});
	});

	// Table new posted
	var tbl_news_posted = $('#news-posted').DataTable({
		processing : true,
		serverSide : true,
		ajax : "{{ route('admin.news.data') }}",
		columns : [
			{"data":null,
				"render" : function (data, type, full, meta) {
					return meta.row+1; 
				},
				"searchable": false,
				"orderable": false 
			},
			{data : 'title'},
			{
				data : 'title_image', 
				name : 'title_image',
				"searchable": false,
				"orderable": false,
				render : function (data, type, full, meta) {
					var string = '<img src="'+data+'" width="70px" height="50px">';
					return string;
				}
			},
			{data : 'created_at', name : 'created_at'},
			{data : 'posted_at', name : 'posted_at'},
			{
				data : 'id', 
				"searchable": false,
				"orderable" : false,
				render : function (data, type, full, meta) {
					var string = '<a href="{{ route("admin.news.edit") }}/'+data+'" class="btn btn-xs btn-warning">Sửa</a>';
					string +=	'<button type="button" onclick="getDetail(this.value);return false;" value="'+data+'" class="btn btn-xs btn-danger">Xóa</button>';
					return string;
				}
			}
		],
		initComplete: function () {
			this.api().columns().every(function () {
				var column = this;
				var input = document.createElement("input");
				$(input).appendTo($(column.footer()).empty())
				.on('change', function () {
					column.search($(this).val(), false, false, true).draw();
				});
			});
		}
	});
</script>
@endpush