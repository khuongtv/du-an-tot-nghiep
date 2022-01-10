@extends('admin.layout.layout')
@section('title', 'Admin-Cập nhật từ khóa')
@section('route', 'Cập nhật từ khóa')
@section('keyword-menu','actives')
@section('main-content')

<div class="row layout-top-spacing">

    <div id="basic" class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">

                <div class="row">
                    <div class="col-md-6">
                        <form method="post" action="{{route('keyword.update',['id'=>$key->id])}}" method="post">
                            @csrf
                            <div class=" form-group">
                                <p>Ex <code>Lập trình viên PHP, lập trình viên JAVA...</code></p>
                                <label for="t-text" class="sr-only">Text</label>
                                <input autocomplete="off" id="t-text" type="text" name="keyword" value="{{$key->keyword}}" placeholder="" class="form-control">
                                @error('keyword')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <input type="submit" name="txt" value="Cập nhật" class="mt-4 btn btn-primary">
                            <a class="mt-4 btn btn-danger" href="{{route('keyword.index')}}">Quay lại</a>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection