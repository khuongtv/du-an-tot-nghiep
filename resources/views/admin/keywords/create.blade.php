@extends('admin.layout.layout')
@section('title', 'Admin-Thêm mới từ khóa')
@section('route', 'Thêm từ khóa')
@section('keyword-menu','actives')
@section('main-content')

<div class="row layout-top-spacing">

    <div id="basic" class="col-lg-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">

                <div class="row">
                    <div class="col-md-6">
                        <form method="post" action="{{route('keyword.store')}}">
                            @csrf
                            <div class="form-group">
                                <p>Ex <code>Lập trình viên PHP, lập trình viên JAVA...</code></p>
                                <label for="t-text" class="sr-only">Text</label>
                                <input autocomplete="off" id="t-text" type="text" name="keyword" value="{{old('keyword')}}" placeholder="" class="form-control">
                                @error('keyword')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <input type="submit" name="txt" value="Thêm" class="mt-4 btn btn-primary">
                                <a class="mt-4 btn btn-danger" href="{{route('keyword.index')}}">Quay lại</a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection