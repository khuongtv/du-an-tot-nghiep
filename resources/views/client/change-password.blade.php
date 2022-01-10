@extends('client.layout.layout')
@section('title', 'Đổi mật khẩu - JobS')
@section('main-content')

<!-- Titlebar -->
<div id="titlebar" class="gradient">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Đổi mật khẩu</h2>
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{{route('home')}}">Trang chủ</a></li>
                        <li>Đổi mật khẩu</li>
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
                <div class="utf-welcome-text-item">
                    <h3>Đổi mật khẩu của bạn</h3>
                </div>
                <form method="post" action="" id="login-form">
                    @csrf
                    <div class="utf-no-border">
                        <input type="text" class="utf-with-border" value="{{Auth::user()->email}}" name="email" disabled placeholder="Nhập Email" />
                        @if(session('msg_falseemail'))
                        <span class="text-danger">{{session('msg_falseemail')}}</span>
                        @endif
                    </div>
                    <div class="utf-no-border">
                        <input type="password" class="utf-with-border" name="password" placeholder="Nhập mật khẩu cũ" />
                        @if(session('msg_chagepass'))
                        <span class="text-danger">{{session('msg_chagepass')}}</span>
                        @endif
                    </div>
                    <div class="utf-no-border">
                        <input type="password" class="utf-with-border" name="passNew" id="passNew" placeholder="Nhập mật khẩu mới " />
                    </div>
                    <div class="utf-no-border">
                        <input type="password" class="utf-with-border" name="confirm_password" placeholder="Xác nhận mật khẩu mới" />
                        @if(session('msg_passNewfals'))
                        <span class="text-danger">{{session('msg_passNewfals')}}</span>
                        @endif
                    </div>
                    @if(session('msg_success_chagepass'))
                    <script>
                        alertify.success('Đổi mật khẩu thành công');
                    </script>
                    @endif
                </form>
                <button class="button full-width utf-button-sliding-icon ripple-effect margin-top-10" type="submit" form="login-form"> Xác nhận <i class="icon-feather-chevron-right"></i></button>
                <!-- <div class="forget-text margin-top-15">
                    <span>Quay lại trang, <a href="{{route('login')}}"> Đăng nhập</a></span>
                </div> -->
            </div>
        </div>
    </div>
</div>

@endsection

@section('style')
<style>
    .text-danger,
    .error {
        color: red;
        font-size: 14px;
    }
</style>
@endsection

@section('script')
<script>
    $('#login-form').validate({
        rules: {
            password: "required",
            passNew: {
                required: true,
                minlength: 6
            },
            confirm_password: {
                required: true,
                equalTo: "#passNew"
            }
        },
        messages: {
            password: "Không để trống mật khẩu cũ",
            passNew: {
                required: "Không để trống mật khẩu",
                minlength: "Mật khẩu tối thiểu 6 ký tự"
            },
            confirm_password: {
                required: "Vui lòng xác nhận mật khẩu",
                equalTo: "Mật khẩu không khớp"
            }
        }
    })
</script>
@endsection