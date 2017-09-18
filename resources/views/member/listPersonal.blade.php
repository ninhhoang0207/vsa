@extends('templates.main')
@section('content')
<content>
  <!-- contet -->
  <div id="page" class="main-page-news">
    <div class="container">
      <div class="row">
        <!--tintuc-left -->
        <div class="left-fix">
          <div class="col-md-9 col-sm-12 col-xs-12">
            <div class="left-block">
              <!-- ./nav news -->
              <div class="news-content">
                <ul class="breadcrumb">
                  <li><a href="#">Trang chủ</a></li>
                  <li><a href="#"> Hội viên</a></li>
                  <li><a href="#"> Hội viên chính thức</a></li>
                  <li>
                    <a href="#" class="active">Hội viên cá nhân</a>
                  </li>
                </ul>
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="tintuc_left">
                      <div class="link-block">
                        <a href="# " class="tintuc left-news ">Danh sách hội viên cá nhân</a>
                        <div class="border-bottom "></div>
                      </div>
                      <div class="left-news">
                       
                        <!-- ./row-1 -->
                        <div class="block-item">
                          <div class="row">
                           @foreach($personal as $per)
                           <div class="col-md-3 col-sm-3 col-xs-4">
                            <div class="items items-img text-center ">
                              <img src="{{ asset($per->avatar) }}" alt="avata" class="img-responsive avata-hv">
                              <a href="{{ route('member.personal.show',['id'=>$per->id]) }}">{{$per->name}}</a>
                              <h5>{{ $per->association->province }}</h5>
                            </div>
                          </div>
                          @endforeach
                        </div>
                      </div>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- phan3-tintuc-right -->
      @include('includes/homepage.right_content')
      <!-- row-1 -->
    </div>
  </div>
</div>
<!--contact-->
</content>
@endsection