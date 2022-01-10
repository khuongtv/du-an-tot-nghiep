@extends('client.layout.layout')
@section('title', 'Đăng nhập')
@section('main-content')
<!-- Titlebar -->
<div id="titlebar" class="gradient">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Đăng nhập</h2>
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{{route('home')}}">Trang chủ</a></li>
                        <li>Đăng nhập</li>
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
                @if(!session('msg') && !session('msg_error'))
                <div class="utf-welcome-text-item">
                    <h3>Chào bạn! Đăng nhập để tiếp tục </h3>
                    <span> Bạn chưa có tài khoản <a href="{{route('signup')}}">Đăng ký!</a></span>
                </div>
                @endif
                @if(session('msg'))
                <div class="utf-welcome-text-item">
                    <h3 style="color: green;"> {{session('msg')}} <i class="icon-feather-check-circle"></i></h3>
                    <span> {{session('span')}} </a></span>
                </div>
                @endif
                @if(session('msg_error'))
                <div class="utf-welcome-text-item">
                    <h3 style="color: red;"> {{session('msg_error')}} <i class="icon-material-outline-highlight-off"></i></h3>
                    <span> {{session('span')}} </a></span>
                    @if(session('html'))
                        <a href="{{route('sendmai.very' , ['id' => session('email')])}}">Gửi lại mail?</a>
                    @endif
                </div>
                @endif
                <form method="post" action="" novalidate id="login-form">
                    @csrf
                    <div class="utf-no-border">
                        <input type="text" class="utf-with-border" autocomplete="off" value="{{ old('email') }}" name="email" id="emailaddress" placeholder="Email của bạn" />
                        @error('email')
                        <span style="color:red">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="utf-no-border">
                        <input type="password" class="utf-with-border" value="{{ old('password') }}" name="password" id="password" placeholder="Mật khẩu" />
                        @error('password')
                        <span style="color:red">{{$message}}</span>
                        @enderror
                        @if(session('msg_err'))
                        <span style="color:red">{{session('msg_err')}}</span>
                        @endif
                    </div>
                    <div class="checkbox margin-top-10">
                        <input type="checkbox" name="remember" id="two-step">
                        <label for="two-step"><span class="checkbox-icon"></span> Nhớ mật khẩu</label>
                    </div>
                    <a href="{{route('forgot_password')}}" style="margin-bottom: 30px;" class="forgot-password">Quên mật khẩu?</a>
                </form>
                <button class="button full-width utf-button-sliding-icon ripple-effect margin-top-10" type="submit" form="login-form">Đăng nhập <i class="icon-feather-chevron-right"></i></button>
            </div>
        </div>
    </div>
</div>

@endsection