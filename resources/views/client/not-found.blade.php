@extends('client.layout.layout')
@section('title', 'Lỗi')
@section('main-content')

<!-- Page Content -->
<div class="container">
  <div class="row">
    <div class="col-xl-12">
      <section id="utf-not-found-item" class="center margin-top-25 margin-bottom-40">
        <div class="utf-error-img"><img src="images/error-404.png" alt=""></div>
        <h1>Trang không còn tồn tại!</h1>
        <p>Ohhh!!!! Bạn đang cố gắng truy cập 1 trang không có sẵn. Hãy trở lại trang chủ</p>
        <div class="utf-centered-button">
          <a href="{{route('home')}}" class="button ripple-effect big margin-top-10 margin-bottom-20">Trở lại trang chủ</a>
        </div>
      </section>
    </div>
  </div>
</div>
<!-- Container / End -->

@endsection