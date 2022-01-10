@extends('client.company.layout.layout')
@section('title', 'Tìm kiếm ứng viên')

@section('name', 'Tìm kiếm ứng viên')
@section('main-content')
<style>
  .inner_search_block_section{
    margin-bottom: 38px !important;
  }
</style>
<div class="inner_search_block_section padding-top-0">
  <div class="container">
    <div class="col-md-12">

      <form action="" method="get" class="utf-intro-banner-search-form-block">
        <div class="utf-intro-search-field-item">
          <i class="icon-feather-search"></i>
          <input id="intro-keywords" name="keyword" type="text" value="@if(isset($_GET['keyword']))  {{$_GET['keyword']}} @endif" placeholder="Tên ứng viên...">
        </div>

        <div class="utf-intro-search-field-item">
          <select class="selectpicker default" name="cate_id" data-live-search="true" data-selected-text-format="count" data-size="5" title="Nghành Nghề">
            @foreach($cate as $c)
            @if($c->enable == 1)
            <option @if(isset($_GET['cate_id']))
                    @if($_GET['cate_id'] == $c->id)
                    selected
                    @endif
                    @endif
                    value="{{$c->id}}">{{$c->name}}</option>;
            @endif
            @endforeach

          </select>
        </div>
        <div class="utf-intro-search-field-item">
          <select class="selectpicker default" name="location_id" data-live-search="true" data-selected-text-format="count" data-size="5" title="Địa Chỉ">
            @foreach($loca as $l)
            <option @if(isset($_GET['location_id']))
                    @if($_GET['location_id'] == $l->id)
                    selected
                    @endif
                    @endif value="{{$l->id}}">{{$l->name}}</option>;
            @endforeach

          </select>
        </div>
        <div class="utf-intro-search-field-item">
          <select class="selectpicker default" name="gender" data-live-search="true" data-selected-text-format="count" data-size="5" title="Giới Tính">
            @foreach(config('common.gender') as $key => $val)
            <option @if(isset($_GET['gender']))
                    @if($_GET['gender'] == $key)
                    selected
                    @endif
                    @endif value="{{$key}}">{{$val}}</option>
            @endforeach
          </select>
        </div>
        <div class="utf-intro-search-button">
          <button class="button ripple-effect" type="submit" onclick="window.location.href='jobs-list-layout-leftside.html'"><i class="icon-material-outline-search"></i> Tìm kiếm</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="dashboard-box margin-top-0">
  <div class="headline">
    <h3>Danh sách ứng viên</h3>
  </div>
  <div class="content">
    <ul class="utf-dashboard-box-list">
      @if(count($candidate) > 0)
      @foreach($candidate as $c)
      <li>
        <div class="utf-manage-resume-overview-aera utf-manage-candidate">
          <div class="utf-manage-resume-overview-aera-inner">
            <div class="utf-manage-resume-avatar">
              <a href="{{route('candidate', ['id'=> $c->id])}}"><img class="utf-manage-resume-avatar" src="{{asset('storage/' . $c->avatar )}}" alt=""></a>
            </div>
            <div class="utf-manage-resume-item">
              <h4><a href="{{route('candidate', ['id'=> $c->id])}}">{{$c->name}}</a></h4>
              <span class="utf-manage-resume-detail-item"><a href="#"><i class="icon-feather-mail"></i> {{$c->user->email}}</a></span>
              <span class="utf-manage-resume-detail-item"><i class="icon-feather-phone"></i> {{$c->phone_number}}</span>
              <span class="utf-manage-resume-detail-item"><a href="#"><i class="icon-material-outline-location-on"></i> {{$c->address}}</a></span>
              <div class="utf-buttons-to-right">
                <!-- <a href="#small-dialog" class="popup-with-zoom-anim button ripple-effect" title="Chi Tiết" data-tippy-placement="top"><i class="icon-feather-eye"></i> Chi Tiết</a> -->

                <!-- <a href="{{route('candidatesearch.delete', ['id'=> $c->id])}}" class="button red ripple-effect ico" title="Xóa" data-tippy-placement="top"><i class="icon-feather-trash-2"></i></a>  -->
              </div>
            </div>
          </div>
        </div>
      </li>

      <!-- Apply for a job popup / End -->
      @endforeach
    </ul>
    @else
      <div class="utf-notify-box-aera margin-top-15">
        <div class="utf-switch-container-item total_job">
          <span>Không có kết quả nào hợp lệ!</span>
        </div>
      </div>
      @endif
  </div>
</div>


<!-- Pagination -->
<div class="clearfix"></div>
<div class="utf-pagination-container-aera margin-top-20 margin-bottom-0">
  <nav class="pagination">
    <ul>
      {{$candidate-> links()}}
    </ul>
  </nav>
</div>
<div class="clearfix"></div>
</div>
</div>
@endsection