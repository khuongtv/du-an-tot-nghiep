@extends('client.layout.layout')
@section('title', 'Quản lý CV')
@section('main-content')
    <style>
        .error{
            font-size: 14px;
            color: red;
        }
        #upload-cv-error{
            position: absolute;
            bottom: 74px;
        }
        @media screen and (max-width: 767px){
            #link-cv{
                display: none;
            }


        }
    </style>
<!-- Titlebar -->
<div id="titlebar" class="gradient">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Danh sách CV</h2>
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{{route('home')}}">Trang Chủ</a></li>
                        <li>Hồ sơ</li>
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
                    <span>Bạn hiện có <strong>{{count($cv)}}</strong> CV.</span>
                </div>
            </div>

            <div class="utf-boxed-list-item margin-bottom-20">
                <div class="utf-listings-container-part compact-list-layout margin-top-35">
                    @foreach($cv as $c)
                    <div class="utf-job-listing utf-apply-button-item">
                        <div class="utf-job-listing-details">
                            <a href="{{asset('storage/' . $c->file)}}" target="_blank" class="utf-job-listing-company-logo">
                                <img src="{{asset('storage/' . 'images/images/cv.png')}}" title="CV" data-tippy-placement="top" alt="">
                            </a>
                            <div class="utf-job-listing-description">
                                <h3 class="utf-job-listing-title">
                                    <a href="{{asset('storage/' . $c->file)}}">{{$c->name}}</a>
                                </h3>
                                <div class="utf-job-listing-footer">
                                    <ul>
                                        <li id="link-cv"><i class="icon-feather-link"></i> {{asset('storage/' . $c->file)}}</li>
                                        <li><i class="icon-material-outline-access-time"></i>
                                            {{date("d-m-Y", strtotime($c->created_at))}}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <a onclick="return confirm('Xác nhận xóa CV {{$c->name}} sẽ mất vĩnh viễn ? Các đơn ứng tuyển sử dụng CV này sẽ không còn CV nữa hãy ứng tuyển lại!')" href="{{route('delete_cv', ['id' => $c->id])}}" class="list-apply-button ripple-effect">Xóa <i class="icon-feather-x"></i></a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div>
                <a href="#small-dialog" class="apply-now-button popup-with-zoom-anim margin-top-0">Thêm mới <i class="icon-feather-chevron-right"></i></a>
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
            <li class="modal-title">Thêm mới CV</li>
        </ul>
        <div class="utf-popup-container-part-tabs">
            <div class="utf-popup-tab-content-item" id="tab">
                <form method="post" id="apply-now-form" enctype="multipart/form-data">
                    @csrf
                    <div class="utf-no-border">
                        <input type="text" class="utf-with-border" name="name" id="name" placeholder="Tên hồ sơ" />
                    </div>
                    <div class="uploadButton">
                        <input class="uploadButton-input" type="file" id="upload-cv" name="file" />
                        <label class="uploadButton-button ripple-effect" for="upload-cv">Tải lên hồ sơ</label>
                        <span class="uploadButton-file-name">Hồ sơ hợp lệ (PDF)</span>
                    </div>
                </form>
                <button class="button margin-top-35 full-width utf-button-sliding-icon ripple-effect" type="submit" form="apply-now-form">Thêm mới <i class="icon-feather-plus"></i></button>
            </div>
        </div>
    </div>
</div>
    <script>
        $("#apply-now-form").validate({
            rules: {
                name: "required",
                file: "required"
            },
            messages: {
                name: "Vui lòng nhập họ tên",
                file: "Vui lòng tải lên hồ sơ"
            }
        });
    </script>
@if(session('alert_suc'))
<script>
    alertify.success('<?= session("alert_suc")  ?>');
</script>
@endif

@if(session('alert_err'))
<script>
    alertify.error('<?= session("alert_err")  ?>');
</script>

@endif

@endsection