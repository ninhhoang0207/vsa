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
						<h2>@lang('news/backend.list_waited')</h2>
						<div class="nav navbar-right">
							<label for="category-search-waiting" class="control-label">@lang('news/backend.categories')</label>
							<select class="form-control" id="category-search-waiting" multiple>
								<?php foreach ($category_list as $key => $value): ?>
									<option value="{{ $value->id }}">{{ $value->title }}</option>
								<?php endforeach ?>
							</select>
							<button class="btn btn-default" id="refresh-news-wating" "><i class="fa fa-refresh"></i></button>
						</div>
						<div class="clearfix"></div>
					</div>
					<!-- X-title -->
					
					<!-- X-content -->
					<div class="x_content">
						<div id="list_waited">
							<div class="form-group">
								<table id="news-waiting" class="table table-condensed">
									<thead>
											<th></th>
											<th>@lang('news/backend.id')</th>
											<th width="30%">@lang('news/backend.title')</th>
											<th>@lang('news/backend.avatar')</th>
											<th>@lang('news/backend.categories')</th>
											<th>@lang('news/backend.status')</th>
											<th>@lang('news/backend.created_at')</th>
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
		<div class="row">
			<div class="clearfix"></div>
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<!-- X-title -->
					<div class="x_title">
						<h2>@lang('news/backend.list_posted')</h2>
						<div class="nav navbar-right">
							<label for="category_list" class="control-label">@lang('news/backend.categories')</label>
							<select class="form-control" id="category-search-posted" name="category-search-posted" multiple>
								<?php foreach ($category_list as $key => $value): ?>
									<option value="{{ $value->id }}">{{ $value->title }}</option>
								<?php endforeach ?>
							</select>
							<a class="btn btn-primary" href="{{ route('admin.news.create') }}">@lang('news/backend.add')</a>
							<button class="btn btn-default" id="refresh-news-posted"><i class="fa fa-refresh"></i></button>
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
											<th></th>
											<th>@lang('news/backend.id')</th>
											<th width="30%">@lang('news/backend.title')</th>
											<th>@lang('news/backend.avatar')</th>
											<th>@lang('news/backend.categories')</th>
											<!-- <th>@lang('news/backend.created_at')</th> -->
											<th>@lang('news/backend.posted_at')</th>
											<th>@lang('news/backend.function')</th>
									</thead>
									<tbody>
									</tbody>
									<tfoot>
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
									</tfoot>
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
	$('#category-search-waiting').select2();
	$('#category-search-posted').select2();
	function showNews(id) {
		$.ajax({
			url : '{{ route("admin.news.post") }}',
			data : {id:id},
			type : 'GET',
		}).done(function(data) {
			if (data) {
				tbl_news_posted.draw();
				tbl_news_wating.draw();
				toastr.success('{{ Lang::get("general.success") }}');
			} else {
				toastr.error('{{ Lang::get("general.errors") }}');
			}
		});
	}

	function getDetail(id) {
		$.ajax({
			url : "{{ route('admin.news.detail') }}",
			data : { id:id },
			type : "GET",
		}).done(function(data) {
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
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': '{{ csrf_token() }}',
		}
	});
	// Table news waited
	var tbl_news_wating = $('#news-waiting').DataTable({
		processing : true,
		serverSide : true,
		ajax : {
			url : "{{ route('admin.news.newsWaitingData') }}",
			type : "POST",
			data: function (d) {
				d.categories_search = $('#category-search-waiting').val();
			}
		},
		columns : [
			{
				"className":      'details-control',
				"orderable":      false,
				"searchable":     false,
				"data":           null,
				"defaultContent": ''
			},
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
			{
				data : 'categories',
				// name : 'news.categories.title',
				'orderable' : false,
				render : function (data, type, full, meta) {
					var string = '';
					$.each(data,function(index, value) {
						string += value.title;
						string += ' - '
					});
					return string.substring(0,string.length - 3);
				}
			},
			{
				data : 'posted_at', 
				name : 'posted_at',
				render : function (data, type, full, meta) {
					// console.log(data);
					if (data == '{{ Lang::get("news/backend.new") }}')
						return '<span class="label label-success">'+data+'</span>';
					return '<span class="label label-warning">'+data+'</span>';
				}
			},
			{data : 'created_at', name : 'created_at'},
			{
				data : 'id', 
				"searchable": false,
				"orderable" : false,
				render : function (data, type, full, meta) {
					var string = '';
					@if (Auth::user()->role == 'admin')
					string += '<button onclick="showNews('+data+');return false;" class="btn btn-xs btn-success">{{ Lang::get("news/backend.post") }}</button>';
					@endif
					string +='<a href="{{ route("admin.news.show") }}/'+data+'" class="btn btn-xs btn-info">{{ Lang::get("news/backend.show") }}</a>';
					string += '<button type="button" onclick="getDetail(this.value);return false;" value="'+data+'" class="btn btn-xs btn-danger">{{ Lang::get("news/backend.cancel") }}</button>';
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

	// Table new posted
	var tbl_news_posted = $('#news-posted').DataTable({
		processing : true,
		serverSide : true,
		ajax : {
			url : "{{ route('admin.news.data') }}",
			type : "POST",
			data: function (d) {
				d.categories_search = $('#category-search-posted').val();
			}
		},
		// ajax : "posted-data",
		columns : [
			{
				"className":      'details-control',
				"orderable":      false,
				"searchable":     false,
				"data":           null,
				"defaultContent": ''
			},
			{"data":null,
				"render" : function (data, type, full, meta) {
					return meta.row+1; 
				},
				"searchable": false,
				"orderable": false 
			},
			{
				data : 'title',
			},
			{
				data : 'title_image', 
				name : 'news.title_image',
				"searchable": false,
				"orderable": false,
				render : function (data, type, full, meta) {
					var string = '<img src="'+data+'" width="70px" height="50px">';
					return string;
				}
			},
			{
				data : 'categories',
				'orderable' : false,
				'searchable' : false,
				render : function (data, type, full, meta) {
					var string = '';
					$.each(data,function(index, value) {
						string += value.title;
						string += ' - '
					});
					return string.substring(0,string.length - 3);
				}
			},
			{data : 'posted_at', name : 'news.posted_at'},
			{
				data : 'id', 
				"searchable": false,
				"orderable" : false,
				render : function (data, type, full, meta) {
					var string = '<a href="{{ route("admin.news.edit") }}/'+data+'" class="btn btn-xs btn-warning">{{ Lang::get("news/backend.edit") }}</a>';
					string +=	'<button type="button" onclick="getDetail(this.value);return false;" value="'+data+'" class="btn btn-xs btn-danger">{{ Lang::get("news/backend.delete") }}</button>';
					return string;
				}
			}
		],

		initComplete: function () {
			this.api().columns([2,5]).every(function () {
				var column = this;
				var input = document.createElement("input");
				$(input).addClass('form-control');
				$(input).appendTo($(column.footer()).empty())
				.on('change', function () {
					column.search($(this).val(), false, false, true).draw();
				});
			});
		}
	});
	//Search by category 

	// Add event listener for opening and closing details
	tbl_news_posted.on('click', 'td.details-control', function () {
		var tr = $(this).closest('tr');
		var row = tbl_news_posted.row( tr );

		if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
         }
         else {
            moreDetail(row.data().id,row);
            tr.addClass('shown');
         }
      });

	tbl_news_wating.on('click', 'td.details-control', function () {
		var tr = $(this).closest('tr');
		var row = tbl_news_wating.row( tr );

		if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
         }
         else {
            moreDetail(row.data().id,row);
            tr.addClass('shown');
         }
      });
	$('table tfoot tr td').removeClass('details-control');
	function moreDetail(id,row) {
		$.ajax({
			url : "{{ route('admin.news.detail') }}",
			data : { id:id },
			type : "GET",
		}).done(function(data) {
			var html = '<table class="table">'+
        					'<tr>'+
        					'<td>Người viết:</td>'+
        					'<td>'+data.created_by+'</td>'+
        					'</tr>'+
        					'<tr>'+
        					'<td>Người chỉnh sửa:</td>'+
        					'<td>'+data.updated_by+'</td>'+
        					'</tr>'+
        					'<tr>'+
        					'<td>Thời gian chỉnh sửa:</td>'+
        					'<td>'+data.updated+'</td>'+
        					'</tr>'+
        					'<tr>'+
        					'<td>Tóm tắt:</td>'+
        					'<td>'+data.description+'</td>'+
        					'</tr>'+
        					'</table>';
        	row.child( html ).show();
		});
	}

$('#refresh-news-wating').on('click', function(e) {
	e.preventDefault();
	tbl_news_wating.draw();
});
$('#refresh-news-posted').on('click', function(e) {
	e.preventDefault();
	tbl_news_posted.draw();
});


$('#category-search-waiting').on('change', function(e) {
	tbl_news_wating.draw();
	e.preventDefault();
});
$('#category-search-posted').on('change', function(e) {
	tbl_news_posted.draw();
	e.preventDefault();
});
</script>
@endpush