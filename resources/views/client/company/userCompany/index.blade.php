@extends('client.company.layout.layout')
@section('title', 'Quản lý tin tuyển dụng')
@section('name', 'Công ty')
@section('main-content')
<style>
  .avatar {
    margin-left: 40%;
    position: relative;
    display: inline-block;
    filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.25));
    margin-bottom: 40px;
  }

  .avatar img {

    max-width: 100% !important;
    width: 168px;
    height: 168px;
    border-radius: 50%;
  }

  .avatar span {
    position: absolute;
    bottom: 5px;
    right: 0;
    display: inline-block;
    width: 48px;
    height: 48px;
    line-height: 42px;
    background: #3797dd;
    border: 3px solid #ffffff;
    box-sizing: border-box;
    color: #fff;
    text-align: center;
    border-radius: 50%;
    cursor: pointer;
  }

  .fa {
    display: inline-block;
    font: normal normal normal 14px/1 FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
  }

  .hidden {
    display: none !important;
  }
</style>
<style>
  /* Custom Upload Button
  ------------------------------------- */
  .uploadImage {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
    margin-bottom: 10px;
    width: 100%;
    font-style: normal;
    font-size: 14px;
  }

  .uploadImage .uploadImage-input {
    opacity: 0;
    position: absolute;
    overflow: hidden;
    z-index: -1;
    pointer-events: none;
  }

  .uploadImage .uploadImage-button {
    display: flex;
    align-items: center;
    justify-content: center;
    box-sizing: border-box;
    height: 44px;
    padding: 10px 18px;
    cursor: pointer;
    border-radius: 4px;
    color: #66676b;
    background-color: transparent;
    border: 1px solid #66676b;
    flex-direction: row;
    transition: 0.3s;
    margin: 0;
    outline: none;
    box-shadow: 0 3px 10px rgba(102, 103, 107, 0.1);
  }

  .uploadImage .uploadImage-button:hover {
    background-color: #66676b;
    box-shadow: 0 4px 12px rgba(102, 103, 107, 0.15);
    color: #fff;
  }

  .uploadImage .uploadImage-file-name {
    flex-grow: 1;
    display: flex;
    align-items: center;
    flex: 1;
    box-sizing: border-box;
    padding: 0 10px;
    padding-left: 15px;
    font-size: 15px;
    font-weight: 500;
    min-height: 45px;
    top: 0px;
    position: relative;
    color: #808080;
    background: #fbfdff;
    border: 1px solid #dde6ef;
    overflow: hidden;
    line-height: 22px;
    margin-left: 10px;
    border-radius: 4px;
    box-shadow: 0 1px 4px 0px rgba(0, 0, 0, 0.05);
  }

  /* ---------------------------------- */


  .uploadImage .uploadImage-file-name {

    font-size: 14px;
  }

  .uploadImage .uploadImage-button:hover {
    background-color: #ff8a00;
  }

  .uploadImage .uploadImage-button,
  .pricing-plan .button {
    color: #ff8a00;
    border: 1px solid #ff8a00;
  }

  .uploadImage .uploadImage-button {
    background-color: #ff8a00;
    color: #ffffff;
    border: 1px solid #ff8a00;
  }

  .uploadImage .uploadImage-button:hover {
    background-color: #424242;
    color: #ffffff;
    border: 1px solid #424242;
  }

  /* Ripple Effect
  ------------------------------------- */
  .ripple-effectt {
    overflow: hidden;
    position: relative;
    z-index: 1;
  }

  .ripple-effectt span.ripple-overlayy {
    animation: ripple 0.9s;
    border-radius: 100%;
    background: #fff;
    height: 12px;
    position: absolute;
    width: 12px;
    line-height: 12px;
    opacity: 0.1;
    pointer-events: none;
  }

  .utf-ripple-effect-dark,
  .ripple-effectt {
    overflow: hidden;
    position: relative;
    z-index: 1;
  }

  .ripple-effectt span.ripple-overlayy,
  .utf-ripple-effect-dark span.ripple-overlayy {
    animation: ripple 0.9s;
    border-radius: 100%;
    background: #fff;
    height: 12px;
    position: absolute;
    width: 12px;
    line-height: 12px;
    opacity: 0.1;
    pointer-events: none;
  }

  .utf-ripple-effect-dark span.ripple-overlayy {
    background: #000;
    opacity: 0.07;
  }
</style>
<style>
  /* Custom Upload Button
  ------------------------------------- */
  .fileButton {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
    margin-bottom: 10px;
    width: 100%;
    font-style: normal;
    font-size: 14px;
  }

  .fileButton .fileButton-input {
    opacity: 0;
    position: absolute;
    overflow: hidden;
    z-index: -1;
    pointer-events: none;
  }

  .fileButton .fileButton-button {
    display: flex;
    align-items: center;
    justify-content: center;
    box-sizing: border-box;
    height: 44px;
    padding: 10px 18px;
    cursor: pointer;
    border-radius: 4px;
    color: #66676b;
    background-color: transparent;
    border: 1px solid #66676b;
    flex-direction: row;
    transition: 0.3s;
    margin: 0;
    outline: none;
    box-shadow: 0 3px 10px rgba(102, 103, 107, 0.1);
  }

  .fileButton .fileButton-button:hover {
    background-color: #66676b;
    box-shadow: 0 4px 12px rgba(102, 103, 107, 0.15);
    color: #fff;
  }

  .fileButton .fileButton-file-name {
    flex-grow: 1;
    display: flex;
    align-items: center;
    flex: 1;
    box-sizing: border-box;
    padding: 0 10px;
    padding-left: 15px;
    font-size: 15px;
    font-weight: 500;
    min-height: 45px;
    top: 0px;
    position: relative;
    color: #808080;
    background: #fbfdff;
    border: 1px solid #dde6ef;
    overflow: hidden;
    line-height: 22px;
    margin-left: 10px;
    border-radius: 4px;
    box-shadow: 0 1px 4px 0px rgba(0, 0, 0, 0.05);
  }

  /* ---------------------------------- */


  .fileButton .fileButton-file-name {

    font-size: 14px;
  }

  .fileButton .fileButton-button:hover {
    background-color: #ff8a00;
  }

  .fileButton .fileButton-button,
  .pricing-plan .button {
    color: #ff8a00;
    border: 1px solid #ff8a00;
  }

  .fileButton .fileButton-button {
    background-color: #ff8a00;
    color: #ffffff;
    border: 1px solid #ff8a00;
  }

  .fileButton .fileButton-button:hover {
    background-color: #424242;
    color: #ffffff;
    border: 1px solid #424242;
  }

  /* Ripple Effect
  ------------------------------------- */
  .ripple-effecttt {
    overflow: hidden;
    position: relative;
    z-index: 1;
  }

  .ripple-effecttt span.ripple-overlayy {
    animation: ripple 0.9s;
    border-radius: 100%;
    background: #fff;
    height: 12px;
    position: absolute;
    width: 12px;
    line-height: 12px;
    opacity: 0.1;
    pointer-events: none;
  }

  .utf-ripple-effect-dark,
  .ripple-effecttt {
    overflow: hidden;
    position: relative;
    z-index: 1;
  }

  .ripple-effecttt span.ripple-overlayy,
  .utf-ripple-effect-dark span.ripple-overlayy {
    animation: ripple 0.9s;
    border-radius: 100%;
    background: #fff;
    height: 12px;
    position: absolute;
    width: 12px;
    line-height: 12px;
    opacity: 0.1;
    pointer-events: none;
  }

  .utf-ripple-effect-dark span.ripple-overlayy {
    background: #000;
    opacity: 0.07;
  }
  .utf-centered-button .button{
    margin-bottom: 27px !important;
  }
</style>
<div class="row">
  <form action="" enctype="multipart/form-data" method="POST">
    @csrf
    <div class="col-xl-12">
      <div class="dashboard-box">
        <div class="headline">
          <h3>Thông tin nhà tuyển dụng</h3>
        </div>
        <div class="content with-padding padding-bottom-10">
          <div class="row">
            <div class="col-xl-6">
              <div class="utf-submit-field">
                <div action="../codelogin/change_avt_ntd.php" method="POST" enctype="multipart/form-data">
                  <h5>Avatar</h5>
                  <div class="utf-avatar-wrapper" style="height:150px;width:150px" data-tippy-placement="top" title="Change Profile Picture">
                    <img class="profile-pic" src="{{asset('storage/'. $company->avatar)}}" alt="" />
                    <div class="upload-button "></div>
                    <input class="file-upload" name="avatar" value="{{old('avatar', $company->avatar)}}" type="file" accept="image/*" />
                  </div>
                </div>
              </div>
              @error('file-upload')
              <p class="text-danger">{{$message}}</p>
              @enderror
            </div>
            <div class="col-xl-6">
              <div class="utf-submit-field">
                <h5>Tên công ty</h5>
                <input type="text" name="name" id="name" value="{{old('name', $company->name)}}" class="utf-with-border" placeholder="Tên công ty...">
                @error('name')
                <p class="text-danger">{{$message}}</p>
                @enderror
              </div>
              <div class="utf-submit-field">
                <h5>Mã số thuế</h5>
                <input type="text" name="tax_code" value="{{old('tax_code', $company->tax_code)}}" class="utf-with-border" placeholder="Mã số thuế...">
                @error('tax_code')
                <p class="text-danger">{{$message}}</p>
                @enderror
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xl-6 col-md-6 col-sm-6">
              <div class="utf-submit-field">
                <h5>Số điện thoại cố định</h5>
                <input type="number" name="phone" value="{{old('phone', $company->phone)}}" class="utf-with-border" placeholder="Số điện thoại cố định...">
                @error('phone')
                <p class="text-danger">{{$message}}</p>
                @enderror
              </div>
            </div>
            <div class="col-xl-6 col-md-6 col-sm-6">
              <div class="utf-submit-field">
                <h5>Đường dẫn</h5>
                <input type="text" id="slug" name="slug" value="{{old('slug', $company->slug)}}" class="utf-with-border" placeholder="Đường dẫn...">
                @error('slug')
                <p class="text-danger">{{$message}}</p>
                @enderror
              </div>
            </div>
            <div class="col-xl-6 col-md-6 col-sm-6">
              <div class="utf-submit-field">
                <h5>Ngày thành lập công ty</h5>
                <div class="utf-input-with-icon">
                  <input type="date" name="date_start" value="{{old('date_start', $company->date_start)}}" id="DateOfIncorporation" class="form-control">
                </div>
              </div>
              @error('date_start')
              <p class="text-danger">{{$message}}</p>
              @enderror
            </div>
            <div class="col-xl-6 col-md-6 col-sm-6">
              <div class="utf-submit-field">
                <h5>Quy mô công ty</h5>
                <select name="company_size" class="selectpicker utf-with-border" data-size="7" title="Chọn quy mô công ty">
                  @foreach(config('common.company_size') as $key => $val)
                  <option @if (old('company_size' , $company->company_size == $val) ==$val )
                    selected
                    @endif
                    value="{{$val}}">{{$val}}</option>
                  @endforeach
                </select>
              </div>
              @error('company_size')
              <p class="text-danger">{{$message}}</p>
              @enderror
            </div>
            <div class="col-xl-6 col-md-6 col-sm-6">
              <div class="utf-submit-field">
                <h5>Hình ảnh</h5>
                <div class="uploadImage margin-top-15 margin-bottom-30">
                  <input class="uploadImage-input" name="image" type="file" accept="image/*, application/pdf" id="upload-image" multiple />
                  <label class="uploadImage-button ripple-effectt" for="upload-image">Thêm</label>
                  <span class="uploadImage-file-name">{{old('image', $company->image)}}</span>
                </div>
                @error('image')
                <p class="text-danger">{{$message}}</p>
                @enderror
              </div>
            </div>
            <div class="col-xl-6 col-md-6 col-sm-6">
              <div class="utf-submit-field ">
                <h5>Địa điểm</h5>
                <select class="selectpicker default" name="location_id" data-live-search="true" data-selected-text-format="count" data-size="5" title="Chọn địa điểm">
                  @foreach($loca as $l)
                  <option @if($l->id == old('location_id' , $company->location_id))
                    selected
                    @endif
                    value="{{$l->id}}">{{$l->name}}</option>;
                  @endforeach
                </select>
              </div>
              @error('location_id')
              <p class="text-danger">{{$message}}</p>
              @enderror
            </div>
            <div class="col-xl-6 col-md-6 col-sm-6">
              <div class="utf-submit-field">
                <h5>Ảnh bìa</h5>
                <div class="uploadButton margin-top-15 margin-bottom-30">
                  <input class="uploadButton-input" name="banner" type="file" accept="image/*, application/pdf" id="upload" multiple />
                  <label class="uploadButton-button ripple-effect" for="upload">Thêm</label>
                  <span class="uploadButton-file-name">{{old('banner', $company->banner)}}</span>
                </div>
              </div>
              @error('banner')
              <p class="text-danger">{{$message}}</p>
              @enderror
            </div>
            <div class="col-xl-6 col-md-6 col-sm-6">
              <div class="utf-submit-field">
                <h5>Danh mục</h5>
                <select class="selectpicker default" name="cate_id" data-live-search="true" data-selected-text-format="count" data-size="5" title="Chọn danh mục">
                  @foreach($cate as $c)
                  @if($c->enable == 1)
                  <option @if($c-> id == old('cate_id' , $company->cate_id))
                    selected
                    @endif
                    value="{{$c->id}}">{{$c->name}}</option>
                  @endif
                  @endforeach
                </select>
              </div>
              @error('cate_id')
              <p class="text-danger">{{$message}}</p>
              @enderror
            </div>
            <?php

            use Illuminate\Support\Facades\Auth;

            // $model = \App\Models\UserRecruitment::find(Auth::user()->id);
            // var_dump($model->id); die;
            $fullname = \App\Models\UserFile::where('user_id', Auth::user()->id)->first();
            if ($fullname) {
              $fullname = $fullname->file;
            } else {
              $fullname = '';
            }
            ?>
            <div class="col-xl-6 col-md-6 col-sm-6">
              <div class="utf-submit-field">
                <h5>Thêm file giấy tờ</h5>
                <div class="fileButton margin-top-15 margin-bottom-30">
                  <input class="fileButton-input" name="file" type="file" accept=".zip,.rar,.7zip,image/*, application/pdf" id="upload-file" multiple />
                  <label class="fileButton-button ripple-effecttt" for="upload-file">Thêm</label>
                  <span class="fileButton-file-name">{{$fullname}}</span>
                </div>
              </div>
              @error('file')
              <p class="text-danger">{{$message}}</p>
              @enderror
            </div>

            <div class="col-xl-6 col-md-6 col-sm-6">
              <div class="utf-submit-field">
                <h5>Link Website</h5>
                <input type="text" name="link_website" placeholder="Link website..." value="{{old('link_website', $company->link_website)}}" class="utf-with-border" placeholder="Link website...">
                @error('link_website')
                <p class="text-danger">{{$message}}</p>
                @enderror
              </div>
            </div>
            <div class="col-xl-6 col-md-6 col-sm-6">
              <div class="utf-submit-field">
                <h5>Map</h5>
                <textarea name="map" id="" cols="30" rows="5">{{old('map', $company->map)}}</textarea>
                @error('map')
                <p class="text-danger">{{$message}}</p>
                @enderror
              </div>
            </div>
            <div class="col-xl-6 col-md-6 col-sm-6">
              <div class="utf-submit-field">
                <h5>Địa chỉ</h5>
                <textarea name="address" placeholder="địa chỉ..." id="" cols="30" rows="5">{{old('address', $company->address)}}</textarea>
                @error('address')
                <p class="text-danger">{{$message}}</p>
                @enderror
              </div>
            </div>
            <div class="col-xl-12 col-md-12 col-sm-12">
              <div class="utf-submit-field">
                <h5>Giới thiệu về công ty</h5>
                <textarea id="editor" cols="40" rows="2" name="detail" class="utf-with-border" placeholder="Giới thiệu công ty...">{{old('detail', $company->detail)}}</textarea>
                <script>
                  CKEDITOR.replace('editor');
                </script>
                @error('detail')
                <p class="text-danger">{{$message}}</p>
                @enderror
              </div>
            </div>
            <div class="col-xl-12 col-md-12 col-sm-12">
              <div class="utf-submit-field">
                <h5>Mô tả ngắn</h5>
                <textarea id="editor1" cols="40" rows="2" name="intro" class="utf-with-border" placeholder="Mô tả ngắn...">{{old('intro', $company->intro)}}</textarea>
                <script>
                  CKEDITOR.replace('editor1');
                </script>
                @error('intro')
                <p class="text-danger">{{$message}}</p>
                @enderror
              </div>
            </div>
          </div>
        </div>
        <div class="utf-centered-button">
          <input type="submit" id="btn-contact" class="submit button" value="Cập nhật">
        </div>
      </div>
    </div>
  </form>
  @if(session('msg'))
  <script>
    alertify.success('Cập nhật thông tin thành công!');
  </script>
  @endif
  <script>
    (function($) {
      "use strict";

      $(document).ready(function() {
        /*  Ripple Effect
       /*--------------------------------------------------*/
        $('.ripple-effectt , .utf-ripple-effect-dark').on('click', function(e) {
          var rippleDiv = $('<span class="ripple-overlayy">'),
            rippleOffset = $(this).offset(),
            rippleY = e.pageY - rippleOffset.top,
            rippleX = e.pageX - rippleOffset.left;

          rippleDiv.css({
            top: rippleY - (rippleDiv.height() / 2),
            left: rippleX - (rippleDiv.width() / 2),
            // background: $(this).data("ripple-color");
          }).appendTo($(this));

          window.setTimeout(function() {
            rippleDiv.remove();
          }, 800);
        });
        /*  Custom Upload image
            /*----------------------------------------------------*/
        var uploadImage = {
          $buttonn: $('.uploadImage-input'),
          $nameFieldd: $('.uploadImage-file-name')
        };

        uploadImage.$buttonn.on('change', function() {
          _populateFileField($(this));
        });

        function _populateFileField($buttonn) {
          var selectedFilee = [];
          for (var i = 0; i < $buttonn.get(0).files.length; ++i) {
            selectedFilee.push($buttonn.get(0).files[i].name + '<br>');
          }
          uploadImage.$nameFieldd.html(selectedFilee);
        };

      });
      /*-----------------------------------------
      /*  Preloader
      -----------------------------------------*/
      $(window).on('load', function() {
        setTimeout(function() {
          $(".preloader").delay(700).fadeOut(700).addClass('loaded');
        }, 800);
      });
    })(this.jQuery);
  </script>
  <script>
    (function($) {
      "use strict";

      $(document).ready(function() {
        /*  Ripple Effecttt
       /*--------------------------------------------------*/
        $('.ripple-effecttt , .utf-ripple-effect-dark').on('click', function(e) {
          var rippleDiv = $('<span class="ripple-overlayy">'),
            rippleOffset = $(this).offset(),
            rippleY = e.pageY - rippleOffset.top,
            rippleX = e.pageX - rippleOffset.left;

          rippleDiv.css({
            top: rippleY - (rippleDiv.height() / 2),
            left: rippleX - (rippleDiv.width() / 2),
            // background: $(this).data("ripple-color");
          }).appendTo($(this));

          window.setTimeout(function() {
            rippleDiv.remove();
          }, 800);
        });
        /*  Custom Upload file
/*----------------------------------------------------*/
        var fileButton = {
          $buttonnn: $('.fileButton-input'),
          $nameFielddd: $('.fileButton-file-name')
        };

        fileButton.$buttonnn.on('change', function() {
          _populateFileField($(this));
        });

        function _populateFileField($buttonnn) {
          var selectedFileee = [];
          for (var i = 0; i < $buttonnn.get(0).files.length; ++i) {
            selectedFileee.push($buttonnn.get(0).files[i].name + '<br>');
          }
          fileButton.$nameFielddd.html(selectedFileee);
        };
      });
      /*-----------------------------------------
      /*  Preloader
      -----------------------------------------*/
      $(window).on('load', function() {
        setTimeout(function() {
          $(".preloader").delay(700).fadeOut(700).addClass('loaded');
        }, 800);
      });
    })(this.jQuery);
  </script>
</div>
@endsection
