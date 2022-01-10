@extends('client.company.layout.layout')
@section('title', 'Thêm tin tuyển dụng')
@section('name', 'Thêm tin tuyển dụng')
@section('main-content')
<style>
  .utf-centered-button .button{
    margin-bottom: 13px !important;
  }
</style>
<div class="dashboard-box">
  <div class="headline">
    <h3>Thêm thông tin tuyển dụng</h3>
  </div>
  <form method="POST" enctype="multipart/form-data" class="content with-padding padding-bottom-10">
    @csrf
    <input type="hidden" name="user_recruitment_id" value="{{Auth::user()->id}}">
    <div class="row">
      <div class="col-xl-6 col-md-6 col-sm-6">
        <div class="utf-submit-field ">
          <?php $cateid = App\Models\UserRecruitment::find(Auth::user()->id)->cate_id?>
          <h5>Ngành nghề</h5>
          <select name="cate_id" class="selectpicker default" data-live-search="true" data-selected-text-format="count" data-size="5" title="Nghành nghề">
            @foreach($cate as $c)
            @if($c->enable == 1)
            <option @if($c->id == old('cate_id') || $cateid == $c->id)
              selected
              @endif value="{{$c->id}}">{{$c->name}}</option>
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
          <input type="text" value="{{old('title')}}" name="title" id="name" class="utf-with-border" placeholder="Tiêu đề...">
          @error('title')
          <p class="text-danger">{{$message}}</p>
          @enderror
        </div>

      </div>

      <div class="col-xl-6 col-md-6 col-sm-6">
        <div class="utf-submit-field">
          <h5>Slug</h5>
          <input type="text" id="slug" value="{{old('slug')}}" name="slug" class="utf-with-border" placeholder="Slug...">
          @error('slug')
          <p class="text-danger">{{$message}}</p>
          @enderror
        </div>
      </div>
      <div class="col-xl-6 col-md-6 col-sm-6">
        <div class="utf-submit-field">
          <h5>Chức vụ</h5>
          <input type="text" value="{{old('position')}}" name="position" class="utf-with-border" placeholder="Chức vụ...">
          @error('position')
          <p class="text-danger">{{$message}}</p>
          @enderror
        </div>
      </div>
      <div class="col-xl-6 col-md-6 col-sm-6">
        <div class="utf-submit-field">
          <h5>Hình thức làm việc:</h5>
          <select name="working_time[]" class="selectpicker default" data-live-search="true" data-selected-text-format="count" multiple data-size="5" title="Hình thức làm việc">
            @foreach(config('common.working_time') as $key => $val)
            <option @if(old('working_time')==$key) selected @endif value="{{$key}}">{{$val}}</option>
            @endforeach
          </select>
          @error('working_time')
          <p class="text-danger">{{$message}}</p>
          @enderror
        </div>
      </div>
      <div class="col-xl-6 col-md-6 col-sm-6">
        <div class="utf-submit-field">
          <h5>Số lượng cần tuyển</h5>
          <input type="number" value="{{old('quantity')}}" name="quantity" class="utf-with-border" placeholder="Số lượng cần tuyển...">
          @error('quantity')
          <p class="text-danger">{{$message}}</p>
          @enderror
        </div>
      </div>
      <div class="col-xl-6 col-md-6 col-sm-6">
        <div class="utf-submit-field">
          <h5>Mức lương thấp nhất</h5>
          <input type="number" value="{{old('salary_min')}}" name="salary_min" class="utf-with-border" placeholder="Mức lương...">
          @error('salary_min')
          <p class="text-danger">{{$message}}</p>
          @enderror
        </div>
      </div>
      <div class="col-xl-6 col-md-6 col-sm-6">
        <div class="utf-submit-field">
          <h5>Mức lương cao nhất</h5>
          <input type="number" value="{{old('salary_max')}}" name="salary_max" class="utf-with-border" placeholder="Mức lương...">
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
            <option @if(old('gender')==$key) selected @endif value="{{$key}}">{{$val}}</option>
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
          <select name="exp" class="selectpicker utf-with-border" data-size="7" title="Kinh nghiệm làm việc">
            @foreach(config('common.exp') as $key => $val)
            <option @if(old('exp')==$key) selected @endif value="{{$key}}">{{$val}}</option>
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
            <input type="date" name="deadline" value="{{old('deadline')}}" id="deadline" class="form-control" value="">
            @error('deadline')
            <p class="text-danger">{{$message}}</p>
            @enderror
          </div>
        </div>
      </div>
      <div class="col-xl-6 col-md-6 col-sm-6">
        <div class="utf-submit-field">
          <?php $loca_id = App\Models\UserRecruitment::find(Auth::user()->id)->location_id ?>
          <h5>Địa chỉ</h5>
          <select class="selectpicker utf-with-border" data-live-search="true" name="location_id" data-size="7" title="Địa chỉ làm việc">
            @foreach($loca as $l)

            <option @if($l->id == old('location_id') || $loca_id == $l->id )
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

              <img class="profile-pic" src="{{asset('theme/client')}}/images/image.jpg" alt="" />
              <div class="upload-button "></div>
              <input class="file-upload" name="file_upload" type="file" accept="image/*" />
            </div>
            @error('file_upload')
            <p class="text-danger">{{$message}}</p>
            @enderror
          </div>
        </div>

      </div>
      <div class="col-xl-12 col-md-12 col-sm-12">
        <div class="utf-submit-field">
          <h5>Mô tả công việc</h5>
          <textarea id="editor" cols="40" rows="2" name="detail" class="utf-with-border" placeholder="Mô tả công việc...">{{old('detail')}}</textarea>
          @error('detail')
          <p class="text-danger">{{$message}}</p>
          @enderror
        </div>
        <script>
          CKEDITOR.replace('editor');
        </script>
      </div>
      <div class="utf-centered-button">
        <input type="submit" id="btn-contact" class="submit button" value="Thêm mới">
      </div>

    </div>
  </form>
</div>
@endsection
