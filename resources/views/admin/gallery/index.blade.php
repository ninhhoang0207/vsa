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
						<h2>@lang('gallery/backend.list_waiting')</h2>
						<div class="nav navbar-right">
							<button class="btn btn-default" id="refresh-gallery-wating" "><i class="fa fa-refresh"></i></button>
						</div>
						<div class="clearfix"></div>
					</div>
					<!-- X-title -->
					
					<!-- X-content -->
					<div class="x_content">
						<div id="list_waiting">
							<div class="form-group">
								<table id="table-gallery-waiting" class="table table-condensed">
									<thead>
											<th>@lang('gallery/backend.id')</th>
											<th width="30%">@lang('gallery/backend.title')</th>
											<th>@lang('gallery/backend.avatar')</th>
											<th>@lang('gallery/backend.status')</th>
											<th>@lang('gallery/backend.created_at')</th>
											<th>@lang('gallery/backend.function')</th>
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
						<h2>@lang('gallery/backend.list_posted')</h2>
						<div class="nav navbar-right">
							<a class="btn btn-primary" href="{{ route('admin.gallery.create') }}">@lang('gallery/backend.add')</a>
							<button class="btn btn-default" id="refresh-gallery-posted"><i class="fa fa-refresh"></i></button>
						</div>
						<div class="clearfix"></div>
					</div>
					<!-- X-title -->
					
					<!-- X-content -->
					<div class="x_content">
						<div id="list_posted">
							<div class="form-group">
								<table id="table-gallery-posted" class="table table-condensed">
									<thead>
											<th>@lang('gallery/backend.id')</th>
											<th width="30%">@lang('gallery/backend.title')</th>
											<th>@lang('gallery/backend.avatar')</th>
											<th>@lang('gallery/backend.created_at')</th>
											<th>@lang('gallery/backend.posted_at')</th>
											<th>@lang('gallery/backend.function')</th>
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
	function postGallery(id) {
		$.ajax({
			url : '{{ route("admin.gallery.post") }}',
			data : {id:id},
			type : 'GET',
		}).done(function(data) {
			if (data) {
				tbl_gallery_posted.draw();
				tbl_gallery_waiting.draw();
				toastr.success('{{ Lang::get("general.success") }}');
			} else {
				toastr.error('{{ Lang::get("general.error") }}');
			}
		});
	}

	function getDetail(id) {
		$.ajax({
			url : "{{ route('admin.gallery.detail') }}",
			data : { id:id },
			type : "GET",
		}).done(function(data) {
			$('.modal-title').text("{{Lang::get('gallery/backend.title')}}: "+data.title);
			$('#confirm-delete').attr('href',"{{ route('admin.gallery.delete') }}"+"/"+data.id);
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
				tbl_gallery_posted.draw();
				tbl_gallery_waiting.draw();
				toastr.success('{{ Lang::get("general.success") }}');
			} else {
				toastr.error('{{ Lang::get("general.error") }}');
			}
			$('#modal-delete').modal('hide');
		});
	});
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': '{{ csrf_token() }}',
		}
	});
	// Table gallery waiting
	var tbl_gallery_waiting = $('#table-gallery-waiting').DataTable({
		processing : true,
		serverSide : true,
		ajax : {
			url : "{{ route('admin.gallery.galleryWaiting') }}",
			type : "POST",
		},
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
				data : 'avatar', 
				name : 'avatar',
				"searchable": false,
				"orderable": false,
				render : function (data, type, full, meta) {
					var string = '<img src="'+data+'" width="70px" height="50px">';
					return string;
				}
			},
			{
				data : 'posted_at', 
				name : 'posted_at',
				render : function (data, type, full, meta) {
					// console.log(data);
					if (data == '{{ Lang::get("gallery/backend.new") }}')
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
					string += '<button onclick="postGallery('+data+');return false;" class="btn btn-xs btn-success">{{ Lang::get("gallery/backend.post") }}</button>';
					@endif
					string +='<a href="{{ route("admin.gallery.show") }}/'+data+'" class="btn btn-xs btn-info">{{ Lang::get("gallery/backend.show") }}</a>';
					string += '<button type="button" onclick="getDetail(this.value);return false;" value="'+data+'" class="btn btn-xs btn-danger">{{ Lang::get("gallery/backend.cancel") }}</button>';
					return string;
				}
			}
		],
		// initComplete: function () {
		// 	this.api().columns().every(function () {
		// 		var column = this;
		// 		var input = document.createElement("input");
		// 		$(input).appendTo($(column.footer()).empty())
		// 		.on('change', function () {
		// 			column.search($(this).val(), false, false, true).draw();
		// 		});
		// 	});
		// }
	});

	// Table new posted
	var tbl_gallery_posted = $('#table-gallery-posted').DataTable({
		processing : true,
		serverSide : true,
		ajax : {
			url : "{{ route('admin.gallery.galleryPosted') }}",
			type : "POST",
		},
		// ajax : "posted-data",
		columns : [
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
				data : 'avatar', 
				"searchable": false,
				"orderable": false,
				render : function (data, type, full, meta) {
					var string = '<img src="'+data+'" width="70px" height="50px">';
					return string;
				}
			},
			{data : 'created_at'},
			{data : 'posted_at'},
			{
				data : 'id', 
				"searchable": false,
				"orderable" : false,
				render : function (data, type, full, meta) {
					var string = '<a href="{{ route("admin.gallery.edit") }}/'+data+'" class="btn btn-xs btn-warning">{{ Lang::get("gallery/backend.edit") }}</a>';
					string +=	'<button type="button" onclick="getDetail(this.value);return false;" value="'+data+'" class="btn btn-xs btn-danger">{{ Lang::get("gallery/backend.delete") }}</button>';
					return string;
				}
			}
		],

		// initComplete: function () {
		// 	this.api().columns([2,5]).every(function () {
		// 		var column = this;
		// 		var input = document.createElement("input");
		// 		$(input).addClass('form-control');
		// 		$(input).appendTo($(column.footer()).empty())
		// 		.on('change', function () {
		// 			column.search($(this).val(), false, false, true).draw();
		// 		});
		// 	});
		// }
	});
	//Search by category 

	// Add event listener for opening and closing details
	
$('#refresh-gallery-wating').on('click', function(e) {
	e.preventDefault();
	tbl_gallery_waiting.draw();
});
$('#refresh-gallery-posted').on('click', function(e) {
	e.preventDefault();
	tbl_gallery_posted.draw();
});

</script>
@endpush