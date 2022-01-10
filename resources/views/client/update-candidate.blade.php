@extends('client.layout.layout')
@section('title', 'JobS - Sửa thông tin cá nhân')
@section('main-content')

<!-- Titlebar -->
<div id="titlebar" style="margin-bottom: 10px;" class="gradient">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Sửa thông tin cá nhân</h2>
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{{route('home')}}">Trang chủ</a></li>
                        <li><a href="#">Sửa thông tin cá nhân</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- Titlebar End -->

<div class="utf-dashboard-content-inner-aera">
    <form action="" method="post" novalidate enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xl-6">
                <div class="dashboard-box margin-top-0 margin-bottom-30">
                    <div class="headline">
                        <h3>Thông tin của bạn</h3>
                    </div>

                    <div class="content with-padding padding-bottom-0">
                        <div class="row">
                            <div class="col">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="row">
                                            <div class="col-xl-5 col-md-3 col-sm-4">
                                                <div class="utf-avatar-wrapper" data-tippy-placement="top" title="Change Profile Picture">
                                                    <img class="profile-pic" src="{{asset('storage/'. $user->avatar)}}" style="height: 216px; object-fit: contain;" alt="" />
                                                    <div class="upload-button"></div>
                                                    <input class="file-upload" type="file" name="avatar" accept="image/*" />
                                                </div>
                                            </div>
                                            <div class="col-xl-7 col-md-9 col-sm-8">
                                                <div class="utf-submit-field">

                                                    <div class="utf-account-type">
                                                        <div class="utf-submit-field">
                                                            <h5>Họ & Tên</h5>
                                                            <input type="text" class="utf-with-border" name="name" value="{{$user->name}}" required>
                                                        </div>
                                                        <div class="utf-submit-field">
                                                            <h5>Số điện thoại</h5>
                                                            <input type="text" class="utf-with-border" name="phone_number" value="{{$user->phone_number}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-md-6 col-sm-6">
                                        <div class="utf-submit-field">
                                            <h5>Địa chỉ</h5>
                                            <input type="text" class="utf-with-border" name="address" value="{{$user->address}}">
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-md-6 col-sm-6">
                                        <div class="utf-submit-field">
                                            <h5>Vị trí công việc</h5>
                                            <div class="utf-intro-search-field-item">
                                                <select name="cate_id" class="selectpicker default" data-live-search="true" data-selected-text-format="count" data-size="5" title="Chọn vị trí công việc">
                                                    @foreach($cate as $c)
                                                    <option value="{{$c->id}}" {{($user->cate_id == $c->id) ? 'selected' : ''}}>{{$c->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-md-6 col-sm-6">
                                        <div class="utf-submit-field">
                                            <h5>Địa điểm làm việc</h5>
                                            <div class="utf-intro-search-field-item">
                                                <select name="location_id" class="selectpicker default" data-live-search="true" data-selected-text-format="count" data-size="5" title="Chọn địa điểm">
                                                    @foreach($location as $l)
                                                    <option value="{{$l->id}}" {{($user->location_id == $l->id) ? 'selected' : ''}}>{{$l->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-md-6 col-sm-6">
                                        <div class="utf-submit-field">
                                            <h5>Ngày sinh</h5>
                                            <input type="date" class="utf-with-border" name="birthday" value="{{$user->birthday}}">
                                        </div>
                                    </div>
                                    <div class="col-xl-12 col-md-6 col-sm-6">
                                        <div class="utf-submit-field" style="display: flex;">
                                            <h5>Giới tính: </h5>
                                            <input type="radio" class="gender" value="1" name="gender" {{($user->gender == 1) ? 'checked' : '' }}> <span>Nam</span>
                                            <input type="radio" class="gender" value="2" name="gender" {{($user->gender == 2) ? 'checked' : '' }}> <span>Nữ</span>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-sm-6">
                                        <div class="utf-submit-field">
                                            <h5><i class="icon-brand-facebook"></i> Facebook</h5>
                                            <input type="text" class="utf-with-border" name="link_facebook" value="{{$user->link_facebook}}">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-sm-6">
                                        <div class="utf-submit-field">
                                            <h5><i class="icon-brand-linkedin"></i> Linkedin</h5>
                                            <input type="text" class="utf-with-border" name="link_linkedin" value="{{$user->link_linkedin}}">
                                        </div>
                                    </div>

                                    <div class="col-xl-12 col-md-12 col-sm-12">
                                        <div class="utf-submit-field">
                                            <h5>Giới thiệu bản thân</h5>
                                            <textarea name="intro" class="utf-with-border" cols="20" rows="6">{{$user->intro}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xl-6">
                <div id="test1" class="dashboard-box margin-top-0">
                    <div class="headline">
                        <h3>Thông tin chi tiết</h3>
                    </div>
                    <div class="content with-padding">
                        <div class="row">
                            <div class="col-xl-12 col-md-6 col-sm-6">
                                <div class="utf-submit-field">
                                    <h5>Học vấn</h5>
                                    <textarea name="education">{{$user->education}}</textarea>
                                </div>
                            </div>
                            <div class="col-xl-12 col-md-6 col-sm-6">
                                <div class="utf-submit-field">
                                    <h5>Kinh nghiệm làm việc</h5>
                                    <textarea name="exp">{{$user->exp}}</textarea>
                                </div>
                            </div>
                            <div class="col-xl-12 col-md-6 col-sm-6">
                                <div class="utf-submit-field">
                                    <h5>Kỹ năng</h5>
                                    <textarea name="skill">{{$user->skill}}</textarea>
                                </div>
                            </div>
                            <div class="col-xl-12 col-md-6 col-sm-6">
                                <div class="utf-submit-field">
                                    <h5>Khác</h5>
                                    <textarea name="detail">{{$user->detail}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button style="margin: 0 auto;" class="button ripple-effect big margin-top-10 margin-bottom-20">Cập nhật</button>
        </div>
    </form>
</div>

<!-- Dashboard Content / End -->
@if(session('msg_update_candidate'))
<div class="msg_favorite">
    <script>
        alertify.success('Cập nhật thông tin thành công');
    </script>
</div>
@endif
@endsection

@section('style')
<link href="{{asset('theme/client')}}/css/pe-icon-7-stroke.css" rel="stylesheet" />
<link href="{{asset('theme/client')}}/css/demo.css" rel="stylesheet" />
<script type="text/javascript" src="{{asset('theme/client')}}/ckeditor/ckeditor.js"></script>

<style>
    .gender {
        margin: 5px 10px 5px 20px;
    }

    .utf-footer-section-item-block {
        padding: 50px 0 60px;
    }
</style>
@endsection

@section('script')
<script>
    CKEDITOR.replace('intro');
    CKEDITOR.replace('education');
    CKEDITOR.replace('exp');
    CKEDITOR.replace('skill');
    CKEDITOR.replace('detail');
</script>
@endsection