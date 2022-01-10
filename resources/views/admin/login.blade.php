<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from designreset.com/cork/ltr/demo3/auth_login_boxed.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 18 Jul 2021 14:04:49 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Đăng nhập - JobS</title>
    <link rel="icon" type="image/x-icon" href="{{asset('theme/client')}}/images/icon.png" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{asset('theme/admin')}}/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('theme/admin')}}/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('theme/admin')}}/assets/css/authentication/form-2.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="{{asset('theme/admin')}}/assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="{{asset('theme/admin')}}/assets/css/forms/switches.css">

    <link rel="stylesheet" type="text/css" href="{{asset('theme/admin')}}/assets/css/elements/alert.css">

    <style>
        .error {
            color: red !important;
        }

        .text-danger {
            font-size: 10px !important;
        }
    </style>


</head>

<body class="form">


    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">

                        <h1 class="">Đăng nhập</h1>
                        <p class="">Đăng nhập vào tài khoản của bạn để tiếp tục.</p>

                        <form class="text-left" id="text-left" method="POST" novalidate>
                            @csrf
                            <div class="form">
                                <div id="username-field" class="field-wrapper input">
                                    <label for="username">EMAIL</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                    <input id="username" name="email" type="text" class="form-control" autocomplete="off" placeholder="Nhập email của bạn">
                                    @error('email')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <div class="d-flex justify-content-between">
                                        <label for="password">MẬT KHẨU</label>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                    <input id="password" name="password" type="password" class="form-control" placeholder="Nhập mật khẩu">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                    @error('password')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                    <a href="{{route('admin_forgot_password')}}" class="forgot-pass-link mt-3">Quên mật khẩu?</a>
                                </div>
                                @if(session('msg_loginAdmin'))
                                <div class="alert alert-light-danger border-0" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                        </svg>
                                    </button> {{session('msg_loginAdmin')}}
                                </div>
                                @endif
                                @if(session('msg'))
                                <div class="alert alert-light-success border-0 mb-4" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert">
                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                        </svg>
                                    </button>
                                    {{session('msg')}}
                                </div>
                                @endif
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-primary" value="">Đăng nhập</button>
                                    </div>
                                </div>

                                <p class="signup-link">© 2021 Đồ án tốt nghiệp nhóm 181 Fpoly. <a href="javascript:void(0);">JobS</a></p>

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{asset('theme/admin')}}/assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="{{asset('theme/admin')}}/bootstrap/js/popper.min.js"></script>
    <script src="{{asset('theme/admin')}}/bootstrap/js/bootstrap.min.js"></script>

    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="{{asset('theme/admin')}}/assets/js/authentication/form-2.js"></script>

    <!--Validate jquery-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

    <script>
        $('#text-left').validate({
            rules: {
                email: "required",
                password: "required"
            },
            messages: {
                email: "Vui lòng để trống email",
                password: "Vui lòng để trống mật khẩu"
            }
        })
    </script>

</body>

<!-- Mirrored from designreset.com/cork/ltr/demo3/auth_login_boxed.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 18 Jul 2021 14:04:49 GMT -->

</html>