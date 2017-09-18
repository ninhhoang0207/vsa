@extends('templates.master')

@section('header')
<link rel="stylesheet" type="text/css" href="{{ asset('css/dataTables.bootstrap.css') }}"/>
@endsection


@section('content')
<div class="">
	<div class="page-title">
		<div class="title_left">
			<h3>@lang('contact/backend.contact')</h3>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="row">
		<div class="clearfix"></div>
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<!-- X-title -->
				<div class="x_title">
					<h2>@lang('contact/backend.list')</h2>
					<div class="clearfix"></div>
				</div>
				<!-- X-title -->

				<!-- X-content -->
				<div class="x_content">
					<div id="list_waiting">
						<div class="form-group">
							<table id="table-contact" class="table table-condensed table-bordered">
								<thead>
									<th>@lang('contact/backend.id')</th>
									<th>@lang('contact/backend.name')</th>
									<th>@lang('contact/backend.email')</th>
									<th>@lang('contact/backend.phone')</th>
									<th>@lang('contact/backend.content')</th>
									<th></th>
								</thead>
								<tbody>
									<?php foreach ($contacts as $key => $value): ?>
										<tr>
											<td>{{ $key+1 }}</td>
											<td>{{ $value->name }}</td>
											<td>{{ $value->email }}</td>
											<td>{{ $value->phone }}</td>
											<td width="40%">{{ str_limit($value->content,$limit=100,$end='...') }}</td>
											<td>
												<button onclick="detail({{ $value->id }})" class="btn btn-info btn-xs">@lang('contact/backend.more_detail')</button>
												<a onclick="deleteContact({{ $value->id }})" class="btn btn-danger btn-xs">@lang('contact/backend.delete')</a></td>
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
	</div>
	@endsection
	@push('scripts')
	<script type="text/javascript" src="{{ asset('js/dataTables.min.js') }}"></script>
	<script type="text/javascript">
		$('#table-contact').DataTable();
	</script>
	<script type="text/javascript">
		function deleteContact(id) {
			var url = '{{ route("admin.contact.delete") }}'+'/'+id;
			$('#modal-delete a').attr('href',url);
			$('#modal-delete ').attr('href',url);
			$('#modal-delete').modal('show');
		}
	</script>
	@endpush