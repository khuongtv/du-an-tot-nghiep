<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="author" content="">
  <meta name="theme-color" content="#ff8a00">
  <meta name="description" content="Job Portal HTML Template">
  <meta name="keywords" content="Employment, Naukri, Shine, Indeed, Job Posting, Job Provider">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hồ sơ ứng viên</title>

  <!--  Favicon -->
  <link rel="shortcut icon" href="images/favicon.png">

  <link rel="stylesheet" href="{{asset('theme/client')}}/css/bootstrap-grid.css">
  <link rel="stylesheet" href="{{asset('theme/client')}}/css/icons.css">
  <link rel="stylesheet" href="{{asset('theme/client')}}/css/style.css">
  <link rel="stylesheet" href="{{asset('theme/client')}}/css/profile.css">

  <style>
    body {
      background: #f4f4f4;
      color: #666;
      font-weight: 300;
      line-height: 28px;
    }
  </style>
</head>

<body>
  <div class="print-button-container"> <a href="{{route('home')}}" class="print-button">Trang chủ</a> </div>

  <div id="invoice">
    <div class="row">
      <div class="col-xl-6">
        <div id="logo1"><a href="{{route('home')}}"><img src="{{asset('storage/' . 'images/websites/logo.jpg')}}" alt=""></a></div>
      </div>
      <div class="col-xl-6">
        <p id="details">
          <strong>MẪU HỒ SƠ #{{$profile->id}}</strong> <br>
          <strong>Email:</strong> support.jobs@gmail.com <br>
          <strong>Copy right:</strong> jobs.com.vn
        </p>
      </div>
    </div>

    <div class="row">
      <div class="col-xl-12">
        <h2 class="invoice_title">{{$profile->name}}</h2>
      </div>
      <div class="col-xl-6">
        <div class="avatar1"><a href="{{route('candidate', ['id' => $profile->id])}}"><img src="{{asset('storage/' . $profile->avatar)}}" width="200px" height="250px" alt=""></a></div>
      </div>
      <div class="col-xl-6 fl_right"> <strong class="margin-bottom-5">Thông tin cơ bản:</strong>
        <p>
          <?php $age = date("Y") - date("Y", strtotime($profile->birthday)) ?>
          {{$profile->name}}
          @if(isset($age) > 0)
          ({{$age}} tuổi)
          @endif
          <br>
          {{$profile->phone_number}}
          <br>
          {{$profile->user->email}}
          <br>
          {{$profile->location->name}}
          <br>
        </p>
      </div>
      <div class="col-xl-6"> <strong class="margin-bottom-5">Mô tả:</strong>
        <p>
          {!! $profile->intro !!}
        </p>
      </div>
      <div class="col-xl-6 fl_right"> <strong class="margin-bottom-5">Ngày tạo tài khoản:</strong>
        <p> {{date("d-m-Y", strtotime($profile->created_at))}}
        </p>
      </div>
    </div>

    <div class="row">
      <div class="col-xl-12 utf-sidebar-widget-item">
        <h3>Học vấn</h3>
        <div class="utf-job-deatails-content-item">
          @if(isset($profile->education) && strlen($profile->education) >= 1)
          {!!$profile->education!!}
          @else
          Chưa cập nhập đủ thông tin để hiển thị!
          @endif
        </div>
        <br>
        <h3>Kinh nghiệm làm việc</h3>
        <div class="utf-job-deatails-content-item">
          @if(isset($profile->exp) && strlen($profile->exp) >= 1)
          {!!$profile->exp!!}
          @else
          Chưa cập nhập đủ thông tin để hiển thị!
          @endif
        </div>
        <br>
        <h3>Kỹ năng</h3>
        <div class="utf-job-deatails-content-item">
          @if(isset($profile->skill) && strlen($profile->skill) >= 1)
          {!!$profile->skill!!}
          @else
          Chưa cập nhập đủ thông tin để hiển thị!
          @endif
        </div>
        <br>
        <h3>Khác</h3>
        <div class="utf-job-deatails-content-item">
          @if(isset($profile->detail) && strlen($profile->detail) >= 10)
          {!!$profile->detail!!}
          @else
          Chưa cập nhập đủ thông tin để hiển thị!
          @endif
        </div>
      </div>
    </div>
  </div>
</body>

</html>