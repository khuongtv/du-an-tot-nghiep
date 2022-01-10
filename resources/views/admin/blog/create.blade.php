@extends('admin.layout.layout')
@section('title', 'Tin tuyển dụng')
@section('route', 'Thêm mới tin tuyển dụng')
@section('blog-menu','actives')
@section('main-content')

<br>
<div class="col-lg-12 col-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-content widget-content-area">
            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label for="exampleFormControlInput2">Tiêu đề</label>
                        <input autocomplete="off" id="name" type="text" name="title" value="{{old('title')}}" class="form-control" id="" placeholder="">
                        @error('title')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="exampleFormControlInput2">Người đăng</label>
                        <input autocomplete="off" type="text" name="user_recruitment_id" value="{{old('user_recruitment_id')}}" class="form-control" id="" placeholder="">
                        @error('user_recruitment_id')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="exampleFormControlInput2">Đường dẫn</label>
                        <input autocomplete="off" id="slug" type="text" name="slug" value="{{old('slug')}}" class="form-control" id="" placeholder="">
                        @error('slug')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="exampleFormControlFile1">Hình ảnh</label>
                        <input autocomplete="off" type="file" class="form-control-file" name="image" id="exampleFormControlFile1">
                        @error('image')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="exampleFormControlInput2">Hạn đến ngày</label>
                        <input autocomplete="off" type="date" name="deadline" value="{{old('deadline')}}" class="form-control" id="" placeholder="">
                        @error('deadline')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleFormControlSelect1">Hình thức làm việc</label>
                        <select name="working_time" class="form-control" id="">
                            <option value="2">Full time</option>
                            <option value="1">Part time</option>
                        </select>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="exampleFormControlInput2">Mức lương nhỏ nhất</label>
                        <input autocomplete="off" type="text" name="salary_min" value="{{old('salary_min')}}" class="form-control" id="" placeholder="">
                        @error('salary_min')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="exampleFormControlInput2">Mức lương lớn nhất</label>
                        <input autocomplete="off" type="text" name="salary_max" value="{{old('salary_max')}}" class="form-control" id="" placeholder="">
                        @error('salary_max')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="exampleFormControlInput2">Số lượng</label>
                        <input autocomplete="off" type="text" name="quantity" value="{{old('quantity')}}" class="form-control" id="" placeholder="">
                        @error('quantity')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="exampleFormControlInput2">Vị trí</label>
                        <input autocomplete="off" type="text" name="position" value="{{old('position')}}" class="form-control" id="" placeholder="">
                        @error('position')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="exampleFormControlInput2">Kinh nghiệm</label>
                        <input autocomplete="off" type="text" name="exp" value="{{old('exp')}}" class="form-control" id="" placeholder="">
                        @error('exp')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- <div class="col-md-6">
                        <label for="exampleFormControlInput2">Giới tính</label>
                        <input autocomplete="off" type="text" name="gender" value="{{old('gender')}}" class="form-control" id="" placeholder="">
                        @error('gender')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div> -->
                    <div class="form-group col-md-6">
                        <label for="exampleFormControlSelect1">Giới tính</label>
                        <select name="gender" class="form-control" id="">
                            <option value="2">Nam</option>
                            <option value="1">Nữ</option>
                            <option value="0">Không yêu cầu</option>
                        </select>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="exampleFormControlInput2">Thành phố</label>
                        <select name="location_id" class="form-control" id="">
                            @foreach($locations as $location)
                            <option value="{{$location->id}}">{{$location->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="exampleFormControlSelect1">Chọn danh mục</label>
                        <select name="cate_id" class="form-control" id="">
                            @foreach($categories as $cate)
                            <option value="{{$cate->id}}">{{$cate->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div><br>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="">Mô tả chi tiết công việc</label>
                        <textarea class="form-control" name="detail" id="" rows="5"></textarea>
                    </div>
                </div>
                <input type="submit" name="txt" value="Thêm mới" class="mt-4 btn btn-primary">
                <a class="mt-4 btn btn-danger" href="{{route('blog.index')}}">Quay lại</a>
            </form>
        </div>
    </div>
</div>

@endsection