@extends('client.layout.layout')
@section('title', 'Trang chủ')
@section('main-content')

<!-- Intro Banner  -->

@if(isset($ads))
<?php $banner = $ads->image ?>
@else
<?php $banner = 'images/websites/banner_home.jpg' ?>
@endif
<div class="intro-banner" data-background-image="{{asset('storage/' . $banner)}}">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="utf-banner-headline-text-part">
          <h3>Tìm kiếm công việc ngay <span class="typed-words"></span></h3>
          <span>Hãy tìm ngay cho bạn 1 công việc phù hợp nhất.</span>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <form method="GET" action="{{route('search')}}" class="utf-intro-banner-search-form-block margin-top-40">
          <div class="utf-intro-search-field-item">
            <i class="icon-feather-search"></i>
            <input name="keyword" id="intro-keywords" @isset($_GET['keyword']) value="{{$_GET['keyword']}}" @endisset onblur="listKeyword(2)" onfocus="listKeyword(1); filterKeyword()" onkeyup="filterKeyword()" type="text" placeholder="Tìm kiếm công việc..." autocomplete="off">
            <ul onblur="blurUl(0)" hidden id="list-keywords">
              @foreach($keywords as $k)
              <li><a onclick="get('<?= $k->keyword ?>')" href="javascript:void(0)">{{$k->keyword}}</a></li>
              @endforeach
            </ul>
          </div>
          <div class="utf-intro-search-field-item">
            <select name="location" class="selectpicker default" data-live-search="true" data-selected-text-format="count" data-size="5" title="Chọn địa điểm">
              @foreach($locations as $l)
              <option value="{{$l->id}}">{{$l->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="utf-intro-search-field-item">
            <select name="categories[]" class="selectpicker default" data-live-search="true" data-selected-text-format="count" multiple data-size="5" title="Chọn ngành nghề">
              @foreach($categories as $c)
              <option value="{{$c->id}}">{{$c->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="utf-intro-search-button">
            <button class="button ripple-effect" type="submit"><i class="icon-material-outline-search"></i> Tìm Kiếm</button>
          </div>
        </form>
        <p class="utf-trending-silver-item"><span class="utf-trending-black-item">Tìm kiếm hàng đầu:</span>
          @foreach($topKeywords as $t)
          <a onclick="get('<?= $t->keyword ?>')" href="#">{{$t->keyword}}</a>
          @endforeach
        </p>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <ul class="intro-stats margin-top-45 hide-under-992px">
          <li><i class="icon-material-outline-business-center"></i> <sub class="counter_item"><strong class="counter">{{$arrData['job_enable']}}</strong> <span>Công việc khả dụng</span></sub> </li>
          <li><i class="icon-material-outline-assignment"></i> <sub class="counter_item"><strong class="counter">{{$arrData['candidate']}}</strong> <span>Ứng viên</span></sub> </li>
          <li><i class="icon-material-outline-library-books"></i> <sub class="counter_item"><strong class="counter">{{$arrData['recruitment']}}</strong> <span>Nhà tuyển dụng</span></sub> </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- Latest Jobs -->
<div class="section gray padding-top-60 padding-bottom-60">
  <div class="container">
    <div class="row">
      <div class="col-xl-12">
        <div class="utf-section-headline-item centered margin-top-0 margin-bottom-40">
          <span>Công việc phù hợp với bạn</span>
          <h3>Công việc bạn có thể quan tâm</h3>
          <div class="utf-headline-display-inner-item">Công việc phù hợp</div>
          <p class="utf-slogan-text">Hãy lướt xem 1 vài công việc mà chúng tôi liệt kê phía dưới cho bạn.</p>
        </div>
        <div class="utf-listings-container-part compact-list-layout margin-top-35">
          @foreach($blogs['care'] as $b)
          <a href="{{route('job', ['slug' => $b->slug])}}" class="utf-job-listing utf-apply-button-item">
            <div class="utf-job-listing-details">
              <div class="utf-job-listing-company-logo">
                <img src="{{asset('storage/' . $b->userRecruitment->avatar)}}" title="{{$b->userRecruitment->name}}" data-tippy-placement="top" alt="">
              </div>
              <div class="utf-job-listing-description">
                <?php foreach (explode(",", $b->working_time) as $wt) : ?>
                  <span class="dashboard-status-button utf-job-status-item <?= ($wt == 'Full time') ? 'green' : 'yellow'; ?>"><i class="icon-material-outline-business-center"></i> {{$wt}}</span>
                <?php endforeach; ?>
                <h3 class="utf-job-listing-title">{{$b->title}}
                  @if($b->userRecruitment->verification)
                  <span class="utf-verified-badge" title="Đã xác minh!" data-tippy-placement="top"></span>
                  @endif
                </h3>
                <div class="utf-job-listing-footer">
                  <ul>
                    <li><i class="icon-feather-briefcase"></i> {{$b->position}}</li>
                    <li><i class="icon-material-outline-account-balance-wallet"></i> {{number_format($b->salary_max)}} VND</li>
                    <li><i class="icon-material-outline-location-on"></i> {{$b->location->name}}</li>
                    <?php $seconds = strtotime($b->deadline) - time(); ?>
                    @if($seconds > 604800)
                    <li><i class="icon-material-outline-access-time"></i>
                      {{date("d-m-Y", strtotime($b->deadline))}}
                    </li>
                    @else
                    <li><i class="icon-material-outline-access-time"></i>
                      <span>
                        <script>
                          document.write(timeFor(<?= $seconds ?>));
                        </script>
                      </span>
                    </li>
                    @endif
                  </ul>
                </div>
              </div>
              <span class="list-apply-button ripple-effect">Xem công việc <i class="icon-material-outline-keyboard-arrow-right"></i></span>
            </div>
          </a>
          @endforeach
        </div>
        <div class="utf-centered-button margin-top-10">
          <a href="{{route('search')}}" class="button utf-ripple-effect-dark utf-button-sliding-icon margin-top-20">Xem tất cả công việc <i class="icon-feather-chevron-right"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Latest Jobs / End -->

<!-- Latest Jobs -->
<div class="section gray padding-top-0 padding-bottom-60">
  <div class="container">
    <div class="row">
      <div class="col-xl-6">
        <div class="utf-section-headline-item centered margin-top-40 margin-bottom-40">
          <span>Công việc mới nhất</span>
        </div>
        <div class="utf-listings-container-part compact-list-layout margin-top-35">
          @foreach($blogs['new'] as $b)
          <a href="{{route('job', ['slug' => $b->slug])}}" class="utf-job-listing utf-apply-button-item">
            <div class="utf-job-listing-details">
              <div class="utf-job-listing-company-logo">
                <img src="{{asset('storage/' . $b->userRecruitment->avatar)}}" title="{{$b->userRecruitment->name}}" data-tippy-placement="top" alt="">
              </div>
              <div class="utf-job-listing-description">
                <?php foreach (explode(",", $b->working_time) as $wt) : ?>
                  <span class="dashboard-status-button utf-job-status-item <?= ($wt == 'Full time') ? 'green' : 'yellow'; ?>"><i class="icon-material-outline-business-center"></i> {{$wt}}</span>
                <?php endforeach; ?>
                <h3 class="utf-job-listing-title">{{$b->title}}
                  @if($b->userRecruitment->verification)
                  <span class="utf-verified-badge" title="Đã xác minh!" data-tippy-placement="top"></span>
                  @endif
                </h3>
                <div class="utf-job-listing-footer">
                  <ul>
                    <li><i class="icon-feather-briefcase"></i> {{$b->position}}</li>
                    <li><i class="icon-material-outline-account-balance-wallet"></i> {{number_format($b->salary_max)}} VND</li>
                    <li><i class="icon-material-outline-location-on"></i> {{$b->location->name}}</li>
                    <?php $seconds = strtotime($b->deadline) - time(); ?>
                    @if($seconds > 604800)
                    <li><i class="icon-material-outline-access-time"></i>
                      {{date("d-m-Y", strtotime($b->deadline))}}
                    </li>
                    @else
                    <li><i class="icon-material-outline-access-time"></i>
                      <span>
                        <script>
                          document.write(timeFor(<?= $seconds ?>));
                        </script>
                      </span>
                    </li>
                    @endif
                  </ul>
                </div>
                <?php $seconds = time() - strtotime($b->created_at) ?>
                <p class="time_ago">
                  <span>
                    <script>
                      document.write(timeSince(<?= $seconds ?>));
                    </script>
                  </span>
                </p>
              </div>
            </div>
            @if(Auth:: check() && Auth::user()->role == 0 && isset($arrFavorite))

            <?php if (in_array($b->id, $arrFavorite)) : ?>
              <span class="bookmark-icon bookmarked" data-user-id="{{Auth::user()->id}}" data-id="{{$b->id}}"></span>
            <?php else : ?>
              <span class="bookmark-icon" data-user-id="{{Auth::user()->id}}" data-id="{{$b->id}}"></span>
            <?php endif ?>

            @endif
          </a>
          @endforeach
        </div>
      </div>
      <div id="msg_alert">
      </div>

      @isset($blogs['favorite'])
      <div class="col-xl-6">
        <div class="utf-section-headline-item centered margin-top-40 margin-bottom-40">
          <span>Công việc được yêu thích nhất</span>
        </div>
        <div class="utf-listings-container-part compact-list-layout margin-top-35">
          @foreach($blogs['favorite'] as $b)
          <a href="{{route('job', ['slug' => $b->slug])}}" class="utf-job-listing utf-apply-button-item">
            <div class="utf-job-listing-details">
              <div class="utf-job-listing-company-logo">
                <img src="{{asset('storage/' . $b->userRecruitment->avatar)}}" title="{{$b->userRecruitment->name}}" data-tippy-placement="top" alt="">
              </div>
              <div class="utf-job-listing-description">
                <?php foreach (explode(",", $b->working_time) as $wt) : ?>
                  <span class="dashboard-status-button utf-job-status-item <?= ($wt == 'Full time') ? 'green' : 'yellow'; ?>"><i class="icon-material-outline-business-center"></i> {{$wt}}</span>
                <?php endforeach; ?>
                <h3 class="utf-job-listing-title">{{$b->title}}
                  @if($b->userRecruitment->verification)
                  <span class="utf-verified-badge" title="Đã xác minh!" data-tippy-placement="top"></span>
                  @endif
                </h3>
                <div class="utf-job-listing-footer">
                  <ul>
                    <li><i class="icon-feather-briefcase"></i> {{$b->position}}</li>
                    <li><i class="icon-material-outline-account-balance-wallet"></i> {{number_format($b->salary_max)}} VND</li>
                    <li><i class="icon-material-outline-location-on"></i> {{$b->location->name}}</li>
                    <?php $seconds = strtotime($b->deadline) - time(); ?>
                    @if($seconds > 604800)
                    <li><i class="icon-material-outline-access-time"></i>
                      {{date("d-m-Y", strtotime($b->deadline))}}
                    </li>
                    @else
                    <li><i class="icon-material-outline-access-time"></i>
                      <span>
                        <script>
                          document.write(timeFor(<?= $seconds ?>));
                        </script>
                      </span>
                    </li>
                    @endif
                  </ul>
                </div>
                <?php $seconds = time() - strtotime($b->created_at) ?>
                <p class="time_ago">
                  <span>
                    <script>
                      document.write(timeSince(<?= $seconds ?>));
                    </script>
                  </span>
                </p>
              </div>
            </div>
            @if(Auth:: check() && Auth::user()->role == 0 && isset($arrFavorite))

            <?php if (in_array($b->id, $arrFavorite)) : ?>
              <span class="bookmark-icon bookmarked" data-user-id="{{Auth::user()->id}}" data-id="{{$b->id}}"></span>
            <?php else : ?>
              <span class="bookmark-icon" data-user-id="{{Auth::user()->id}}" data-id="{{$b->id}}"></span>
            <?php endif ?>

            @endif
          </a>
          @endforeach
        </div>
      </div>
      @endisset
    </div>
  </div>
</div>
<!-- Latest Jobs / End -->

<!-- Testimonials -->
<div class="section gray padding-top-65 padding-bottom-65">
  <div class="container">
    <div class="row">
      <div class="col-xl-12">
        <div class="utf-section-headline-item centered margin-top-0 margin-bottom-30">
          <span>Các KOL nói gì về chúng tôi</span>
          <h3>REVIEW</h3>
          <div class="utf-headline-display-inner-item">Các KOL nói gì về chúng tôi</div>
          <p class="utf-slogan-text">Một số chia sẻ từ người nổi tiếng với website của chúng tôi.</p>
        </div>
      </div>
    </div>
  </div>
  <!-- Categories Carousel -->
  <div class="utf-carousel-container-block">
    <div class="utf-testimonial-carousel-block testimonials">
      @foreach($reviewers as $r)
      <div class="utf-carousel-review-item">
        <div class="utf-testimonial-box">
          <div class="utf-testimonial-avatar-photo"> <img src="{{asset('storage/' . $r->avatar)}}" alt=""> </div>
          <div class="utf-testimonial-author-utf-detail-item">
            <h4>{{$r->name}}</h4>
            <span>{{$r->work}}</span>
          </div>
          <div class="testimonial">{{$r->content}}</div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>
<!-- Testimonials / End -->

<!-- Start Need Any Help -->
<section class="section padding-top-65 padding-bottom-75">
  <div class="container">
    <div class="col-xl-12">
      <div class="utf-section-headline-item centered margin-top-0 margin-bottom-40">
        <span>Dịch Vụ Hỗ Trợ Trực Tuyến</span>
        <h3>Bạn Cần Sự Trợ Giúp?</h3>
        <div class="utf-headline-display-inner-item">Dịch Vụ Hỗ Trợ Trực Tuyến</div>
        <p class="utf-slogan-text">Hãy liên hệ với chúng tôi nếu bạn cần sự trợ giúp. Chúng tôi luôn săn sàng phục
          vụ bạn!</p>
      </div>
    </div>
    <div class="row need-help-area justify-content-center">
      <div class="col-xl-4">
        <div class="info-box-1">
          <div class="utf-icon-box-circle">
            <div class="utf-icon-box-circle-inner"> <i class="icon-brand-rocketchat"></i></div>
          </div>
          <h4>Trò chuyện với chúng tôi</h4>
          <p>Trò chuyện với chúng tôi trực tuyến nếu bạn có bất kỳ câu hỏi nào.</p>
          <a href="javascript:void(0);" class="button utf-ripple-effect-dark utf-button-sliding-icon margin-top-10">Chat
            ngay <i class="icon-feather-chevrons-right"></i></a>
        </div>
      </div>
      <div class="col-xl-4">
        <div class="info-box-1">
          <div class="utf-icon-box-circle">
            <div class="utf-icon-box-circle-inner"> <i class="icon-feather-phone"></i></div>
          </div>
          <h4>Gọi cho chúng tôi</h4>
          <p>Hãy gọi cho chúng tôi nếu bạn gặp khó khăn. Các nhân viên sẽ giúp đỡ bạn!</p>
          <a href="javascript:void(0);" class="button utf-ripple-effect-dark utf-button-sliding-icon margin-top-10">Liên hệ
            ngay <i class="icon-feather-chevrons-right"></i></a>
        </div>
      </div>
      <div class="col-xl-4">
        <div class="info-box-1">
          <div class="utf-icon-box-circle">
            <div class="utf-icon-box-circle-inner"> <i class="icon-brand-bimobject"></i></div>
          </div>
          <h4>Góp ý với chúng tôi</h4>
          <p>Hãy góp ý cho chúng tôi nếu bạn không hài lòng về trải nghiệm trên Website.</p>
          <a href="javascript:void(0);" class="button utf-ripple-effect-dark utf-button-sliding-icon margin-top-10">Góp ý ngay <i class="icon-feather-chevrons-right"></i></a>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- End Need Any Help -->

<!-- Counters -->
<div class="section gradient_item_area padding-top-70 padding-bottom-75">
  <div class="container">
    <div class="row">
      <div class="col-xl-12">
        <div class="utf-section-headline-item centered margin-top-0 margin-bottom-40">
          <span>Thành tích của chúng tôi</span>
          <h3>Thông số</h3>
          <div class="utf-headline-display-inner-item">Thành tích của chúng tôi</div>
          <p class="utf-slogan-text">Thành tích mà chúng tôi đã đạt được trong thời gian qua là nhờ sự ủng hộ của
            các bạn. Cảm ơn tất cả!</p>
        </div>
      </div>
      <div class="col-xl-12 counter_inner_block">
        <div class="utf-counters-container-aera">
          <div class="col-xl-3">
            <div class="utf-single-counter"> <i class="icon-feather-briefcase"></i>
              <div class="utf-counter-inner-item">
                <h3><span class="counter">{{$arrData['job']}}</span></h3>
                <span class="utf-counter-title">Công việc</span>
              </div>
            </div>
          </div>
          <div class="col-xl-3">
            <div class="utf-single-counter"> <i class="icon-feather-users"></i>
              <div class="utf-counter-inner-item">
                <h3><span class="counter">{{$arrData['member']}}</span></h3>
                <span class="utf-counter-title">Thành viên</span>
              </div>
            </div>
          </div>
          <div class="col-xl-3">
            <div class="utf-single-counter"> <i class="icon-material-outline-textsms"></i>
              <div class="utf-counter-inner-item">
                <h3><span class="counter">{{$arrData['user_active']}}</span></h3>
                <span class="utf-counter-title">Đang hoạt động</span>
              </div>
            </div>
          </div>
          <div class="col-xl-3">
            <div class="utf-single-counter"> <i class="icon-material-outline-location-city"></i>
              <div class="utf-counter-inner-item">
                <h3><span class="counter">{{$arrData['company']}}</span></h3>
                <span class="utf-counter-title">Công ty uy tín</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Counters / End -->

@endsection

@section('script')
<script>
  function filterKeyword() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("intro-keywords");
    filter = input.value.toUpperCase();
    ul = document.getElementById("list-keywords");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
      a = li[i].getElementsByTagName("a")[0];
      txtValue = a.textContent || a.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        li[i].style.display = "";
      } else {
        li[i].style.display = "none";
      }
    }
  }

  function listKeyword(key) {
    if (key === 1) {
      document.getElementById('list-keywords').hidden = false;
    } else if (key === 0) {
      document.getElementById('list-keywords').hidden = true;
    } else {
      setTimeout(function() {
        document.getElementById('list-keywords').hidden = true;
      }, 250);
    }
  }

  function get(key) {
    document.getElementById("intro-keywords").value = key;
    listKeyword(0);
  }
</script>

<script>
  $('.bookmark-icon').on('click', function() {
    var blog_id = $(this).data('id');
    var user_id = $(this).data('user-id');
    $.ajax({
      type: 'POST',
      url: '<?= asset('/') ?>' + 'api/yeu-thich',
      data: 'blog_id=' + blog_id + '&user_id=' + user_id,
      success: function(data) {
        $('#msg_alert').html(data);
      }
    })
    // $('.alert').removeClass('nones');
    setTimeout(function() {
      $(".msg_favorite").addClass('nones');
    }, 4000);
  })
</script>
@endsection

@section('style')
<script>
  function timeSince(seconds) {
    if (!seconds || seconds < 10) {
      return "vài giây trước.";
    }

    var interval = seconds / 31536000;

    if (interval > 1) {
      return Math.floor(interval) + " năm trước.";
    }
    interval = seconds / 2592000;
    if (interval > 1) {
      return Math.floor(interval) + " tháng trước.";
    }
    interval = seconds / (60 * 60 * 24 * 7);
    if (interval > 1) {
      return Math.floor(interval) + " tuần trước.";
    }
    interval = seconds / 86400;
    if (interval > 1) {
      return Math.floor(interval) + " ngày trước.";
    }
    interval = seconds / 3600;
    if (interval > 1) {
      return Math.floor(interval) + " giờ trước.";
    }
    interval = seconds / 60;
    if (interval > 1) {
      return Math.floor(interval) + " phút trước.";
    }
    return Math.floor(seconds) + " giây trước.";
  }

  function timeFor(seconds) {
    if (!seconds || seconds < 0) {
      return "Đã hết hạn.";
    }

    var interval = seconds / 86400;
    if (interval < 1) {
      return "Sắp hết hạn.";
    }

    return "Còn " + Math.floor(interval) + " ngày.";
  }
</script>
<style>
  #list-keywords {
    max-height: 250px;
    border-radius: 5px;
    overflow: auto;
    z-index: 9;
    position: absolute;
    top: 100%;
    width: 100%;
    background-color: white;
  }

  #list-keywords li {
    list-style: none;
    padding: 5px 0;
  }

  .time_ago {
    position: absolute;
    right: 5px;
    bottom: 5px;
    font-size: 0.7rem;
  }
</style>
@endsection