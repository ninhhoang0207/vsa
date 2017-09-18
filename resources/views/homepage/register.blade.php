    @extends('templates.main')
    @push('styles')
    <link rel="stylesheet" href="{{asset('iCheck/skins/flat/green.css')}}">
    @endpush
    @section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>Đăng ký hội viên</strong>  </div>
                    <div class="panel-body">
                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif
                        <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                            {{ csrf_field() }}
                                
                            <div class="form-group">
                                <label for="type" class="col-md-4 control-label">Kiểu thành viên</label>
                                <div class="col-md-6">
                                  <div class="">
                                        <label>
                                            <input type="radio" name="member_type" id="accoc" required  value="2" /> Doanh nghiệp &nbsp
                                            <input type="radio" name="member_type" id="person" value="1" />Cá nhân
                                        </label>
                                    </div>
                              
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Tên đăng nhập </label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus placeholder="tên thành viên">

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="phone" class="col-md-4 control-label">Tên thương mại</label>
                                <div class="col-md-6">
                                    <input type="text" id="bussiness_name" name="bussiness_name" class="form-control" placeholder="Tên thương mại ">
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail </label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="email">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="phone" class="col-md-4 control-label">Điện thoại công ty</label>
                                <div class="col-md-6">
                                    <input type="text" id="phone" name="phone" class="form-control" placeholder="Điện thoại ">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="logo" class="col-md-4 control-label">Logo</label>
                                <div class="col-md-6">
                                    <input type="file" class="form-control" name="logo" id="logo" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address" class="col-md-4 control-label">Địa chỉ</label>
                                <div class="col-md-6">
                                    <input type="text" id="address" name="address" class="form-control" placeholder="Địa chỉ">
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="province" class="col-md-4 control-label">Tỉnh</label>
                                <div class="col-md-6">
                                    <input type="text" id="province" name="province" class="form-control" placeholder="Tỉnh\Thành phố">
                                </div>
                            </div>
                             <div class="form-group">
                                <label for="site" class="col-md-4 control-label">Web site</label>
                                <div class="col-md-6">
                                    <input type="text" id="site" name="site" class="form-control" placeholder="Web site">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address" class="col-md-4 control-label">Fax</label>
                                <div class="col-md-6">
                                    <input type="text" id="fax" name="fax" class="form-control" placeholder="fax">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="activity" class="col-md-4 control-label">Lĩnh vực hoạt động</label>
                                <div class="col-md-6">
                                    <textarea name="action_status" id="action_status" cols="46" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-md-4 control-label">HT QLCL:</label>
                                <div class="col-md-6">
                                    <textarea name="code" id="code" cols="46" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="activity" class="col-md-4 control-label">Sản phẩm</label>
                                <div class="col-md-6">
                                    <textarea name="product" id="product" cols="46" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Mật khẩu</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required placeholder="mật khẩu đăng nhập">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Xác nhận </label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="xác nhận">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Đăng ký
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @push('scripts')
    <script type="text/javascript" src="{{ asset('iCheck/icheck.js') }}"></script>
    @endpush
