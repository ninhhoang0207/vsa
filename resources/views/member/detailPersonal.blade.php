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
                  <li>
                    <a href="#" class="active">Hội viên cá nhân</a>
                  </li>
                </ul>
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="tintuc_left">
                      <div class="link-block">
                        <a href="# " class="tintuc left-news ">Thông tin cá nhân</a>
                        <div class="border-bottom "></div>
                      </div>
                      <div class="left-news top-block">
                        <!-- ./row-1 -->
                        <div class="block-item">
                          <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                              <div class="items text-center">
                                <img src="{{ asset($user->avatar) }}" alt="avata" class="img-responsive">
                              </div>
                            </div>
                            <div class="col-md-8 col-sm-4 col-xs-12">
                              <div class="items ">
                                <!--Item-->
                                <div class="row">
                                  <div class="col-md-4">
                                    <p><strong>Họ và tên:</strong></p>
                                  </div>
                                  <div class="col-md-8">
                                    <p>{{$user->association->fullname}}</p>
                                  </div>
                                </div>
                                
                                <!--Item-->
                                <div class="row">
                                  <div class="col-md-4">
                                    <p><strong>Ngày sinh:</strong></p>
                                  </div>
                                  <div class="col-md-8">
                                    <p>{{$user->association->birthday}} </p>
                                  </div>
                                </div>
                                
                                <!--Item-->
                                <div class="row">
                                  <div class="col-md-4">
                                    <p><strong>Quê quán:</strong></p>
                                  </div>
                                  <div class="col-md-8">
                                    <p>{{$user->association->province}} </p>
                                  </div>
                                </div>
                                
                                <!--Item-->
                                <div class="row">
                                  <div class="col-md-4">
                                    <p><strong>Chuyên môn:</strong></p>
                                  </div>
                                  <div class="col-md-8">
                                    <p>{{$user->association->action_status}} </p>
                                  </div>
                                </div>
                                
                                <!--Item-->
                                <div class="row">
                                  <div class="col-md-4">
                                    <p><strong>Chức vụ:</strong></p>
                                  </div>
                                  <div class="col-md-8">
                                    <p>{{$user->association->position}}</p>
                                  </div>
                                </div>
                                
                                <!--Item-->
                                <div class="row">
                                  <div class="col-md-4">
                                    <p><strong>Cơ quan:</strong></p>
                                  </div>
                                  <div class="col-md-8">
                                    <p>{{$user->association->company}}</p>
                                  </div>
                                </div>
                                
                                <!--Item-->
                                <div class="row">
                                  <div class="col-md-4">
                                    <p><strong>Điện thoại cơ quan:</strong></p>
                                  </div>
                                  <div class="col-md-8">
                                    <p>{{$user->association->hotline}}</p>
                                  </div>
                                </div>
                                
                                <!--Item-->
                                <div class="row">
                                  <div class="col-md-4">
                                    <p><strong>Điện thoại di động:</strong></p>
                                  </div>
                                  <div class="col-md-8">
                                    <p>{{$user->phone}}</p>
                                  </div>
                                </div>
                                
                                <!--Item-->
                                <div class="row">
                                  <div class="col-md-4">
                                    <p><strong>Email:</strong></p>
                                  </div>
                                  <div class="col-md-8">
                                    <p>{{$user->email}}</p>
                                  </div>
                                </div>
                                
                                <!--Item-->
                                <div class="row">
                                  <div class="col-md-4">
                                    <p><strong>Quá trình đào tạo:</strong></p>
                                  </div>
                                  <div class="col-md-8">
                                   <p><strong>{{$user->association->train_process}}</strong></p>
                                 </div>
                               </div>
                               
                               <!--Item-->
                               <div class="row">
                                <div class="col-md-4">
                                  <p><strong>Quá trình công tác:</strong></p>
                                </div>
                                <div class="col-md-8">
                                  <p>{{$user->association->action_process}}</p>
                                </div>
                              </div>
                              
                              <!--Item-->
                              <div class="row">
                                <div class="col-md-4">
                                  <p><strong>Thông tin thêm:</strong></p>
                                </div>
                                <div class="col-md-8">
                                  <p>{{$user->association->info_add}}</p>
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