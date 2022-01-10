@extends('admin.layout.layout')
@section('title', 'Admin-Danh sách tài khoản ứng viên')
@section('route', 'Quản lý tài khoản ứng viên')
@section('user-menu', 'actives')
@section('main-content')

<br>
<div>
    {{-- <h6 class="key">Có: <i>{{count($user_candidate)}} tài khoản ứng viên</i></h6>--}}
    <style>
        .key {
            color: #0E2ECE;
        }
    </style>
</div>
<br>
<div class="row layout-spacing">
    <div class="col-lg-12">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <table id="style-3" class="table style-3  table-hover">
                    <thead>
                        <tr>
                            <th class="checkbox-column text-center"> #</th>
                            <th class="text-center">Tên ứng viên</th>
                            <th class="text-center">Hình ảnh</th>
                            <th class="text-center">Địa chỉ</th>
                            <th class="text-center">Ngày sinh</th>
                            <th class="text-center">Số điện thoại</th>
                            <th class="text-center">Trạng thái</th>
                            <th class="text-center">CV</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($user_candidate)
                        @foreach($user_candidate as $key => $item)
                        <tr>
                            <td class="checkbox-column text-center">{{$key+1}} </td>
                            <td class="text-center">{{$item->userCandidate->name}}</td>
                            <td class="text-center">
                                <span>
                                    <img src="{{ asset('storage/' . $item->userCandidate->avatar) }}" width="100px" />
                                </span>
                            </td>
                            <td class="text-center">{{$item->userCandidate->address}}</td>
                            <td class="text-center">
                                {{date('d-m-Y', strtotime($item->userCandidate->birthday))}}
                            </td>
                            <td class="text-center">{{$item->userCandidate->phone_number}}</td>
                            <td class="text-center">
                                @if($item->confirmed == 1)
                                <span class="shadow-none badge badge-success"> Đã xác minh</span>
                                @elseif($item->confirmed == 0)
                                <span class="shadow-none badge badge-warning"> Chưa xác minh</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if(count($item->userFiles) > 0)
                                <a target="_blank" href="{{asset('storage/'.$item->userFiles[0]->file)}}">
                                    <i class="fas fa-file-archive" style="font-size: 22px"></i>
                                </a>
                                @else {{'null'}} @endif
                            </td>
                        </tr>
                        @endforeach
                        @endisset
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection