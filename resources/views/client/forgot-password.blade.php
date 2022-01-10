@extends('client.layout.layout')
@section('title', 'JobS - Quên mật khẩu')
@section('main-content')

<!-- Titlebar -->
<div id="titlebar" class="gradient">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Quên mật khẩu</h2>
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{{route('home')}}">Trang chủ</a></li>
                        <li>Quên mật khẩu</li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-xl-6 offset-xl-3">
            <div class="utf-login-register-page-aera margin-bottom-50">
                @if(!session('email') && session('msg-err') != 'Tài khoản của bạn chưa được xác thực')
                <div class="utf-welcome-text-item">
                    <h3>Bạn đã quên mật khẩu?</h3>
                    <span>Hãy nhập địa chỉ email của bạn chúng tôi sẽ gửi mã code bao gồm 6 ký tự về email của bạn</span>
                </div>
                @endif
                @if(session('msg'))
                <div class="utf-welcome-text-item">
                    <h3 style="color: green;">{{session('msg')}} <i class="icon-feather-check-circle"></i></h3>
                    <span> {{session('span')}} </span>
                </div>
                @endif
                @if(session('msg-err'))
                <div class="utf-welcome-text-item">
                    <h3 style="color: red;">{{session('msg-err')}} <i class="icon-material-outline-highlight-off"></i> </h3>
                    <span> {{session('span')}} </span>
                </div>
                @endif

                <form method="post" id="login-form">
                    @csrf
                    <div class="utf-no-border">
                        <input type="text" class="utf-with-border" @if(session('email')) value="{{session('email')}}" @endif name="email" id="emailaddress" placeholder="Địa chỉ email của bạn" />
                        @if(session('msg_errEmail'))
                        <span style="color: red; font-size: 14px">{{session('msg_errEmail')}}</span>
                        @endif
                        @error('email')
                        <span style="color: red; font-size: 14px">{{$message}}</span>
                        @enderror
                    </div>
                    @if(session('msg') == 'Đã gửi mã xác nhận tới Email!' || session('msg-err') == 'Mã xác nhận không chính xác!')
                    <div class="utf-no-border">
                        <input type="text" class="utf-with-border" name="code" id="code" placeholder="Nhập mã xác nhận" />
                        @error('code')
                        <span style="color: red; font-size: 14px">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="utf-no-border">
                        <input type="text" class="utf-with-border" name="password" id="password" placeholder="Nhập mật khẩu mới" />
                        @error('password')
                        <span style="color: red; font-size: 14px">{{$message}}</span>
                        @enderror
                    </div>
                    @endif
                    @if(!session('email') || session('msg-err') == 'Mã xác nhân hết hạn, nhập lại email để lấy mã')
                    <button class="button full-width utf-button-sliding-icon ripple-effect margin-top-10" type="submit" form="login-form"> Lấy mã <i class="icon-feather-chevron-right"></i></button>
                    @else
                    <button class="button full-width utf-button-sliding-icon ripple-effect margin-top-10" type="submit" form="login-form"> Đổi mật khẩu <i class="icon-feather-chevron-right"></i></button>
                    @endif
                </form>
                <div class="forget-text margin-top-15">
                    <span>Quay lại trang, <a href="{{route('login')}}"> Đăng nhập</a></span>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('style')
<style>
    .error {
        color: red;
        font-size: 14px;
    }
</style>
@section('script')
<script>
    $("#login-form").validate({
        rules: {
            email: "required",
            code: {
                required: true,
                minlength: 6
            },
            password: {
                required: true,
                minlength: 6
            },
        },
        messages: {
            email: "Không để trống email",
            code: {
                required: "Không để trống mã xác nhân",
                minlength: "Mã xác nhân tối thiểu 6 ký tự"
            },
            password: {
                required: "Không để trống mật khẩu",
                minlength: "Mật khẩu tối thiểu 6 ký tự"
            },
        }
    });
</script>
@endsection