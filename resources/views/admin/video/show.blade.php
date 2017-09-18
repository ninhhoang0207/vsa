@extends('templates.master')

@section('header')
<link rel="stylesheet" type="text/css" href="{{ asset('css/dataTables.bootstrap.css') }}"/>
@endsection
@section('content')
	<div class="page-title">
			<div class="title_left">
				<h3>@lang('video/backend.video')</h3>
			</div>
	</div>
	<div class="clearfix"></div>
	<div class="row">
		 <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
		 	<tbody id="tbodyTable">
         {{-- @foreach($users as $user) --}}
            <tr>
               <td>@lang('video/backend.id')</td>
               <td>{{ $data[ 'id' ] }}</td>
            </tr>
            <tr>
               <td>@lang('video/backend.title')</td>
               <td>{{ $data[ 'title' ] }}</td>
            </tr>
            <tr>
               <td>@lang('video/backend.desciption')</td>
               <td>{!! $data[ 'desciption' ]!!}</td>
            </tr>
 			<tr>
               <td>@lang('video/backend.avatar')</td>
               <td><img src="{{URL::asset( $data['title_image' ] )}}"  class="img-responsive" style="width: 100px" /></td></td>
            </tr>
           {{--  <tr>
               <td>@lang('video/backend.video')</td>
               <td> 
              
               <iframe src="//www.youtube.com/embed/{{$data->url}}" width="560" height="314" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
      
				</td>
            </tr> --}}
            
            <tr>
               <td>@lang('video/backend.created_at')</td>
               <td>{{ date("H:i:s d/m/Y",strtotime( $data[ 'created_at' ] ))}}</td>
            </tr>           
         </tbody>
		 </table>
	<div class="form-actions text-center">
         <div class="col-xs-12 col-sm-12" style="margin-top: 20px;">
           <a href="{{route('admin.video.index')}}" class="btn btn-xs btn-primary"> @lang('video/backend.back')
           </a>               
         </div>
      </div>
	</div>
@endsection