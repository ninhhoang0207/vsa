	@extends('templates.master')
	@section('header')
	<link rel="stylesheet" type="text/css" href="{{asset('css/dataTables.bootstrap.css')}}" />
	@endsection
	@section('content')
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>@lang('users/backend.users')</h3>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="clearfix"></div>
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<!-- X-title -->
					<div class="x_title">
						<h2>@lang('users/backend.list')</h2>
						<div class="clearfix"></div>
					</div>
					<!-- X-title -->
					<!-- X-content -->
					<div class="x_content">
						<table id="table_user" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Id</th>
									<th>Username</th>
									<th>Email</th>
									<th>Role</th>
									<th>Created_at</th>
									<th>Chức năng</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
					<!-- X-content -->
				</div>

			</div>
		</div>
	</div>
	@endsection
	@push('scripts')
	<script src="{{asset('js/dataTables.min.js')}}"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			var list = $('#table_user').DataTable({
				processing: true,
				serverSide: true,
				ajax: "{{route('user.data')}}",
				"columns":[
				{"data":null,
				"render": function (data,type,full, meta){
					return meta.row+1;
				},
				"searchable": false,
				"orderable": false 
			},
			{"data":"name"},
			{"data":"email"},
			{"data":"role"},
			{"data":"created_at"},
			{
				"data":"id",
				"render":function(data,type,full,meta){
					if(data==1){
						var string = '<a href="{{route("user.edit")}}/'+data+'" class="btn btn-xs btn-warning text-center">Sửa</a>';
						string+='<button type="button"  onclick="get_detail(this.value);return true;" value="'+data+'" class="btn btn-xs btn btn-danger" disabled >Xóa</button>'
						return string;
					}else{
						var string = '<a href="{{route("user.edit")}}/'+data+'" class="btn btn-xs btn-warning">Sửa</a>';
						string+='<button type="button"  onclick="get_detail(this.value);return true;" value="'+data+'" class="btn btn-xs btn btn-danger">Xóa</button>'
						return string;
					}
				}
			},
			
			],

			
		});
			
		});
		function get_detail(id){
			$.ajax({
				url:"{{route('user.detail')}}",
				method:"GET",
				data:{id:id},
				success:function(data){
					$('.modal-title').text("{{Lang::get('users/backend.users')}}: "+data.name);
					$('#user-delete').attr('href',"{{ route('user.delete') }}"+"/"+data.id);
					$('#modal-delete').modal("show");
				}
			})

		}
		$('#user-delete').on('click',function(e){
			e.preventDefault();
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			})
			$.ajax({
				url:$(this).attr('href'),
				type:"post",
				success:function(data){
					if (data == 1) {
						toastr.success('{{ Lang::get("news/backend.success") }}');
						$('#modal-delete').modal('hide');
						list.draw();
					} else {
						toastr.error('{{ Lang::get("news/backend.errors") }}');
					}
					
				}
			});

		});
		
	</script>
	@endpush