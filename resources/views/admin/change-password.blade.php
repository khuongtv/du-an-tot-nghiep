<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from designreset.com/cork/ltr/demo3/auth_register_boxed.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 18 Jul 2021 14:04:49 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title> Đổi mật khẩu - JobS </title>
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

                        <h1 class="">Đổi mật khẩu</h1>
                        <p class="signup-link register"> Quay lại trang <a href="{{route('dashboard')}}">Dashboard</a></p>
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
                        @if(session('msg_err'))
                        <div class="alert alert-light-danger border-0 mb-4" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </button>
                            {{session('msg_err')}}
                        </div>
                        @endif
                        <form class="text-left" method="POST">
                            @csrf
                            <div class="form">

                                <div id="username-field" class="field-wrapper input">
                                    <label for="password">MẬT KHẨU CŨ</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                    <input id="password" autocomplete="off" name="password" type="password" class="form-control" placeholder="Nhập mật khẩu cũ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                    @error('password')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div id="email-field" class="field-wrapper input">
                                    <label for="passNew">MẬT KHẨU MỚI</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                    <input id="passNew" autocomplete="off" name="passNew" type="password" value="" class="form-control" placeholder="Nhập mật khẩu mới">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password1" class="feather feather-eye">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                    @error('passNew')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    <script>
                                        var togglePassword = document.getElementById("toggle-password1");
                                        if (togglePassword) {
                                            togglePassword.addEventListener('click', function() {
                                                var x = document.getElementById("passNew");
                                                if (x.type === "password") {
                                                    x.type = "text";
                                                } else {
                                                    x.type = "password";
                                                }
                                            });
                                        }
                                    </script>
                                </div>

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <div class="d-flex justify-content-between">
                                        <label for="confirm_password">XÁC NHẬN MẬT KHẨU</label>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>
                                    <input id="confirm_password" autocomplete="off" name="confirm_password" type="password" class="form-control" placeholder="Nhập lại mật khẩu">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password2" class="feather feather-eye">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                    @error('confirm_password')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    <script>
                                        var togglePassword = document.getElementById("toggle-password2");
                                        if (togglePassword) {
                                            togglePassword.addEventListener('click', function() {
                                                var x = document.getElementById("confirm_password");
                                                if (x.type === "password") {
                                                    x.type = "text";
                                                } else {
                                                    x.type = "password";
                                                }
                                            });
                                        }
                                    </script>
                                    @if(session('msg_passNewfals'))
                                    <span class="text-danger">{{session('msg_passNewfals')}}</span>
                                    @endif
                                </div>

                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-primary" value="">Đổi mật khẩu</button>
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
        $('.text-left').validate({
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

</body>

<!-- Mirrored from designreset.com/cork/ltr/demo3/auth_register_boxed.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 18 Jul 2021 14:04:49 GMT -->

</html>