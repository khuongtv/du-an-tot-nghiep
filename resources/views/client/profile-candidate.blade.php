@extends('client.layout.layout')
@section('title', 'Trang cá nhân')
@section('main-content')

<!-- Titlebar -->
<div class="single-page-header" data-background-image="{{asset('storage/' . 'images/avatar/bia.jpg')}}" style="margin-bottom: 30px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="utf-single-page-header-inner-aera">
                    <div class="utf-left-side">
                        <div class="utf-header-image"><img src="{{asset('storage/' . $userCandidate->avatar)}}" alt=""></div>
                        <div class="utf-header-details">
                            <ul>
                                <li>{{$userCandidate->location->name}} <img class="flag" src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/21/Flag_of_Vietnam.svg/383px-Flag_of_Vietnam.svg.png" alt="" title="Việt Nam" data-tippy-placement="top"></li>
                            </ul>
                            <h3>{{$userCandidate->name}}</h3>
                            <h4 class="text-muted"><i class="icon-material-outline-business-center"></i>
                                {{$userCandidate->category->name}}
                            </h4>
                            @if(isset($userCandidate->address) && strlen($userCandidate->address) >= 10)
                            <h5><i class="icon-material-outline-location-on"></i> {{$userCandidate->address}}
                            </h5>
                            @endisset
                            @if(isset($userCandidate->phone_number) && strlen($userCandidate->phone_number) >= 10)
                            <h5><i class="icon-line-awesome-mobile-phone"></i> {{$userCandidate->phone_number}}</h5>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-xl-12">
            <div class="utf-account-type tab" style="display: flex; justify-content: center;">
                <div class="">
                    <input type="radio" name='candidate' class="tablinks utf-account-type-radio" id="infor_id" onclick="openTab(event, 'information')"></input>
                    <label for="infor_id" title="Thông tin cơ bản" data-tippy-placement="top" class="utf-ripple-effect-dark"><i class="icon-feather-user-check"></i> <span class="mobile">Cá nhân</span></label>
                </div>

                <div class="">
                    <input type="radio" name='candidate' class="tablinks utf-account-type-radio" id="detail_id" onclick="openTab(event, 'detail')"></input>
                    <label for="detail_id" title="Chi tiết" data-tippy-placement="top" class="utf-ripple-effect-dark"><i class="icon-material-baseline-star-border"></i> <span class="mobile">Thông tin chi tiết</span></label>
                </div>

                <div class="">
                    <input type="radio" name='candidate' class="tablinks utf-account-type-radio" id="cv_id" onclick="openTab(event, 'cv')"></input>
                    <label for="cv_id" title="Hồ sơ" data-tippy-placement="top" class="utf-ripple-effect-dark"><i class="icon-material-outline-description"></i> <span class="mobile">Hồ sơ</span></label>
                </div>

                <div class="">
                    <input type="radio" name='candidate' class="tablinks utf-account-type-radio" id="contact_id" onclick="openTab(event, 'contact')"></input>
                    <label for="contact_id" title="Liên hệ" data-tippy-placement="top" class="utf-ripple-effect-dark"><i class="icon-material-outline-contact-support"></i> <span class="mobile">Liên hệ</span></label>
                </div>
            </div>
        </div>

        <!-- Tab content -->
        <div class="col-xl-12">
            <div id="information" class="tabcontent utf-sidebar-container-aera">
                <div class="utf-sidebar-widget-item">
                    <h3>Thông tin cơ bản</h3>
                    <ul class="utf-job-deatails-content-item">
                        <li><i class="icon-feather-arrow-right"></i>
                            Họ và tên: {{$userCandidate->name}}
                        </li>
                        <li><i class="icon-feather-arrow-right"></i>
                            Giới tính:
                            @foreach(config('common.gender') as $key => $val)
                            @if($key == $userCandidate->gender)
                            {{$val}}
                            @endif
                            @endforeach
                        </li>
                        <li><i class="icon-feather-arrow-right"></i>
                            Ngày sinh:
                            @if(isset($userCandidate->birthday))
                            {{date("d-m-Y", strtotime($userCandidate->birthday))}}
                            @else
                            Không có thông tin!
                            @endif
                        </li>
                        <li><i class="icon-feather-arrow-right"></i>
                            Địa chỉ:
                            @if(isset($userCandidate->address) && strlen($userCandidate->address) >= 10)
                            {{$userCandidate->address}}
                            @else
                            Không có thông tin!
                            @endif
                        </li>
                        <li><i class="icon-feather-arrow-right"></i>
                            Số điện thoại:
                            @if(isset($userCandidate->phone_number) && strlen($userCandidate->phone_number) >= 10)
                            {{$userCandidate->phone_number}}
                            @else
                            Không có thông tin!
                            @endif
                        </li>
                        <h3 class="margin-top-30">Mô tả ngắn</h3>
                        <div>
                            {!!$userCandidate->intro!!}
                        </div>
                    </ul>
                </div>
            </div>

            <div id="detail" class="tabcontent utf-sidebar-container-aera">
                <div class="utf-sidebar-widget-item">
                    <h3>Học vấn</h3>
                    <div class="utf-job-deatails-content-item">
                        @if(isset($userCandidate->education) && strlen($userCandidate->education) >= 1)
                        {!!$userCandidate->education!!}
                        @else
                        Chưa cập nhập đủ thông tin để hiển thị!
                        @endif
                    </div>
                    <br>
                    <h3>Kinh nghiệm làm việc</h3>
                    <div class="utf-job-deatails-content-item">
                        @if(isset($userCandidate->exp) && strlen($userCandidate->exp) >= 1)
                        {!!$userCandidate->exp!!}
                        @else
                        Chưa cập nhập đủ thông tin để hiển thị!
                        @endif
                    </div>
                    <br>
                    <h3>Kỹ năng</h3>
                    <div class="utf-job-deatails-content-item">
                        @if(isset($userCandidate->skill) && strlen($userCandidate->skill) >= 1)
                        {!!$userCandidate->skill!!}
                        @else
                        Chưa cập nhập đủ thông tin để hiển thị!
                        @endif
                    </div>
                    <br>
                    <h3>Khác</h3>
                    <div class="utf-job-deatails-content-item">
                        @if(isset($userCandidate->detail) && strlen($userCandidate->detail) >= 10)
                        {!!$userCandidate->detail!!}
                        @else
                        Chưa cập nhập đủ thông tin để hiển thị!
                        @endif
                    </div>
                </div>
            </div>

            <div id="cv" class="tabcontent utf-sidebar-container-aera">
                <div class="utf-sidebar-widget-item">
                    <h3>Hồ sơ ứng viên</h3>
                    <div class="utf-job-deatails-content-item margin-bottom-20" style="display: flex; justify-content: center;">
                        @isset($userFile)
                        @foreach($userFile as $f)
                        <a style="text-decoration: none; color:#fff" class="list-apply-button ripple-effect margin-top-20 margin-left-5 margin-right-5" href="{{asset('storage/' . $f->file)}}" target="_blank"> {{$f->name}}</a>
                        @endforeach
                        @endisset
                    </div>

                    <!-- Invoice -->
                    <div id="invoice">
                        <div class="row">
                            <div class="col-xl-6">
                                <div id="logo1"><a href="{{route('home')}}"><img src="{{asset('storage/' . 'images/websites/logo.jpg')}}" alt=""></a></div>
                            </div>
                            <div class="col-xl-6">
                                <p id="details">
                                    <strong>MẪU HỒ SƠ #{{$profile->id}}</strong> <br>
                                    <strong>Email:</strong> support.jobs@gmail.com <br>
                                    <strong>Copy right:</strong> jobs.com.vn
                                </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-12">
                                <h2 class="invoice_title">{{$profile->name}}</h2>
                            </div>
                            <div class="col-xl-6">
                                <div class="avatar1"><a href="{{route('candidate', ['id' => $profile->id])}}"><img src="{{asset('storage/' . $profile->avatar)}}" width="200px" height="250px" alt=""></a></div>
                            </div>
                            <div class="col-xl-6 fl_right"> <strong class="margin-bottom-5">Thông tin cơ bản:</strong>
                                <p>
                                    <?php $age = date("Y") - date("Y", strtotime($profile->birthday)) ?>
                                    {{$profile->name}}
                                    @if(isset($age) > 0)
                                    ({{$age}} tuổi)
                                    @endif
                                    <br>
                                    {{$profile->phone_number}}
                                    <br>
                                    {{$profile->user->email}}
                                    <br>
                                    {{$profile->location->name}}
                                    <br>
                                </p>
                            </div>
                            <div class="col-xl-6"> <strong class="margin-bottom-5">Mô tả:</strong>
                                <p>
                                    {!! $profile->intro !!}
                                </p>
                            </div>
                            <div class="col-xl-6 fl_right"> <strong class="margin-bottom-5">Ngày tạo tài khoản:</strong>
                                <p> {{date("d-m-Y", strtotime($profile->created_at))}}
                                </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-12">
                                <h3>Học vấn</h3>
                                <div class="utf-job-deatails-content-item">
                                    @if(isset($userCandidate->education) && strlen($userCandidate->education) >= 1)
                                    {!!$userCandidate->education!!}
                                    @else
                                    Chưa cập nhập đủ thông tin để hiển thị!
                                    @endif
                                </div>
                                <br>
                                <h3>Kinh nghiệm làm việc</h3>
                                <div class="utf-job-deatails-content-item">
                                    @if(isset($userCandidate->exp) && strlen($userCandidate->exp) >= 1)
                                    {!!$userCandidate->exp!!}
                                    @else
                                    Chưa cập nhập đủ thông tin để hiển thị!
                                    @endif
                                </div>
                                <br>
                                <h3>Kỹ năng</h3>
                                <div class="utf-job-deatails-content-item">
                                    @if(isset($userCandidate->skill) && strlen($userCandidate->skill) >= 1)
                                    {!!$userCandidate->skill!!}
                                    @else
                                    Chưa cập nhập đủ thông tin để hiển thị!
                                    @endif
                                </div>
                                <br>
                                <div class="utf-job-deatails-content-item">
                                    @if(isset($userCandidate->detail) && strlen($userCandidate->detail) >= 10)
                                    {!!$userCandidate->detail!!}
                                    @else
                                    Chưa cập nhập đủ thông tin để hiển thị!
                                    @endif
                                </div>
                            </div>
                        </div>

                        <center>
                            <a style="text-decoration: none; color:#fff" class="list-apply-button ripple-effect margin-top-20" href="{{route('profile', ['id' => $profile->id])}}" target="_blank">Toàn màn hình <i class="icon-material-outline-assignment"></i></a>
                        </center>
                    </div>
                </div>
            </div>

            <div id="contact" class="tabcontent utf-sidebar-container-aera">
                <div class="utf-sidebar-widget-item">
                    <h3>Liên kết mạng xã hội</h3>
                    <div class="utf-job-deatails-content-item">
                        <div class="utf-centered-button margin-top-10">
                            @if(strlen($userCandidate->link_facebook) > 10)
                            <a href="{{$userCandidate->link_facebook}}" target="_blank" class="button">Facebook <i class="icon-brand-facebook-f"></i></a>
                            @endif
                            @if(strlen($userCandidate->link_linkedin) > 10)
                            <a href="{{$userCandidate->link_linkedin}}" target="_blank" class="button">Linkedin <i class="icon-feather-linkedin"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('style')
<link rel="stylesheet" href="{{asset('theme/client')}}/css/profile.css">
<style>
    .button,
    .button:hover {
        color: #fff;
        text-decoration: none;
    }

    .button:hover i {
        transition: all 0.2s ease-in-out;
        margin-left: 5px;
    }
</style>
<style>
    .utf-account-type input.utf-account-type-radio:checked~label span {
        color: #fff;
    }

    .utf-account-type input.utf-account-type-radio~label:hover span {
        color: #fff;
    }

    @media screen and (max-width: 767px) {
        .mobile {
            display: none;
        }

        .single-page-header {
            margin-bottom: 24px;
        }
    }
</style>
@endsection

@section('script')
<script>
    function openTab(evt, name) {
        // Declare all variables
        var i, tabcontent, tablinks;

        // Get all elements with class="tabcontent" and hide them
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Get all elements with class="tablinks" and remove the class "active"
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        // Show the current tab, and add an "active" class to the button that opened the tab
        document.getElementById(name).style.display = "block";
        evt.currentTarget.className += " active";
    }
    document.getElementById("infor_id").click();
</script>

<script>
    $("#contact").validate({
        rules: {
            fullname: "required",
            phone: {
                required: true,
                minlength: 9
            },
            email: {
                required: true,
                email: true
            },
            title: "required",
            content: "required"
        },
        messages: {
            fullname: "Vui lòng nhập họ tên",
            phone: {
                required: "Vui lòng nhập số điện thoại",
                minlength: "Nhập tối thiểu 9 ký tự"
            },
            email: {
                required: "Vui lòng nhập email",
                email: "Nhập đúng định dạng email"
            },
            title: "Vui lòng nhập tiêu đề",
            content: "Vui lòng nhập nội dung"
        }
    });
</script>
@endsection