@extends('client.company.layout.layout')
@section('title', 'Sửa tin tuyển dụng')
@section('name', 'Sửa tin tuyển dụng')
@section('main-content')
  <style>
    .utf-centered-button .button{
      margin-bottom: 13px !important;
    }
  </style>
<div class="dashboard-box">
  <div class="headline">
    <h3>Sửa thông tin tuyển dụng</h3>
  </div>
  <form method="POST" enctype="multipart/form-data" class="content with-padding padding-bottom-10">
    @csrf
    <input type="hidden" name="user_recruitment_id" value="{{Auth::user()->id}}">
    <div class="row">
      <div class="col-xl-6 col-md-6 col-sm-6">
        <div class="utf-submit-field">
          <h5>Ngành nghề</h5>
          <select class="selectpicker utf-with-border" name="cate_id" data-size="7" title="Nghành nghề...">
            @foreach($cate as $c)
            @if($c->enable == 1)
            <option @if( $c->id == old( 'cate_id' , $blog->cate_id) )
              selected
              @endif
              value="{{$c->id}}">{{$c->name}}</option>
              @endif
            @endforeach
          </select>
          @error('cate_id')
          <p class="text-danger">{{$message}}</p>
          @enderror
        </div>
      </div>
      <div class="col-xl-6 col-md-6 col-sm-6">
        <div class="utf-submit-field">
          <h5>Tiêu đề</h5>
          <input type="text" name="title" id="name" value="{{old('title',$blog->title)}}" class="utf-with-border" placeholder="Tiêu đề...">
          @error('title')
          <p class="text-danger">{{$message}}</p>
          @enderror
        </div>
      </div>

      <div class="col-xl-6 col-md-6 col-sm-6">
        <div class="utf-submit-field">
          <h5>Đường dẫn</h5>
          <input type="text" name="slug" id="slug" value="{{old('slug',$blog->slug)}}" class="utf-with-border" placeholder="Slug...">
          @error('slug')
          <p class="text-danger">{{$message}}</p>
          @enderror
        </div>
      </div>
      <div class="col-xl-6 col-md-6 col-sm-6">
        <div class="utf-submit-field">
          <h5>Chức vụ</h5>
          <input type="text" name="position" value="{{old('position',$blog->position)}}" class="utf-with-border" placeholder="Chức vụ...">
          @error('position')
          <p class="text-danger">{{$message}}</p>
          @enderror
        </div>
      </div>
      <div class="col-xl-6 col-md-6 col-sm-6">
        <div class="utf-submit-field">
          <h5>Hình thức làm việc:</h5>
          <select name="working_time" class="selectpicker" title="Hình thức làm việc">
            @foreach(config('common.working_time') as $key => $val)
            <option @if (old('working_time' , $blog->working_time == $key) ==$key )
              selected
              @endif
              value="{{$key}}">{{$val}}</option>
            @endforeach

            <option value="Full time,Part time" @if ($blog->working_time == "Full time,Part time")
              selected
              @endif />Full time, Part time</option>

          </select>
        </div>
      </div>
      <div class="col-xl-6 col-md-6 col-sm-6">
        <div class="utf-submit-field">
          <h5>Số lượng cần tuyển</h5>
          <input type="number" name="quantity" value="{{old('quantity',$blog->quantity)}}" class="utf-with-border" placeholder="Số lượng cần tuyển...">
          @error('quantity')
          <p class="text-danger">{{$message}}</p>
          @enderror
        </div>
      </div>
      <div class="col-xl-6 col-md-6 col-sm-6">
        <div class="utf-submit-field">
          <h5>Mức lương thấp nhất</h5>
          <input type="number" name="salary_min" value="{{old('salary_min', $blog->salary_min)}}" class="utf-with-border" placeholder="Mức lương...">
          @error('salary_min')
          <p class="text-danger">{{$message}}</p>
          @enderror
        </div>
      </div>
      <div class="col-xl-6 col-md-6 col-sm-6">
        <div class="utf-submit-field">
          <h5>Mức lương cao nhất</h5>
          <input type="number" name="salary_max" value="{{old('salary_max', $blog->salary_max)}}" class="utf-with-border" placeholder="Mức lương...">
          @error('salary_max')
          <p class="text-danger">{{$message}}</p>
          @enderror
        </div>
      </div>
      <div class="col-xl-6 col-md-6 col-sm-6">

        <div class="utf-submit-field">
          <h5>Yêu cầu giới tính</h5>
          <select class="selectpicker utf-with-border" name="gender" data-size="7" title="Yêu cầu giới tính">
            @foreach(config('common.gender') as $key => $val)
            <option @if (old('gender' , $blog->gender == $key) ==$key )
              selected
              @endif
              value="{{$key}}">{{$val}}</option>
            @endforeach
          </select>
          @error('gender')
          <p class="text-danger">{{$message}}</p>
          @enderror
        </div>
      </div>

      <div class="col-xl-6 col-md-6 col-sm-6">
        <div class="utf-submit-field">
          <h5>Kinh nghiệm</h5>
          <select class="selectpicker utf-with-border" name="exp" data-size="7" title="Kinh Nghiệm">
            @foreach(config('common.exp') as $key => $val)
            <option @if (old('exp' , $blog->exp == $key) ==$key )
              selected
              @endif
              value="{{$key}}">{{$val}}</option>
            @endforeach
          </select>
          @error('exp')
          <p class="text-danger">{{$message}}</p>
          @enderror
        </div>
      </div>
      <div class="col-xl-6 col-md-6 col-sm-6">
        <div class="utf-submit-field">
          <h5>Hạn nộp hồ sơ</h5>
          <div class="utf-input-with-icon">
            <input type="date" name="deadline" value="{{old('deadline' , $blog->deadline)}}" id="deadline" class="form-control" value="">
            @error('deadline')
            <p class="text-danger">{{$message}}</p>
            @enderror
          </div>
        </div>
      </div>
      <div class="col-xl-6 col-md-6 col-sm-6">
        <div class="utf-submit-field">
          <h5>Địa chỉ</h5>
          <select class="selectpicker utf-with-border" name="location_id" data-size="7" title="Hình thức làm việc">
            @foreach($loca as $l)
            <option @if( $l->id == old( 'location_id' , $blog->location_id) )
              selected
              @endif
              value="{{$l->id}}">{{$l->name}}</option>
            @endforeach
          </select>
          @error('location_id')
          <p class="text-danger">{{$message}}</p>
          @enderror
        </div>
      </div>
      <div class="col-xl-6 col-md-6 col-sm-6">
        <div class="utf-submit-field">
          <div action="../codelogin/change_avt_ntd.php" method="POST" enctype="multipart/form-data">
            <h5>Hình ảnh</h5>
            <div class="utf-avatar-wrapper" style="height:150px;width:150px" data-tippy-placement="top" title="Change Profile Picture">

              <img class="profile-pic" src="{{asset('storage/'. $blog->image)}}" alt="" />
              <div class="upload-button "></div>
              <input class="file-upload" name="file_upload" value="{{old('file_upload')}}" type="file" accept="image/*" />
            </div>
          </div>
        </div>
        @error('file_upload')
        <p class="text-danger">{{$message}}</p>
        @enderror
      </div>
      <div class="col-xl-12 col-md-12 col-sm-12">
        <div class="utf-submit-field">
          <h5>Mô tả công việc</h5>
          <textarea id="editor" cols="40" rows="2" name="detail" class="utf-with-border" placeholder="Mô tả công việc...">{{old('detail' , $blog->detail)}}</textarea>
          @error('detail')
          <p class="text-danger">{{$message}}</p>
          @enderror
        </div>
        <script>
          CKEDITOR.replace('editor');
        </script>
      </div>

      <div class="utf-centered-button">
        <input type="submit" id="btn-contact" class="submit button" value="Cập nhật">
      </div>

    </div>
  </form>
</div>
@endsection
