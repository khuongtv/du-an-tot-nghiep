@extends('client.layout.layout')
@section('title', 'Đơn ứng tuyển')
@section('main-content')
<!-- Titlebar -->
<div id="titlebar" class="gradient">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Danh sách công việc đã ứng tuyển</h2>
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{{route('home')}}">Trang Chủ</a></li>
                        <li>Công việc đã ứng tuyển</li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- Titlebar End -->

<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-xl-8 col-lg-9">
            <div class="utf-notify-box-aera apply">
                <div class="utf-switch-container-item">
                    <span>Bạn đã ứng tuyển <strong>{{count($apply)}}</strong> công việc.</span>
                </div>
            </div>

            <div class="utf-boxed-list-item margin-bottom-20">
                <div class="utf-listings-container-part compact-list-layout margin-top-35">
                    @foreach($apply as $a)
                    <div class="utf-job-listing utf-apply-button-item">
                        <div class="utf-job-listing-details">
                            <a href="{{route('company', ['slug' => $a->company_slug])}}" class="utf-job-listing-company-logo">
                                <img src="{{asset('storage/' . $a->company_logo)}}" title="{{$a->company_name}}" data-tippy-placement="top" alt="">
                            </a>
                            <div class="utf-job-listing-description">
                                @foreach(config('common.apply_status') as $key => $val)
                                @if($a->status == $key)
                                <span class="dashboard-status-button utf-job-status-item @if($key > 5) red @else green @endif"><i class="icon-material-baseline-notifications-none"></i> {{$val}}</span>
                                @endif
                                @endforeach
                                <h3 class="utf-job-listing-title">
                                    <a href="{{route('job', ['slug' => $a->blog_slug])}}">{{$a->blog_title}}</a>
                                    @if($a->company_verification)
                                    <span class="utf-verified-badge" title="Đã xác minh!" data-tippy-placement="top"></span>
                                    @endif
                                </h3>
                                <div class="utf-job-listing-footer">
                                    <ul>
                                        <li><i class="icon-feather-briefcase"></i> {{$a->blog_position}}</li>
                                        <li><i class="icon-material-outline-access-time"></i>
                                            {{date("d-m-Y", strtotime($a->created_at))}}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <a href="#small-dialog" onclick="getDetail(<?= $a->id ?>)" class="apply-now-button popup-with-zoom-anim list-apply-button ripple-effect">Thông báo <i class="icon-line-awesome-bullhorn"></i></a>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="utf-centered-button margin-top-10">
                    <a href="?view=tat-ca" class="button utf-ripple-effect-dark utf-button-sliding-icon margin-top-20">Xem thêm <i class="icon-feather-chevron-right"></i></a>
                </div>
            </div>
        </div>

        @if(isset($ads))
        <div class="col-xl-4 col-lg-3">
            <div class="utf-sidebar-container-aera">
                <a target="_blank" href="{{$ads->link}}"><img style="border-radius: 3px;" width="100%" src="{{asset('storage/' . $ads->image)}}" alt="{{$ads->alt}}" /></a>
            </div>
        </div>
        @endif
    </div>
</div>

<div id="small-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs">
    <div class="utf-signin-form-part">
        <ul class="utf-popup-tabs-nav-item">
            <li class="modal-title">Chi tiết đơn ứng tuyển</li>
        </ul>
        <div class="utf-popup-container-part-tabs">
            <div class="utf-popup-tab-content-item" id="tab" style="padding:30px 20px;">

            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    $('html, body').animate({
        scrollTop: $(".apply").offset().top
    }, 500);

    function getDetail(id) {
        $.ajax({
            url: '/api/chi-tiet-ung-tuyen/' + id,
            type: 'POST',
            data: {
                id: id
            },
            success: function(data) {
                console.log(data);
                $('#tab').html(data);
            }
        });
    }
</script>
@endsection

@section('style')
<style>
    .time_ago {
        position: absolute;
        right: 5px;
        bottom: 5px;
        font-size: 0.7rem;
    }
    @media screen and (max-width: 767px){
        #pc{
            display: inline-block;
            display: none !important;
        }
        #mobile{
            display: block !important;
        }


    }
</style>
@endsection