@extends('admin.layout.layout')
@section('title', 'Admin-Danh sách danh mục')
@section('route', 'Danh mục')
@section('category-menu','actives')
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
    @endif
    @if(session('active'))
    <div class="text-success">{{session('active')}}</div>
    @else(session('unactive'))
    <div class="text-success">{{session('unactive')}}</div>
    @endif
    <div>
        <h6 class="key">Có: <i>{{count($categories)}} danh mục</i></h6>
        <style>
            .key {
                color: #0E2ECE;
            }
        </style>
    </div>
</div>
<div class="row layout-spacing">
    <div class="col-lg-12">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <table id="style-3" class="table style-3  table-hover">
                    <thead>
                        <tr>
                            <th class="checkbox-column text-center"> # </th>
                            <th>Tên danh mục</th>
                            <th>Slug</th>
                            <th class="text-center">Trạng thái</th>
                            <th class="text-center dt-no-sorting">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $key => $item)
                        <tr>
                            <td class="checkbox-column text-center">{{$key+1}} </td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->slug}}</td>
                            <td class="text-center">
                                <?php
                                if ($item->enable == 1) {
                                ?>
                                    <a href="{{route('categories.UnActiveCate' , $item->id)}}">
                                        <span class="shadow-none badge badge-primary"> HIỂN THỊ </span>
                                    </a>
                                <?php
                                } else {
                                ?>
                                    <a href="{{route('categories.ActiveCate' , $item->id)}}" class="">
                                        <span class="shadow-none badge badge-danger"> ẨN </span>
                                    </a>
                                <?php
                                }
                                ?>
                            </td>
                            <td class="text-center">
                                <ul class="table-controls">
                                    <li><a href="{{route('categories.edit',['id'=>$item->id])}}" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1">
                                                <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                            </svg></a></li>
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

@endsection