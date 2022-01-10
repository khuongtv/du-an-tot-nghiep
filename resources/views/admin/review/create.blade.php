@extends('admin.layout.layout')
@section('title', 'Admin-Thêm mới đánh giá')
@section('route', 'Thêm mới đánh giá')
@section('review-menu','actives')
@section('main-content')

<br>
<div class="col-lg-12 col-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-content widget-content-area">
            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label for="exampleFormControlInput2">Tên</label>
                        <input autocomplete="off" id="name" type="text" name="name" value="{{old('name')}}" class="form-control" id="" placeholder="">
                        @error('name')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="exampleFormControlInput2">Công việc</label>
                        <input autocomplete="off" type="text" name="work" value="{{old('work')}}" class="form-control" id="" placeholder="">
                        @error('work')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-8">
                        <label for="exampleFormControlInput2">Nội dung</label>
                        <textarea class="form-control" name="content" id="" rows="5">{{old('content')}}</textarea>
                        @error('content')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="exampleFormControlFile1">Ảnh đại diện</label>
                        <input autocomplete="off" type="file" class="form-control-file" name="avatar" id="exampleFormControlFile1">
                        @error('avatar')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div><br>
                <input type="submit" name="txt" value="Thêm mới" class="mt-4 btn btn-primary">
                <a class="mt-4 btn btn-danger" href="{{route('review.index')}}">Quay lại</a>
            </form>
        </div>
    </div>
</div>

@endsection