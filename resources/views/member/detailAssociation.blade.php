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
                    <a href="#" class="active">Hội viên pháp nhân</a>
                  </li>
                </ul>
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="tintuc_left">
                      <div class="link-block">
                        <a href="# " class="tintuc left-news ">Hội viên pháp nhân</a>
                        <div class="border-bottom "></div>
                      </div>
                      <div class="left-news top-block">


                        <!-- ./row-1 -->
                        <div class="block-item">
                          <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                              <div class="items text-center">
                                <img src="{{ asset($user['avatar']) }}" alt="avata" class="img-hoivien mg img-thumbnail">
                              </div>
                            </div>
                            <div class="col-md-8 col-sm-4 col-xs-12">
                              <div class="items ">
                                <!--Item-->
                                <div class="row">
                                  <div class="col-md-4">
                                    <p><strong>Tên doanh nghiêp:</strong></p>
                                  </div>
                                  <div class="col-md-7">
                                    <p>{{$detail['fullname']}}</p>
                                  </div>
                                </div>
                                <!--Item-->
                                <div class="row">
                                  <div class="col-md-4">
                                    <p><strong>Tên thương mại:</strong></p>
                                  </div>
                                  <div class="col-md-7">
                                    <p>{{$detail['bussiness_name']}}</p>
                                  </div>
                                </div>
                                <!--Item-->
                                <div class="row">
                                  <div class="col-md-4">
                                    <p><strong>Logo:</strong></p>
                                  </div>
                                  <div class="col-md-7">

                                    <img src="{{ asset($detail['logo']) }}" alt="logo">
                                  </div>
                                </div>
                                <!--Item-->
                                <div class="row">
                                  <div class="col-md-4">
                                    <p><strong>Địa chỉ:</strong></p>
                                  </div>
                                  <div class="col-md-7">
                                    <p>{{$user['address']}}</p>
                                  </div>
                                </div>
                                <!--Item-->
                                <div class="row">
                                  <div class="col-md-4">
                                    <p><strong>Tỉnh(TP):</strong></p>
                                  </div>
                                  <div class="col-md-7">
                                    <p>{{$detail['province']}}</p>
                                  </div>
                                </div>
                                <!--Item-->
                                <div class="row">
                                  <div class="col-md-4">
                                    <p><strong>Lĩnh vực hoạt động:</strong></p>
                                  </div>
                                  <div class="col-md-7">
                                    <p>{{$detail['action_status']}}</p>
                                  </div>
                                </div>
                                <!--Item-->
                                <div class="row">
                                  <div class="col-md-4">
                                    <p><strong>Điện thoại công ty:</strong></p>
                                  </div>
                                  <div class="col-md-7">
                                    <p>{{$detail['hotline']}}</p>
                                  </div>
                                </div>
                                <!--Item-->
                                <div class="row">
                                  <div class="col-md-4">
                                    <p><strong>Fax:</strong></p>
                                  </div>
                                  <div class="col-md-7">
                                    <p>{{$detail['fax']}}</p>
                                  </div>
                                </div>
                                <!--Item-->
                                <div class="row">
                                  <div class="col-md-4">
                                    <p><strong>Email:</strong></p>
                                  </div>
                                  <div class="col-md-7">
                                    <p>{{$user['email']}}</p>
                                  </div>
                                </div>
                                <!--Item-->
                                <div class="row">
                                  <div class="col-md-4">
                                    <p><strong>Website:</strong></p>
                                  </div>
                                  <div class="col-md-7">
                                    <p>{{$detail['site']}}</p>
                                  </div>
                                </div>
                                <!--Item-->
                                <div class="row">
                                  <div class="col-md-4">
                                    <p><strong>HT QLCL:</strong></p>
                                  </div>
                                  <div class="col-md-7">
                                    <p>{{$detail['code']}}</p>
                                  </div>
                                </div>
                                <!--Item-->
                                <div class="row">
                                  <div class="col-md-4">
                                    <p><strong>Sản phẩm:</strong></p>
                                  </div>
                                  <div class="col-md-7">
                                    <p>{{$detail['product']}}</p>
                                  </div>
                                </div>
                                <!--Item-->
                                <div class="row">
                                  <div class="col-md-4">
                                    <p><strong>Thông tin thêm:</strong></p>
                                  </div>
                                  <div class="col-md-7">
                                    <p>{{$detail['info_add']}}</p>
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
        <!-- ./right-2 -->
        @include('includes/homepage.right_content')
        <!-- row-1 -->
      </div>
    </div>
  </div>
  <!--contact-->
</content>
@endsection