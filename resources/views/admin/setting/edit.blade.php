@extends('admin.layout.layout')
@section('title', 'Admin-Cập nhật thông tin website')
@section('route', 'Cập nhật giao diện')
@section('setting-menu','actives')
@section('main-content')
<br>
@if(session('message'))
<div class="text-success">{{session('message')}}</div>
@endif
<br>
<div class="account-content">
    <div class="scrollspy-example" data-spy="scroll" data-target="#account-setting-scroll" data-offset="-100">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                <form action="" id="general-info" class="section general-info" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="info">
                        <h6 class="">Cài đặt giao diện</h6>
                        <div class="row">
                            <div class="col-lg-11 mx-auto">
                                <div class="row">
                                    <div class="col-xl-2 col-lg-12 col-md-4">
                                        <div class="upload mt-4 pr-md-4">
                                            <input type="file" name="logo" id="input-file-max-fs logo" class="dropify" data-default-file="" data-max-file-size="2M" />
                                            @error('logo')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                            <br>
                                            <div class="div">
                                                @isset($setting->logo)
                                                <img src="{{asset('storage/' . $setting->logo)}}" width="100px" alt="">
                                                @endisset
                                            </div>
                                            <br>
                                            <a href="#" class="mt-2"><i class="flaticon-cloud-upload mr-1"></i>Logo website</a>
                                        </div>
                                    </div>
                                    <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                        <div class="form">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="fullName">Tên trang web</label>
                                                        <input autocomplete="off" id="name" type="text" value="{{$setting->name}}" name="name" class="form-control mb-4" id="fullName" placeholder="">
                                                        @error('name')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="fullName">Bản quyền</label>
                                                        <input autocomplete="off" value="{{$setting->copy_right}}" id="coppy_right" type="text" name="copy_right" class="form-control mb-4" id="fullName" placeholder="" value="">
                                                        @error('copy_right')
                                                        <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label for="comment">Địa chỉ</label>
                                                    <textarea autocomplete="off" id="address" class="form-control" name="address" rows="8" id="comment">{{$setting->address}}</textarea>
                                                    @error('address')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <div class="row">
                                <div class="col-md-11 mx-auto">
                                    <div class="form-group">
                                        <label for="aboutBio">Giới thiệu</label>
                                        <textarea autocomplete="off" id="intro" class="form-control" name="intro" id="aboutBio" placeholder="" rows="10">{{$setting->intro}}</textarea>
                                        @error('intro')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <center><button type="submit" name="time" class="mt-4 mb-4 btn btn-primary">Cập nhật</button></center>
                    <br><br>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection