@extends('admin.layout.layout')
@section('title', 'Admin-Danh sách tỉnh thành')
@section('route', 'Tỉnh thành phố')
@section('location-menu','actives')
@section('main-content')

<br>
<div>
    <h6 class="key">Có: <i>{{count($locations)}} tỉnh</i></h6>
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
                            <th class="checkbox-column text-center"> # </th>
                            <th>Tỉnh/Thành phố</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($locations as $key => $item)
                        <tr>
                            <td class="checkbox-column text-center"> {{$key+1}} </td>
                            <td>{{$item->name}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection