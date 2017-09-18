@extends('templates.master')

@section('title')
@endsection

@section('header')
<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.treetable.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.treetable.theme.default.css') }}">
@endsection

@section('content')
<form class="form-horizontal form-label-left" method="POST" enctype="multipart/form-data">
	{{ csrf_field() }}
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>@lang('category/backend.category')</h3>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="clearfix"></div>
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<!-- X-title -->
					<div class="x_title">
						<h2>@lang('category/backend.title')</h2>
						<div class="nav navbar-right">
							<a class="btn btn-primary" href="{{ route('admin.category.create') }}">@lang('news/backend.add')</a>
						</div>
						<div class="clearfix"></div>
					</div>
					<!-- X-title -->
					
					<!-- X-content -->
					<div class="x_content">
						<div id="list">
							<div class="form-group">
								<table id="category_table" class="table">
									<!-- <caption>Basic jQuery treetab	le Example</caption> -->
									<thead>
										<th>@lang('category/backend.id')</th>
										<th>@lang('category/backend.title')</th>
										<th>@lang('category/backend.status')</th>
										<th>@lang('category/backend.function')</th>
									</thead>
									<tbody>
										@if (!count($list))
										<tr><b>@lang('category/backend.nodata')<b></tr>
										@endif
										<?php foreach ($list as $key => $value): ?>
											<tr data-tt-id="{{ $value->id }}" data-tt-branch="true" id="{{ $value->id }}">
												<td align="center">{{ $key+1 }}</td>
												<td>{{ $value->title."(".count($value->children).")" }}</td>
												<td align="center">{{ $value->status==0?Lang::get('category/backend.hide'):Lang::get('category/backend.show') }}</td>
												<td align="center">
													<a href="{{ route('admin.category.addChild',['id'=>$value->id]) }}" class="btn btn-xs btn-success">@lang('category/backend.add_child')</a>
													<a href="{{ route('admin.category.edit',['id'=>$value->id]) }}" class="btn btn-xs btn-warning">@lang('category/backend.edit')</a>
													<button type="button" onclick="get_detail(this.value);return false;" value="{{ $value->id }}" class="btn btn-xs btn-danger">@lang('category/backend.delete')</button>
												</td>
											</tr>
										<?php endforeach ?>
									</tbody>
								</table>
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
<script type="text/javascript" src="{{ asset('js/jquery.treetable.js') }}"></script>
<script type="text/javascript">
	$('#category_table').treetable({
		expandable : true,
		column : 1,
		expanderTemplate : '<a href="#">&nbsp;</a>',
		onNodeExpand : function () {
			var id = this.id;
			if (this.children.length == 0) {// Check if this node has already loaded before
				$.ajax({
					url : "{{ route('admin.category.getChildNode') }}",
					data : {parent_id:id},
				}).done(function(data) {
					var html = '';
					$.each(data, function(index,value) {
						html += '<tr data-tt-id="'+value.id+'" data-tt-parent-id="'+
						value.parent_id+'" data-tt-branch="true">'+
						'<td></td>'+
						'<td>'+value.title+'('+value.count+')</td>'+
						'<td align="center">'+value.status+'</td>'+
						'<td align="center">'+
						'<a href="{{ route("admin.category.addChild") }}/'+value.id+'" class="btn btn-xs btn-success">{{ Lang::get("category/backend.add_child") }}</a>'+
						'<a href="{{ route("admin.category.edit") }}/'+value.id+'" class="btn btn-xs btn-warning">{{ Lang::get("category/backend.edit") }}</a>'+
						'<button type="button" onclick="get_detail(this.value);return false;" value="'+value.id+'" class="btn btn-xs btn-danger">Xóa</button>'+
						'</tr>';
					});
					console.log(html);
					var node = $("#category_table").treetable("node",id);
					$('#category_table').treetable('loadBranch',node,html);				
					});
			}
		},
	})
</script>
<script type="text/javascript">
	function get_detail(id) {
		$.ajax({
			url : "{{ route('admin.category.detail') }}",
			data : { id:id },
			type : "GET",
		}).done(function(data) {
			if (data != -1) {
				$('.modal-title').text("{{Lang::get('category/backend.title')}}: "+data.title);
				$('.modal-body').text('{{ Lang::get("category/backend.delete_warning") }}');
				$('#confirm-delete').attr('href',"{{ route('admin.category.delete') }}"+"/"+data.id);
				$('#modal-delete').modal("show");
			} else {
				toastr.error('{{ Lang::get("general.error") }}');
			}
		});
	}

	$('#confirm-delete').on('click', function(e) {
		e.preventDefault();
		$('#modal-delete').modal('hide');
		$.ajax({
			url : $(this).attr('href'),
			type : "GET",
		}).done(function(data) {
			$('#modal-delete').modal('hide');
		toastr.success('{{ Lang::get("news/backend.success") }}');
			window.location.replace("{{ route('admin.category.index') }}");
		});
	});
</script>
@endpush