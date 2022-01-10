@extends('admin.layout.layout')
@section('title', 'Admin-Chi tiết tin tuyển dụng')
@section('route', 'Chi tiết tin tuyển dụng')
@section('blog-menu','actives')
@section('main-content')
<br>
@if(session('unactive'))
<div class="text-success">{{session('unactive')}}</div>
@endif
@if(session('active'))
<div class="text-success">{{session('active')}}</div>
@endif
<br>
<div class="col-lg-12 col-md-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>{{$blogs->title}} - {{isset($blogs->userRecruitment->name) ? $blogs->userRecruitment->name : "[Đã xóa]" }}</h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            <div class="table-responsive">
                <table class="table table-bordered mb-4">
                    <thead>
                        <tr>
                            <th>Mức lương(từ -> đến)</th>
                            <th>Hình thức làm việc</th>
                            <th>Cần tuyển</th>
                            <th>Vị trí</th>
                            <th>Kinh nghiệm</th>
                            <th>Giới tính</th>
                            <th>Địa điểm</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{number_format($blogs->salary_min)}} VND - {{number_format($blogs->salary_max)}} VND</td>
                            <td>{{$blogs->working_time}}</td>
                            <td>{{$blogs->quantity}}</td>
                            <td>{{$blogs->position}}</td>
                            <td>{{$blogs->exp}}</td>
                            <td>
                                @if($blogs->gender == 1) Nam
                                @elseif ($blogs->gender == 2) Nữ
                                @else Tất cả
                                @endif
                            </td>
                            <td>{{isset($blogs->location->name) ? $blogs->location->name : "[Đã xóa]" }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div>
            {!!$blogs->detail!!}
        </div>
        <div class="modal-footer">
            @if($blogs->enable == 0)
            <a href="{{route('blog.activeBlog' , $blogs->id)}}" class="btn btn-success" href="">Duyệt tin này</a>
            @else
            <a class="btn btn-success">Tin đã được duyệt</a>
            @endif
            @if($blogs->enable == 1)
            <a href="{{route('blog.unactiveBlog' , $blogs->id)}}" class="btn btn-danger" href="">Hủy duyệt tin này</a>
            @else
            <p></p>
            @endif
            <a href="{{route('blog.listActive')}}" class="btn btn-info" href="">Quay lại</a>
        </div>
        <style>
            .modal-footer {
                border-top: 0px solid #dee2e6;
            }
        </style>
    </div>
</div>

@endsection