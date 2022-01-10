@extends('admin.layout.layout')
@section('title', 'Quản lý tin tuyển dụng')
@section('route', 'Admin-Tin tuyển dụng chưa duyệt')
@section('blog-menu','actives')
@section('main-content')
<br>
<div>
    @if(session('alert'))
    <div class="text-success">{{session('alert')}}</div>
    @endif
    @if(session('message'))
    <div class="text-success">{{session('message')}}</div>
    @endif
    @if(session('success'))
    <div class="text-success">{{session('success')}}</div>
    @else(session('active'))
    <div class="text-success">{{session('active')}}</div>
    @endif
    <div>
        <h6 class="key">Có: <i>{{count($blogs)}} tin chưa duyệt</i></h6>
        <style>
            .key {
                color: #0E2ECE;
            }
        </style>
    </div>
</div>
<br>
<div class="row layout-spacing">
    <div class="col-lg-12">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <table id="style-3" class="table style-3  table-hover">
                    <thead>
                        <tr>
                            <th class="checkbox-column text-center"> # </th>
                            <th class="text-center">Tiêu đề</th>
                            <th>Công ty</th>
                            <th>Ngày tạo</th>
                            <th>Trạng thái</th>
                            <th class="text-center dt-no-sorting">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($blogs as $key => $item)
                        <tr>
                            <td class="checkbox-column text-center"> {{$key+1}} </td>
                            <td>
                                {{$item->title}}
                            </td>
                            <td>{{$item->userRecruitment->name }}</td>
                            <td>{{date('d-m-Y', strtotime($item->created_at))}}</td>
                            <td>
                                @if($item->enable == 1)
                                <span class="shadow-none badge badge-primary"> Đã duyệt</span>
                                @else
                                <span class="shadow-none badge badge-danger"> Chưa duyệt</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <ul class="table-controls">
                                    <li>
                                        <a href="{{route('blog.show', ['id'=>$item->id])}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('blog.delete',['id'=>$item->id])}}" onclick="return confirm('Xóa?')" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-6 mb-1">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            </svg>
                                        </a>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<style>
    .text {
        margin-left: 400px;
    }
</style>
@endsection