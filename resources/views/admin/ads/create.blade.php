@extends('admin.layout.layout')
@section('title', 'Admin-Thêm mới quảng cáo')
@section('route', 'Thêm mới quảng cáo')
@section('slide-menu', 'actives')
@section('main-content')

<br>
<div class="col-lg-12 col-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>Thêm mới</h4>
                </div>
            </div>
        </div><br>
        <div class="widget-content widget-content-area">
            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label for="exampleFormControlInput2">Giá</label>
                        <input autocomplete="off" type="text" name="price" value="{{old('price')}}" class="form-control" id="" placeholder="">
                        @error('price')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="exampleFormControlFile1">Hình ảnh</label>
                        <input autocomplete="off" type="file" class="form-control-file" name="image" id="exampleFormControlFile1">
                        @error('image')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">Trạng thái</label>
                            <br>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline1" name="role" class="custom-control-input" checked value="200">
                                <label class="custom-control-label" for="customRadioInline1" >Banner</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline2" name="role" class="custom-control-input" value="0">
                                <label class="custom-control-label" for="customRadioInline2" >Slider</label>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="exampleFormControlInput2">Từ ngày</label>
                        <input autocomplete="off" type="date" name="from_time" value="{{old('from_time')}}" class="form-control" id="" placeholder="">
                        @error('from_time')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="exampleFormControlInput2">Đến ngày</label>
                        <input autocomplete="off" type="date" name="to_time" value="{{old('to_time')}}" class="form-control" id="" placeholder="">
                        @error('to_time')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="exampleFormControlInput2">Link</label>
                        <input autocomplete="off" type="text" name="link" value="{{old('link')}}" class="form-control" id="" placeholder="">
                        @error('link')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="exampleFormControlInput2">Alt</label>
                        <input autocomplete="off" type="text" name="alt" value="{{old('alt')}}" class="form-control" id="" placeholder="">
                        @error('alt')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <input type="submit" name="txt" value="Thêm mới" class="mt-4 btn btn-primary">
                <a class="mt-4 btn btn-danger" href="{{route('ads.index')}}">Quay lại</a>
            </form>
        </div>
    </div>
</div>

@endsection