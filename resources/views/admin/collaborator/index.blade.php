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
				<h3>@lang('collaborator/backend.collaborator')</h3>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="clearfix"></div>
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<!-- X-title -->
					<div class="x_title">
						<h2>@lang('collaborator/backend.list_waited')</h2>
						<div class="clearfix"></div>
					</div>
					<!-- X-title -->
					
					<!-- X-content -->
					<div class="x_content">
						<div id="list_waiting">
							<div class="form-group">
								<table id="collaborator-waiting" class="table table-condensed table-bordered">
									<thead>
											<th>@lang('collaborator/backend.id')</th>
											<th>@lang('collaborator/backend.name')</th>
											<th>@lang('collaborator/backend.avatar')</th>
											<th>@lang('collaborator/backend.phone')</th>
											<th>@lang('collaborator/backend.email')</th>
											<th>@lang('collaborator/backend.address')</th>
											<th></th>
									</thead>
									<tbody>
										<?php foreach ($collaborator_waiting as $key => $value): ?>
											<tr>
												<td>{{ $key+1 }}</td>
												<td>{{ $value->name }}</td>
												<td><img src="{{ asset($value->avatar) }}" height="75px" width="100px"></td>
												<td>{{ $value->association->hotline }}</td>
												<td>{{ $value->email }}</td>
												<td>{{ $value->address }}</td>
												<td><a href="{{ route('admin.collaborator.activeCollaborator',['id'=>$value->id]) }}" class="btn btn-success btn-xs">@lang('collaborator/backend.active')</a>
												<a onclick="deleteCollaborator({{ $value->id }})" class="btn btn-danger btn-xs">@lang('collaborator/backend.cancel')</a></td>
											</tr>
										<?php endforeach ?>
									</tbody>
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
						<h2>@lang('collaborator/backend.actived')</h2>
						<div class="clearfix"></div>
					</div>
					<!-- X-title -->
					
					<!-- X-content -->
					<div class="x_content">
						<div id="list_actived">
							<div class="form-group">
								<table id="collaborator-actived" class="table table-condensed">
									<thead>
											<th>@lang('collaborator/backend.id')</th>
											<th>@lang('collaborator/backend.name')</th>
											<th>@lang('collaborator/backend.avatar')</th>
											<th>@lang('collaborator/backend.phone')</th>
											<th>@lang('collaborator/backend.email')</th>
											<th>@lang('collaborator/backend.address')</th>
											<th></th>
									</thead>
									<tbody>
										<?php foreach ($collaborator_actived as $key => $value): ?>
											<tr>
												<td>{{ $key+1 }}</td>
												<td>{{ $value->name }}</td>
												<td><img src="{{ asset($value->avatar) }}" height="75px" width="100px"></td>
												<td>{{ $value->phone }}</td>
												<td>{{ $value->email }}</td>
												<td>{{ $value->address }}</td>
												<td><a onclick="deleteCollaborator({{ $value->id }})" class="btn btn-danger btn-xs">@lang('collaborator/backend.delete')</a></td></td>
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
<script type="text/javascript" src="{{ asset('js/dataTables.min.js') }}"></script>
<script type="text/javascript">
	$('#collaborator-waiting').DataTable();
	$('#collaborator-actived').DataTable();
</script>
<script type="text/javascript">
	function deleteCollaborator(id) {
		var url = '{{ route("admin.collaborator.deleteCollaborator") }}'+'/'+id;
		$('#modal-delete a').attr('href',url);
		$('#modal-delete ').attr('href',url);
		$('#modal-delete').modal('show');
	}
</script>
@endpush