@extends('admin.layout.layout')
@section('title', 'Admin-Dashboard')
<link href="{{asset('theme/admin')}}/assets/css/dashboard/dash_2.css" rel="stylesheet" type="text/css" />
@section('route', 'Dashboard')
@section('main-content')
<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="margin-top: 29px;">
    <div class="row widget-statistic">
        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-one_hybrid widget-followers">
                <div class="widget-heading">
                    <center>
                    <div class="w-title">
                        <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        </div>
                        <div class="">
                            <p class="w-value">{{$count_candidate}}</p>
                            <h5 class="">Ứng viên đang sử dụng hệ thống</h5>
                        </div>
                    </div>
                    </center>
                </div>
                <div class="widget-content">
                    <!-- <div class="w-chart">
                        <div id="hybrid_followers"></div>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-one_hybrid widget-referral">
                <div class="widget-heading">
                    <center>
                    <div class="w-title">
                        <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-link"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                        </div>
                        <div class="">
                            <p class="w-value">{{$count_recruitment}}</p>
                            <h5 class="">Tài khoản công ty </h5>
                        </div>
                    </div>
                    </center>
                </div>
                {{--<div class="widget-content">--}}
                    {{--<div class="w-chart">--}}
                        {{--<div id="hybrid_followers1"></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-one_hybrid widget-engagement">
                <div class="widget-heading">
                    <center>
                    <div class="w-title">
                        <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>                        </div>
                        <div class="">
                            <p class="w-value">{{$usercanthang}}</p>
                            <h5 class="">Ứng viên đã đăng ký trong tháng này</h5>
                        </div>
                    </div>
                    </center>
                </div>
                {{--<div class="widget-content">--}}
                    {{--<div class="w-chart">--}}
                        {{--<div id="hybrid_followers3"></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-one_hybrid widget-engagement">
                <div class="widget-heading">
                    <center>
                    <div class="w-title">
                        <div class="w-icon" style="background-color: orangered">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-briefcase"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path></svg>                        </div>
                        <div class="">
                            <p class="w-value">{{$userrethang}}</p>
                            <h5 class="">Tài khoản công ty đăng ký trong tháng</h5>
                        </div>
                    </div>
                    </center>
                </div>
                {{--<div class="widget-content">--}}
                {{--<div class="w-chart">--}}
                {{--<div id="hybrid_followers3"></div>--}}
                {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-one_hybrid widget-engagement">
                <div class="widget-heading">
                    <center>
                    <div class="w-title">
                        <div class="w-icon" style="background: green">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>                        </div>
                        <div class="">
                            <p class="w-value">{{$count_admin}}</p>
                            <h5 class="">Quản trị viên</h5>
                        </div>
                    </div>
                    </center>
                </div>
                {{--<div class="widget-content">--}}
                {{--<div class="w-chart">--}}
                {{--<div id="hybrid_followers3"></div>--}}
                {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-one_hybrid widget-engagement">
                <div class="widget-heading">
                    <center>
                    <div class="w-title">
                        <div class="w-icon" style="background-color: rgb(231 81 90 / 0.388);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-minus"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="23" y1="11" x2="17" y2="11"></line></svg>                        </div>
                        <div class="">
                            <p class="w-value">{{$count_nhan_vien}}</p>
                            <h5 class="">Nhân viên quản trị</h5>
                        </div>
                    </div>
                    </center>
                </div>
                {{--<div class="widget-content">--}}
                {{--<div class="w-chart">--}}
                {{--<div id="hybrid_followers3"></div>--}}
                {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-one_hybrid widget-engagement">
                <div class="widget-heading">
                    <center>
                    <div class="w-title">
                        <div class="w-icon" style="background-color: rgb(33 150 243 / 0.388);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                        </div>
                        <div class="">
                            <p class="w-value">{{$blog}}</p>
                            <h5 class="">Tin tuyển dụng đã đăng hôm nay</h5>
                        </div>
                    </div>
                    </center>
                </div>
                {{--<div class="widget-content">--}}
                {{--<div class="w-chart">--}}
                {{--<div id="hybrid_followers3"></div>--}}
                {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-one_hybrid widget-engagement">
                <div class="widget-heading">
                    <center>
                    <div class="w-title">
                        <div class="w-icon" style="background-color: rgb(128 93 202 / 0.388);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                        </div>
                        <div class="">
                            <p class="w-value">{{$blogthang}}</p>
                            <h5 class="">Tin tuyển dụng đã đăng tháng này</h5>
                        </div>

                    </div>
                    </center>
                </div>
                {{--<div class="widget-content">--}}
                {{--<div class="w-chart">--}}
                {{--<div id="hybrid_followers3"></div>--}}
                {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-one_hybrid widget-engagement">
                <div class="widget-heading">
                    <center>
                    <div class="w-title">
                        <div class="w-icon" style="background-color: rgb(226 160 63 / 0.388)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trello"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><rect x="7" y="7" width="3" height="9"></rect><rect x="14" y="7" width="3" height="5"></rect></svg>                        </div>
                        <div class="">
                            <p class="w-value">{{$blog_unactive_thang}}</p>
                            <h5 class="">Tin tuyển dụng đang chờ duyệt</h5>
                        </div>
                    </div>
                    </center>
                </div>
                {{--<div class="widget-content">--}}
                {{--<div class="w-chart">--}}
                {{--<div id="hybrid_followers3"></div>--}}
                {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
</div>
<script src="{{asset('theme/admin')}}/plugins/apex/apexcharts.min.js"></script>
<script src="{{asset('theme/admin')}}/assets/js/dashboard/dash_2.js"></script>
@endsection