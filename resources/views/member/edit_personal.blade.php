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
                        <a href="# " class="tintuc left-news ">Thông tin hội viên cá nhân</a>
                        <div class="border-bottom "></div>
                      </div>
                      <!-- ./row-1 -->
                      <div class="left-news top-block">
                        <div class="block-item ">
                          <div class="row">
                            <form  method="POST" enctype="multipart/form-data">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="items-hoivien  text-center ">
                                  <img src="{{ asset($user->avatar) }}" class="img img-thumbnail img-hoivien" id="img" name="img">
                                  <div class="select-img">
                                    <input type="file" name="input_file"  id="input_file" value="" class="select-file-item">
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                <div class="items ">
                                  <!--Item-->
                                  <div class="inf-user">
                                    <div class="row">
                                      <div class="col-xs-12">
                                        <span><b>Thông tin đăng nhập tài khoản</b></span>
                                      </div>
                                    </div>
                                    <div class="row distance-top">
                                      <div class="col-md-5 col-sm-6 col-xs-12">
                                        <p><strong>Tên đăng nhập :</strong></p>
                                      </div>
                                      <div class="col-md-7 col-sm-6 col-xs-12">
                                        <input type="text" name="username" value="{{ $user->name }}" required>
                                      </div>
                                    </div>
                                    <div class="row distance-top">
                                      <div class="col-md-5 col-sm-6 col-xs-12">
                                        <p><strong>Mật khẩu :</strong></p>
                                      </div>
                                      <div class="col-md-7 col-sm-6 col-xs-12">
                                        <input type="password" name="password" value="">
                                      </div>
                                    </div>
                                    <div class="row distance-top">
                                      <div class="col-md-5 col-sm-6 col-xs-12">
                                        <p><strong>Confirm mật khẩu :</strong></p>
                                      </div>
                                      <div class="col-md-7 col-sm-6 col-xs-12">
                                        <input type="password" name="password_confirmation" value="">
                                        @if ($errors->has('pass'))
                                        <span class="help-block">
                                          <strong style="color: red">{{ $errors->first('pass') }}</strong>
                                        </span>
                                        @endif
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row distance-top">
                                    <div class="col-xs-12">
                                      <span><b>Thông tin cá nhân</b></span>
                                    </div>
                                  </div>
                                  <div class="row distance-top">
                                    <div class="col-md-5 col-sm-6 col-xs-12">
                                      <p><strong>Họ và tên :</strong></p>
                                    </div>
                                    <div class="col-md-7 col-sm-6 col-xs-12">
                                      <input type="text" name="name" value="{{ $user->association->fullname }}" required>
                                    </div>
                                  </div>
                                  <!--Item-->
                                  <div class="row distance-top">
                                    <div class="col-md-5 col-sm-6 col-xs-12">
                                      <p><strong>Email :</strong></p>
                                    </div>

                                    <div class="col-md-7 col-sm-6 col-xs-12">
                                      <input type="text" name="email_association" value="{{ $user->association->email_association }}">
                                      @if ($errors->has('email_association'))
                                      <span class="help-block">
                                        <strong style="color: red">{{ $errors->first('email_association') }}</strong>
                                      </span>
                                      @endif
                                    </div>
                                  </div>
                                  <div class="row distance-top">
                                    <div class="col-md-5 col-sm-6 col-xs-12">
                                      <p><strong>Ngày sinh :</strong></p>
                                    </div>
                                    <div class="col-md-7 col-sm-6 col-xs-12">
                                      <input id="datepicker" readonly="" name="birthday" type="text" class="input-txt date calendar-search hasDatepicker" placeholder="" accesskey="1" value="{{ Carbon\Carbon::parse($user->association->birthday)->format('d/m/Y') }}">
                                     

                                    </div>
                                  </div>
                                  <!--Item-->
                                  <div class="row distance-top">
                                    <div class="col-md-5 col-sm-6 col-xs-12">
                                      <p><strong>Quê quán :</strong></p>
                                    </div>
                                    <div class="col-md-7 col-sm-6 col-xs-12">
                                      <input type="text" name="province" value="{{ $user->association->province }}">
                                    </div>
                                  </div>
                                  <!--Item-->
                                  <div class="row distance-top">
                                    <div class="col-md-5 col-sm-6 col-xs-12">
                                      <p><strong>Chuyên môn :</strong></p>
                                    </div>
                                    <div class="col-md-7 col-sm-6 col-xs-12">
                                      <input type="text" name="major" value="{{ $user->association->action_status }}">
                                    </div>
                                  </div>
                                  <!--Item-->
                                  <div class="row distance-top">
                                    <div class="col-md-5 col-sm-6 col-xs-12">
                                      <p><strong>Chức vụ :</strong></p>
                                    </div>
                                    <div class="col-md-7 col-sm-6 col-xs-12">
                                      <input type="text" name="position" value="{{ $user->association->position }}">
                                    </div>
                                  </div>
                                  <!--Item-->
                                  <div class="row distance-top">
                                    <div class="col-md-5 col-sm-6 col-xs-12">
                                      <p><strong>Cơ quan :</strong></p>
                                    </div>
                                    <div class="col-md-7 col-sm-6 col-xs-12">
                                      <input type="text" name="company" value="{{ $user->association->company }}">
                                    </div>
                                  </div>
                                  <!--Item-->
                                  <div class="row distance-top">
                                    <div class="col-md-5 col-sm-6 col-xs-12">
                                      <p><strong>Điện thoại cơ quan :</strong></p>
                                    </div>
                                    <div class="col-md-7 col-sm-6 col-xs-12">
                                      <input type="text" name="hotline" value="{{ $user->association->hotline }}">
                                    </div>
                                  </div>
                                  <!--Item-->
                                  <div class="row distance-top">
                                    <div class="col-md-5 col-sm-6 col-xs-12">
                                      <p><strong>Điện thoại di động :</strong></p>
                                    </div>
                                    <div class="col-md-7 col-sm-6 col-xs-12">
                                      <input type="text" name="phone" value="{{ $user->phone }}">
                                    </div>
                                  </div>
                                  <!--Item-->

                                  <!--Item-->
                                  <div class="row distance-top">
                                    <div class="col-md-5 col-sm-6 col-xs-12">
                                      <p><strong>Quá trình đào tạo :</strong></p>
                                    </div>
                                    <div class="col-md-7 col-sm-6 col-xs-12">
                                      <textarea name="train_process" class="textarea-item">{{ $user->association->train_process }}</textarea>
                                    </div>
                                  </div>
                                  <!--Item-->
                                  <div class="row distance-top">
                                    <div class="col-md-5 col-sm-6 col-xs-12">
                                      <p><strong>Quá trình công tác :</strong></p>
                                    </div>
                                    <div class="col-md-7 col-sm-6 col-xs-12">
                                      <textarea name="action_process" class="textarea-item">{{ $user->association->action_process }}</textarea>
                                    </div>
                                  </div>
                                  <!--Item-->
                                  <div class="row distance-top">
                                    <div class="col-md-5 col-sm-6 col-xs-12">
                                      <p><strong>Thông tin thêm :</strong></p>
                                    </div>
                                    <div class="col-md-7 col-sm-6 col-xs-12">
                                      <textarea name="info_add" class="textarea-item">{{ $user->association->info_add }}</textarea>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-md-4 col-md-offset-6 text-center btn-register">
                                      <button type="submit">Cập nhật</button>
                                    </div>

                                  </div>
                                </form>
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
  @push('scripts')
  <script type="text/javascript" src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
  <script>
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          $("#img").attr('src', e.target.result);
          $('#img').css('display', 'block');
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
    $("#input_file").change(function(){
      readURL(this);
    });
  </script>
  <script >
      // // date
      $(document).ready(function(){
        $('#datepicker,.datepicker,.hasDatepicker').datepicker({
          autoclose: true,
          todayHighlight: true,
          format : 'dd/mm/yyyy',
        });
      });
    </script>
    @endpush
    
