@extends('templates.main')

@section('content')
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
                    <li><a href="#" class="active">Đăng ký hội viên</a></li>
                  </ul>
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <div class="tintuc_left">
                        <div class="link-block">
                          <a href="# " class="tintuc left-news ">Đăng ký làm hội viên VSA</a>
                          <div class="border-bottom "></div>
                        </div>
                        <div class="form-left top-block">
                          <!-- ./row-1 -->
                          <div class="register-text">
                            <p>Để đăng ký làm Hội viên VASEP, vui lòng download file dưới đây:</p>
                            <div class="text1">
                             
                                <div class="row">
                                  <div class="col-md-7 col-sm-7 col-xs-12">
                                    <p><strong class="text-bold">ĐĂNG KÝ HỘI VIÊN PHÁP NHÂN</strong></p>
                                    <p>
                                      <strong><span >1.</span></strong>
                                      <strong>
                                        <a target="_blank" href="#"> Đơn đăng ký tham gia VSA của doanh nghiệp, tổ chức. </a>
                                      </strong>
                                    </p>
                                    <p>
                                      <strong><span >2.</span></strong>
                                      <strong>
                                        <a target="_blank" href=""> Sơ yếu lý lịch của người đại diện hội viên pháp nhân. </a>
                                      </strong>
                                    </p>
                                    <p>
                                      <strong><span >3.</span></strong>
                                      <strong>
                                        <a target="_blank" href=""> Thông tin tóm tắt về Công ty, tổ chức hội viên VSA. </a>
                                      </strong>
                                    </p>
                                  </div>
                                  <div class="col-md-5 col-sm-5 col-xs-12">
                                    <p><strong class="text-bold">HOẶC ĐĂNG KÝ NGAY TẠI ĐÂY:</strong></p>
                                    <div class="register-btn">
                                      <button class="btn box-btn1" type=""><a href="{{ route('member.register.personal') }}"><span class="fa fa-user"></span> Đăng ký hội viên cá nhân</a></button>
                                      <br>
                                      <button class="btn box-btn2" type=""><a href="{{ route('member.register.association') }}"><span class="fa fa-users"></span> Đăng ký hội viên pháp nhân</a></button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="text2">
                                  <div class="row">
                                    <div class="col-md-12 col-xs-12">
                                      <p><strong class="text-bold">ĐĂNG KÝ HỘI VIÊN CÁ NHÂN</strong></p>
                                      <p>
                                        <strong><span >1.</span></strong>
                                        <strong>
                                          <a target="_blank" href=""> Sơ yếu lý lịch hội viên cá nhân. </a>
                                        </strong>
                                      </p>
                                      <p>
                                        <strong><span >2.</span></strong>
                                        <strong>
                                          <a target="_blank" href=""> Đơn xin gia nhập VSA của cá nhân. </a>
                                        </strong>
                                      </p>
                                    </div>
                                </div>
                              </div>
                              <div class="footer-text">
                                <p>Sau khi điền đầy đủ thông tin, vui lòng gửi về địa chỉ email: <a href="">vuvananh.vsp@gmail.com</a></p>
                                <p>Mọi thắc mặc xin liên hệ với:</p>
                                <p>Ms. Vân Anh – Thư ký Văn phòng Hiệp hội</p>
                                <p>Email: vuvananh.vsp@gmail.com</p>
                                <p>Tel: 04 38746888</p>
                                <p>Mobile: 0979 568 974</p>
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