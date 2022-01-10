@extends('client.company.layout.layout')
@section('title', 'Thống kê')

@section('name', 'Thống kê')
@section('main-content')
<div class="notification success closeable">
	<?php $fullname = \App\Models\UserRecruitment::find(Auth::user()->id)->name;
	$avatars = \App\Models\UserRecruitment::find(Auth::user()->id)->avatar;

	?>
	<p>Bạn đang đăng nhập với tư cách là <strong>{{$fullname}}</strong> đã được chấp nhận!</p>
	<a class="close" href="#"></a>
</div>
<div class="utf-funfacts-container-aera">
	<div class="fun-fact" data-fun-fact-color="#2a41e8">
		<div class="fun-fact-icon"><i class="icon-feather-home"></i></div>
		<div class="fun-fact-text">
			<h4>{{$TongDon}}</h4>
			<span>Đơn ứng tuyển</span>
		</div>
	</div>
	<div class="fun-fact" data-fun-fact-color="#36bd78">
		<div class="fun-fact-icon"><i class="icon-feather-briefcase"></i></div>
		<div class="fun-fact-text">
			<h4>{{$DaXacNhan}}</h4>
			<span>Tin đã được duyệt</span>
		</div>
	</div>
	<div class="fun-fact" data-fun-fact-color="#0fc5bf">
		<div class="fun-fact-icon"><i class="icon-brand-telegram-plane"></i></div>
		<div class="fun-fact-text">
			<h4>{{$DonChuaDuyet}}</h4>
			<span>Tin chưa được duyệt</span>
		</div>
	</div>
	<div class="fun-fact" data-fun-fact-color="#efa80f">
		<div class="fun-fact-icon"><i class="icon-feather-heart"></i></div>
		<div class="fun-fact-text">
			<h4>{{$TongTin}}</h4>
			<span>Tin tuyển dụng</span>
		</div>
	</div>
	<div class="fun-fact" data-fun-fact-color="#f02727">
		<div class="fun-fact-icon"><i class="icon-feather-trending-up"></i></div>
		<div class="fun-fact-text">
			<h4>{{count($candidate)}}</h4>
			<span>Ứng viên tiềm năng</span>
		</div>
	</div>
	<div class="fun-fact" data-fun-fact-color="#f02727">
		<div class="fun-fact-icon"><i class="icon-feather-trending-up"></i></div>
		<div class="fun-fact-text">
			<h4>{{$tuan}}</h4>
			<span>Đơn ứng tuyển tuần này</span>
		</div>
	</div>
	<div class="fun-fact" data-fun-fact-color="#f02727">
		<div class="fun-fact-icon"><i class="icon-feather-trending-up"></i></div>
		<div class="fun-fact-text">
			<h4>{{$ngay}}</h4>
			<span>Đơn ứng tuyển hôm nay</span>
		</div>
	</div>
</div>


@endsection