@extends('templates.master')

@section('header')
<link rel="stylesheet" type="text/css" href="{{ asset('css/dataTables.bootstrap.css') }}"/>
@endsection


@section('content')
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
					<h2>@lang('news/backend.list')</h2>
					<div class="nav navbar-right">
						<a href="{{ route('news.add') }}" class="btn btn-primary">@lang('news/backend.add')</a>
					</div>
					<div class="clearfix"></div>
				</div>
				<!-- X-title -->

				<!-- X-content -->
				<div class="x_content">
					<div id="list">
						<div class="form-group">
							<table id="news_list" class="table table-condensed">
								<thead>
									<th></th>
									<th>@lang('news/backend.id')</th>
									<th>@lang('news/backend.title')</th>
									<th>@lang('news/backend.avatar')</th>
									<th>@lang('news/backend.created_at')</th>
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
<!-- Modal delete-->
<div id="modal-delete" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<p>@lang('news/backend.warning_delete')</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">@lang('news/backend.cancel')</button>
				<a href="" id="news-delete"  class="btn btn-danger" >@lang('news/backend.delete')</a>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script type="text/javascript" src="{{ asset('js/dataTables.min.js') }}"></script>
<script type="text/javascript">
	var table = $('#news_list').DataTable({
		processing : true,
		serverSide : true,
		ajax : "{{ route('news.data') }}",
		columns : [
			{
				"className":      'details-control',
				"orderable":      false,
				"searchable":     false,
				"data":           null,
				"defaultContent": '',
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
				width : '50%',
			},
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
			{
				data : 'id', 
				"searchable": false,
				"orderable" : false,
				render : function (data, type, full, meta) {
					var string = '<a href="{{ route("news.edit") }}/'+data+'" class="btn btn-sm btn-warning">Sửa</a>';
					string +=	'<button type="button" onclick="get_detail(this.value);return false;" value="'+data+'" class="btn btn-sm btn-danger">Xóa</button>';
					return string;
				}
			}
		],
		initComplete: function () {
			this.api().columns([2,4]).every(function () {
				var column = this;
				var input = document.createElement("input");
				$(input).appendTo($(column.footer()).empty())
				.on('change', function () {
					column.search($(this).val(), false, false, true).draw();
				});
			});
		}
	});

	$('#news_list tfoot td').removeClass('details-control');

	// Add event listener for opening and closing details
	$('#news_list tbody').on('click', 'td.details-control', function () {
	 	var tr = $(this).closest('tr');
	 	var row = table.row( tr );

	 	if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
         }
      else {
            string = "";
            $.ajax({
            	url : "{{ route('news.detail') }}",
            	data : { id:row.data().id },
            	type : "GET",
            }).done(function(data) {
            	if (data != 1) {
            		string += '<table class="table">';
            		string += '<tr>';
            		string += '<td>{{ Lang::get("news/backend.created_by") }} :</td>';
            		string += '<td>'+data.created_by+'</td>';
            		string += '</tr>';
            		string += '<tr>';
            		string += '<td>{{ Lang::get("news/backend.updated_by") }} :</td>';
            		string += '<td>'+data.updated_by+'</td>';
            		string += '</tr>';
            		string += '<tr>';
            		string += '<td>{{ Lang::get("news/backend.updated_at") }} :</td>';
            		string += '<td>'+data.updated+'</td>';
            		string += '</tr>';
            		string += '<table>';
            		row.child( string ).show();
            		tr.addClass('shown');
            	}
            });
      }
   });
</script>
<script type="text/javascript">
	function get_detail(id) {
		$.ajax({
			url : "{{ route('news.detail') }}",
			data : { id:id },
			type : "GET",
		}).done(function(data) {
			console.log(data);
			$('.modal-title').text("{{Lang::get('news/backend.article')}}: "+data.title);
			$('#news-delete').attr('href',"{{ route('news.delete') }}"+"/"+data.id);
			$('#modal-delete').modal("show");
		});
	}

	$('#news-delete').on('click', function(e) {
		e.preventDefault();
		$('#modal-delete').modal('hide');
		$.ajax({
			url : $(this).attr('href'),
			type : "GET",
		}).done(function(data) {
			if (data == 1) {
				list.draw();
				toastr.error('{{ Lang::get("news/backend.success") }}');
			} else {
				toastr.error('{{ Lang::get("news/backend.errors") }}');
			}
			$('#modal-delete').modal('hide');
		});
	});
</script>
