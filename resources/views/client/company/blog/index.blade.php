<?php

use Illuminate\Support\Facades\Auth;
?>
@extends('client.company.layout.layout')
@section('title', 'Quản lý tin tuyển dụng')
@section('name', 'Quản lý tin tuyển dụng')

@section('main-content')
<style>
  .time_ago {
    position: absolute;
    right: 5px;
    bottom: -14px;
    font-size: 0.7rem;
  }
  .inner_search_block_section{
    margin-bottom: 38px !important;
    background: no-repeat !important;
  }
</style>
<script>
  function timeFor(seconds) {
    if (!seconds || seconds < 0) {
      return 'Đã hết hạn.';
    }

    var interval = seconds / 86400;
    if (interval < 1) {
      return 'Sắp hết hạn.';
    }

    return 'Còn ' + Math.floor(interval) + " ngày.";
  }
</script>
<div class="inner_search_block_section padding-top-0">
  <div class="container">
    <div class="col-md-12">

      <form action="" method="get" class="utf-intro-banner-search-form-block">
        <div class="utf-intro-search-field-item">
          <i class="icon-feather-search"></i>
          <input id="intro-keywords" name="keyword" value="@if(isset($_GET['keyword']))  {{$_GET['keyword']}} @endif" type="text" placeholder="Nhập tên tin tuyển dụng...">
        </div>
        <div class="utf-intro-search-field-item">
          <select class="selectpicker default" name="cate_id" data-live-search="true" data-selected-text-format="count" data-size="5" title="Chọn nghành nghề">
            @foreach($cate as $c)
            <option @if(isset($_GET['keyword']))
                    @if($_GET['cate_id'] == $c->id)
                    selected
                    @endif
                    @endif
                    value="{{$c->id}}">{{$c->name}}</option>
            @endforeach

          </select>
        </div>
        <div class="utf-intro-search-field-item">
          <select class="selectpicker default" name="location_id" data-live-search="true" data-selected-text-format="count" data-size="5" title="Chọn địa điểm">
            @foreach($loca as $l)
            <option @if(isset($_GET['location_id']))
                    @if($_GET['location_id'] == $l->id)
                    selected
                    @endif
                    @endif
                    value="{{$l->id}}">{{$l->name}}</option>;
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
    <h3>Danh sách tin tuyển dụng</h3>
    <div class="sort-by">
      <input type="hidden" id="id_company" value="<?= Auth::user()->id ?>">
      <select class="selectpicker hide-tick" onchange="javascript:return sort_by();" id="sort_by">
        <option value="1">Tất cả</option>
        <option value="2">Tin còn hạn</option>
        <option value="3">Tin hết hạn</option>
        <option value="4">Tin đã duyệt</option>
        <option value="5">Tin chưa duyệt</option>
      </select>
    </div>
  </div>
  <div class="content">
    <ul class="utf-dashboard-box-list">
      @if(count($viewBlog) > 0)
      @foreach($viewBlog as $blog)
      <li>
        <div class="utf-job-listing">
          <div class="utf-job-listing-details">
            <a href="{{route('job', ['slug' => $blog->slug])}}" class="utf-job-listing-company-logo"><img src="{{asset('storage/' . $blog->image )}}" alt=""></a>
            <div class="utf-job-listing-description">
              <h3 class="utf-job-listing-title">
                <a href="{{route('job', ['slug' => $blog->slug])}}">{{$blog->title}}</a>
                @if($blog->enable == 0)
                <span class="unpaid">Chưa duyệt</span>
                @endif
                <?php
                $now = date("Y-m-d");
                if ($blog->deadline < $now) : ?>
                  <span class="unpaid">Hết hạn</span>
                <?php endif; ?>
                <?php foreach (explode(",", $blog->working_time) as $wt) : ?>
                  <span class="dashboard-status-button utf-job-status-item <?= ($wt == 'Full time') ? 'green' : 'yellow'; ?>"><i class="icon-material-outline-business-center"></i> {{$wt}}</span>
                <?php endforeach; ?>
              </h3>
              <div class="utf-job-listing-footer">
                <ul>
                  <li><i class="icon-feather-briefcase"></i>{{$blog->position}}</li>
                  <li><i style="color: #0bbdc6" class="icon-material-outline-access-time"></i>
                    <?php $seconds = strtotime($blog->deadline) - time(); ?>
                    @if($seconds > 604800)
                    {{date("d-m-Y", strtotime($blog->deadline))}}
                    @elseif($seconds < 0) {{date("d-m-Y", strtotime($blog->deadline))}} @else <script>
                      document.write(timeFor(<?= $seconds ?>));
                      </script>
                      @endif
                  </li>
                  <li><i class="icon-material-outline-account-balance-wallet"></i>
                    @if($blog->salary_min > 0 && $blog->salary_max > 0 && $blog->salary_max > $blog->salary_min)
                    {{number_format($blog->salary_min)}}đ-{{number_format($blog->salary_max)}}đ
                    @elseif($blog->salary_min == 0 && $blog->salary_max == 0)
                    Thỏa thuận
                    @elseif($blog->salary_min == 0 && $blog->salary_max > 0)
                      {{number_format($blog->salary_max)}}đ
                    @elseif($blog->salary_min > 0 && $blog->salary_max == 0)
                    {{number_format($blog->salary_min)}}đ
                    @elseif($blog->salary_min == $blog->salary_max)
                      {{number_format($blog->salary_min)}}đ
                    @endif
                  </li>
                  <li><i style="color: red" class="icon-line-awesome-unlock-alt"></i>{{$blog->exp}}</li>
                </ul>
                <div class="utf-buttons-to-right">
                  <a href="{{route('blog.edit',['id' => $blog->id])}}" class="button green ripple-effect ico" title="Sửa" data-tippy-placement="top"><i class="icon-feather-edit"></i></a>
                  <a href="{{route('blog.destroy' , ['id' => $blog->id])}}" onclick="return confirm('Bạn có chắc chắn muốn xóa')" class="button red ripple-effect ico" title="Xóa" data-tippy-placement="top"><i class="icon-feather-trash-2"></i></a>
                </div>
              </div>
              <p class="time_ago">
                <span>
                  Ngày đăng: {{date("d-m-Y", strtotime($blog->created_at))}}.
                </span>
              </p>
            </div>
          </div>
        </div>
      </li>
      @endforeach
@else
        <div class="utf-notify-box-aera margin-top-15">
          <div class="utf-switch-container-item total_job">
            <span>Không có kết quả nào hợp lệ!</span>
          </div>
        </div>
        @endif
    </ul>
  </div>

</div>

<!-- Pagination -->
<div class="clearfix"></div>
<div class="utf-pagination-container-aera margin-top-20 margin-bottom-0">
  <nav class="pagination">
    <ul>
      {{$viewBlog-> links()}}
    </ul>
  </nav>
</div>
<div class="clearfix"></div>
</div>
</div>
<script>
  function sort_by() {
    var orderby = $("#sort_by option:selected").val();
    var id_company = $('#id_company').val();
    $.ajax({
      type: 'POST',
      url: "{{route('sortby')}}",
      data: 'action=' + orderby + '&id_company=' + id_company,
      success: function(response) {
        $('.utf-dashboard-box-list').html('');
        $('.utf-dashboard-box-list').html(response);
      }
    });
  }
</script>
@endsection
