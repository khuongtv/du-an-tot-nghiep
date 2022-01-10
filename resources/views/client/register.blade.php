@extends('client.layout.layout')
@section('title', 'Đăng ký-JobsS')
@section('main-content')

<!-- Titlebar -->
<div id="titlebar" class="gradient">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Đăng ký tài khoản</h2>
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{{route('home')}}">Trang chủ</a></li>
                        <li>Đăng ký</li>
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
                    <h3>Tạo mới tài khoản của bạn</h3>
                    <span> Bạn đã có tài khoản <a href="{{route('login')}}"> Đăng nhập!</a></span>
                </div>
                <form method="post" action="" id="utf-register-account-form">
                    @csrf
                    <div class="utf-account-type">
                        <div>
                            <input type="radio" name="role" value="0" id="freelancer-radio" class="utf-account-type-radio" checked />
                            <label for="freelancer-radio" title="Ứng viên" data-tippy-placement="top" class="utf-ripple-effect-dark"><i class="icon-material-outline-business-center"></i> Ứng viên</label>
                        </div>
                        <div>
                            <input type="radio" name="role" value="50" id="employer-radio" class="utf-account-type-radio" />
                            <label for="employer-radio" title="Nhà tuyển dụng" data-tippy-placement="top" class="utf-ripple-effect-dark desktop"><i class="icon-material-outline-account-circle"></i> Nhà tuyển dụng</label>
                            <label for="employer-radio" title="Nhà tuyển dụng" data-tippy-placement="top" class="utf-ripple-effect-dark tab-mobile"><i class="icon-material-outline-account-circle"></i> NTD</label>
                        </div>
                    </div>
                    <div class="utf-no-border">
                        <input type="text" class="utf-with-border" name="email" id="emailaddress-register" value="{{old('email')}}" placeholder="Địa chỉ email" />
                        @error('email')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="utf-no-border">
                        <input type="password" class="utf-with-border" name="password" id="password" placeholder="Mật khẩu" />
                        @error('password')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="utf-no-border">
                        <input type="password" class="utf-with-border" name="password_confirmation" id="password-repeat-register" placeholder="Nhập lại mật khẩu" />
                    </div>
                    <!-- <div class="checkbox margin-top-10">
                                <input type="checkbox" id="two-step0">
                                <label for="two-step0"><span class="checkbox-icon"></span> I Have Read and Agree to the <a
                    href="#">Terms &amp; Conditions</a></label>
                            </div> -->
                    <button class="button full-width utf-button-sliding-icon ripple-effect margin-top-10" type="submit"> Tạo tài khoản <i class="icon-feather-chevron-right"></i></button>
                </form>
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
    .tab-mobile{
        display: none;
    }
    @media screen and (max-width: 767px) {
        .tab-mobile {
            display: block;
        }

        .desktop {
            display: none;
        }
    }

</style>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script>
    $('#utf-register-account-form').validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 6
            },
            password_confirmation: {
                required: true,
                equalTo: "#password",
            }
        },
        messages: {
            email: {
                required: "Vui lòng không để trống email",
                email: "Nhập đúng định dạng email"
            },
            password: {
                required: "Vui lòng không để trống mật khẩu",
                minlength: "Mật khẩu phải có ít nhất 6 ký tự",
            },
            password_confirmation: {
                required: "Vui lòng xác nhận mật khẩu",
                equalTo: "Mật khẩu không khớp"
            }
        }
    })
</script>
@endsection