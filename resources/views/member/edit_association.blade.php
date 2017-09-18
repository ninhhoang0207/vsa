@extends('templates.main')

@section('content')
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
                    <a href="# " class="tintuc left-news ">Thông tin hội viên pháp nhân</a>
                      <div class="border-bottom "></div>
                    </div>
                    <div class="left-news top-block">
                      <div class="block-item">
                        <div class="row">
                          <form method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                              <div class="items-hoivien text-center">
                                <img src="{{ asset($user->avatar) }}" alt="" id="avatar" name="avatar" class=" img img-thumbnail img-hoivien">
                                <div class="select-img">
                                  <input type="file" name="file_item" id="file_item" value="" class="select-file-item">
                                </div>
                              </div>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                              <div class="items ">
                                <!--Item-->
                                <div class="row">
                                  <div class="col-md-5 col-sm-6 col-xs-12">
                                    <p><strong>Tên doanh nghiệp :</strong></p>
                                  </div>
                                  <div class="col-md-7 col-sm-6 col-xs-12">
                                    <input type="text" name="name" value="{{ $user->association->fullname }}" required>
                                  </div>
                                </div>
                                <!--Item-->
                                <div class="row distance-top">
                                  <div class="col-md-5 col-sm-6 col-xs-12">
                                    <p><strong>Tên thương mại :</strong></p>
                                  </div>
                                  <div class="col-md-7 col-sm-6 col-xs-12">
                                    <input type="text" name="bussiness_name" value="{{ $user->association->bussiness_name }}">
                                  </div>
                                </div>
                              <!--Item-->
                              <div class="row distance-top">
                                <div class="col-md-5 col-sm-6 col-xs-12">
                                  <p><strong>Logo :</strong></p>
                                </div>
                                <div class="col-md-7 col-sm-6 col-xs-12">
                                  <input id="logo" type="file" name="file" value="" class="select-file-item">
                                  <img src="{{ asset($user->association->logo) }}" id="preview-logo">
                                </div>
                              </div>
                              <!--Item-->
                              <div class="row distance-top">
                                <div class="col-md-5 col-sm-6 col-xs-12">
                                  <p><strong>Địa chỉ :</strong></p>
                                </div>
                                <div class="col-md-7 col-sm-6 col-xs-12">
                                  <input type="text" name="address" value="{{ $user->address }}">
                                </div>
                              </div>
                              <!--Item-->
                              <div class="row distance-top">
                                <div class="col-md-5 col-sm-6 col-xs-12">
                                  <p><strong>Tỉnh(TP) :</strong></p>
                                </div>
                                <div class="col-md-7 col-sm-6 col-xs-12">
                                  <input type="text" name="province" value="{{ $user->association->province }}">
                                </div>
                              </div>
                              <!--Item-->
                              <div class="row distance-top">
                                <div class="col-md-5 col-sm-6 col-xs-12">
                                  <p><strong>Lĩnh vực hoạt động :</strong></p>
                                </div>
                                <div class="col-md-7 col-sm-6 col-xs-12">
                                  <textarea name="action_status" class="textarea-item">{{ $user->association->action_status }}</textarea>
                                </div>
                              </div>
                              <!--Item-->
                              <div class="row distance-top">
                                <div class="col-md-5 col-sm-6 col-xs-12">
                                  <p><strong>Điện thoại công ty :</strong></p>
                                </div>
                                <div class="col-md-7 col-sm-6 col-xs-12">
                                  <input type="text" name="hotline" value="{{ $user->association->hotline }}">
                                </div>
                              </div>
                              <!--Item-->
                              <div class="row distance-top">
                                <div class="col-md-5 col-sm-6 col-xs-12">
                                  <p><strong>Fax :</strong></p>
                                </div>
                                <div class="col-md-7 col-sm-6 col-xs-12">
                                  <input type="text" name="fax" value="{{ $user->association->fax }}">
                                </div>
                              </div>
                              <!--Item-->

                              <!--Item-->
                              <div class="row distance-top">
                                <div class="col-md-5 col-sm-6 col-xs-12">
                                  <p><strong>Website :</strong></p>
                                </div>
                                <div class="col-md-7 col-sm-6 col-xs-12">
                                  <input type="text" name="site" value="{{ $user->association->site }}">
                                </div>
                              </div>
                              <!--Item-->
                              <div class="row distance-top">
                                <div class="col-md-5 col-sm-6 col-xs-12">
                                  <p><strong>HT QLCL :</strong></p>
                                </div>
                                <div class="col-md-7 col-sm-6 col-xs-12">
                                  <textarea name="code" class="textarea-item">{{ $user->association->code }}</textarea>
                                </div>
                              </div>
                              <!--Item-->
                              <div class="row distance-top">
                                <div class="col-md-5 col-sm-6 col-xs-12">
                                  <p><strong>Sản phẩm :</strong></p>
                                </div>
                                <div class="col-md-7 col-sm-6 col-xs-12">
                                  <textarea name="product" class="textarea-item">{{ $user->association->product }}</textarea>
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
                                  <button type="submit">Chỉnh sửa</button>
                                </div>
                              </div>
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
      <!-- phan3-tintuc-right -->
      @include('includes/homepage.right_content')
      <!-- row-1 -->
    </div>
  </div>
</div>
@endsection
@push('scripts')
<script>
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $("#avatar").attr('src', e.target.result);
        $('#avatar').css('display', 'block');
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
  $("#file_item").change(function(){
    readURL(this);
  });
  function previewLogo(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $("#preview-logo").attr('src', e.target.result);
        $('#preview-logo').css('display', 'block');
      };
      reader.readAsDataURL(input.files[0]);
    }
  }
  $("#logo").change(function(){
    previewLogo(this);
  });
</script>
@endpush