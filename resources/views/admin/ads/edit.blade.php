@extends('admin.layout.layout')
@section('title', 'Admin-Cập nhật quảng cáo')
@section('route', 'Cập nhật quảng cáo')
@section('slide-menu','actives')
@section('main-content')

<br>
<div class="col-lg-12 col-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>Cập nhật slide quảng cáo</h4>
                </div>
            </div>
        </div><br>
        <div class="widget-content widget-content-area">
            <form action="" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label for="exampleFormControlInput2">Price</label>
                        <input autocomplete="off" type="text" name="price" value="{{$ads->price}}" class="form-control" id="" placeholder="">
                        @error('price')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="exampleFormControlFile1">Hình ảnh</label>
                        <input type="file" class="form-control-file" name="image" id="exampleFormControlFile1">
                        <br>
                        <div class="div">
                            @if($ads->image)
                            <img src="{{asset('storage/' . $ads->image)}}" width="480px" height="100px" style="object-fit: cover;" alt="">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                             <label for="">Trạng thái</label>
                            <br>
                            <!--<label for="">
                                <input type="radio" name="role" @if($ads->role == 200) checked @endif value="200" id="">
                                Banner
                            </label>
                            <label for="">
                                <input type="radio" name="role" @if($ads->role == 0) checked @endif value="0" id="">
                                Slider
                            </label> -->
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline1" name="role" class="custom-control-input" @if($ads->role == 200) checked @endif value="200">
                                <label class="custom-control-label" for="customRadioInline1" >Banner</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline2" name="role" class="custom-control-input" @if($ads->role == 0) checked @endif value="0">
                                <label class="custom-control-label" for="customRadioInline2" >Slider</label>
                            </div>

                        </div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="exampleFormControlInput2">Từ ngày</label>
                        <input type="date" name="from_time" value="{{$ads->from_time}}" class="form-control" id="" placeholder="">
                        @error('from_time')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="exampleFormControlInput2">Đến ngày</label>
                        <input type="date" name="to_time" value="{{$ads->to_time}}" class="form-control" id="" placeholder="">
                        @error('to_time')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="exampleFormControlInput2">Link</label>
                        <input autocomplete="off" type="text" name="link" value="{{$ads->link}}" class="form-control" id="" placeholder="">
                        @error('link')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="exampleFormControlInput2">Alt</label>
                        <input autocomplete="off" type="text" name="alt" value="{{$ads->alt}}" class="form-control" id="" placeholder="">
                        @error('alt')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" name="time" class="mt-4 mb-4 btn btn-primary">Cập nhật</button>
                <a href="{{route('ads.index')}}" type="submit" name="time" class="mt-4 mb-4 btn btn-danger">Quay lại</a>
            </form>
        </div>
    </div>
</div>

@endsection