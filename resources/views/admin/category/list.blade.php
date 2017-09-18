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
						<h2>@lang('category/backend.list')</h2>
						<div class="clearfix"></div>
					</div>
					<!-- X-title -->
					
					<!-- X-content -->
					<div class="x_content">
						<div id="list">
							<div class="form-group">
								<table id="category_table" class="table">
									<caption>Basic jQuery treetable Example</caption>
									<thead>
											<th>Tree column</th>
											<th>Additional data</th>
									</thead>
									<tbody>
										<tr data-tt-id="1">
											<td>Node 1: Click on the icon in front of me to expand this branch.</td>
											<td>I live in the second column.</td>
										</tr>
										<tr data-tt-id="1.1" data-tt-parent-id="1">
											<td>Node 1.1: Look, I am a table row <em>and</em> I am part of a tree!</td>
											<td>Interesting.</td>
										</tr>
										<tr data-tt-id="1.1.1" data-tt-parent-id="1.1">
											<td>Node 1.1.1: I am part of the tree too!</td>
											<td>That's it!</td>
										</tr>
										<tr data-tt-id="2">
											<td>Node 2: I am another root node, but without children</td>
											<td>Hurray!</td>
										</tr>
										<tr data-tt-id="1.2" data-tt-parent-id="1">
											<td>Node 1.1: Look, I am a table row <em>and</em> I am part of a tree!</td>
											<td>Interesting.</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-3 col-sm-3 col-xs-12"></div>
							<div class="col-md-6 col-sm-6 col-xs-12 text-center">
								<button class="btn btn-default">@lang('category/backend.cancel')</button>
								<button class="btn btn-primary" type="submit">@lang('category/backend.add')</button>
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
	})
</script>
@endpush