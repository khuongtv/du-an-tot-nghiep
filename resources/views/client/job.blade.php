@extends('client.layout.layout')
@section('title', 'Công việc ' . $job->title)
@section('main-content')

<!-- Titlebar -->
<div class="single-page-header" data-background-image="images/single-job.jpg">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="utf-single-page-header-inner-aera">
          <div class="utf-left-side">
            <div class="utf-header-image"><a href="{{route('company', ['slug' => $job->userRecruitment->slug])}}">
                <img src="{{asset('storage/' . $job->userRecruitment->avatar)}}" title="{{$job->userRecruitment->name}}" data-tippy-placement="top" alt="">
              </a></div>
            <div class="utf-header-details">
              <?php foreach (explode(",", $job->working_time) as $wt) : ?>
                <span class="dashboard-status-button utf-job-status-item <?= ($wt == 'Full time') ? 'green' : 'yellow'; ?>"><i class="icon-material-outline-business-center"></i> {{$wt}}</span>
              <?php endforeach; ?>
              <ul>
                <li><a href="{{route('company', ['slug' => $job->userRecruitment->slug])}}">{{$job->userRecruitment->name}}</a>
                  @if($job->userRecruitment->verification)
                  <span class="utf-verified-badge" title="Đã xác minh!" data-tippy-placement="top"></span>
                  @endif
                  <img class="flag" src="images/flags/af.svg" alt="" title="Afghanistan" data-tippy-placement="top">
                </li>
              </ul>
              <h3>{{$job->title}}</h3>
              <h5><i class="icon-material-outline-business-center"></i> {{$job->position}}</h5>
            </div>
          </div>
          <div class="utf-right-side">
            <div class="salary-box">
              @if((strtotime($job->deadline) - time()) > 0)
              @if(Auth:: check() && Auth::user()->role == 0)
              <a href="#small-dialog" class="apply-now-button popup-with-zoom-anim margin-top-0">Ứng tuyển ngay <i class="icon-feather-chevron-right"></i></a>
              <a href="javascript:void(0)" data-user-id="{{Auth::user()->id}}" data-id="{{$job->id}}" class="job-favorite button save-job-btn margin-top-20">Lưu / Hủy lưu Công việc <i class="icon-feather-chevron-right"></i></a>
              @else
              <a href="{{route('login')}}" class="button utf-ripple-effect-dark utf-button-sliding-icon margin-top-0">Đăng nhập tư cách ứng viên <i class="icon-feather-chevron-right"></i></a>
              @endif
              @else
              <a href="#" class="button utf-ripple-effect-dark utf-button-sliding-icon margin-top-0">Đã hết hạn nộp hồ sơ<i class="icon-feather-chevron-right"></i></a>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Page Content -->
<div class="container">
  @if(session('alert_suc'))
  <script>
    alertify.success('<?= session("alert_suc")  ?>');
  </script>
  @endif

  @if(session('alert_err'))
  <script>
    alertify.error('<?= session("alert_err")  ?>');
  </script>
  @endif

  <div class="row">
    <div class="col-xl-8 col-lg-8 utf-content-right-offset-aera">
      <div class="utf-single-page-section-aera">
        <div class="utf-boxed-list-headline-item">
          <h3><i class="icon-material-outline-description"></i> Chi tiết công việc</h3>
        </div>
        <div class="utf-sidebar-widget-item">
          {!!$job->detail!!}
          <div class="job-description-image-aera">
            <img src="{{asset('storage/' . $job->image)}}" alt="" />
          </div>
        </div>
        <div class="row">
          @if((strtotime($job->deadline) - time()) > 0)
          @if(Auth:: check() && Auth::user()->role == 0)
          <div class="col-xl-6 col-lg-6 col-sm-12">
            <a href="{{route('apply_fast', ['user_id' => Auth::user()->id, 'blog_id' => $job->id])}}" class="margin-top-5 button save-job-btn">Ứng tuyển siêu tốc <i class="icon-feather-chevron-right"></i></a>
          </div>
          <div class="col-xl-6 col-lg-6 col-sm-12">
            <a href="#" class="margin-top-5 button save-job-btn">Công ty <i class="icon-feather-chevron-right"></i></a>
          </div>
          @else
          <div class="col-xl-6 col-lg-6 col-sm-12">
            <a href="{{route('signup')}}" class="margin-top-5 button margin-top-0 text-center" style="width: 100%;">Hãy tạo tài khoản ứng viên <i class="icon-feather-chevron-right"></i></a>
          </div>
          <div class="col-xl-6 col-lg-6 col-sm-12">
            <a href="{{route('login')}}" class="margin-top-5 button margin-top-0 text-center" style="width: 100%;">Đăng nhập ngay <i class="icon-feather-chevron-right"></i></a>
          </div>
          @endif
          @else
          <div class="col-xl-12 col-lg-12 col-sm-12">
            <a href="#" class="margin-top-5 button margin-top-0 text-center" style="width: 100%;">Đã hết hạn nộp hồ sơ, quay lại sau!</a>
          </div>
          @endif

        </div>
        <div class="utf-detail-social-sharing margin-top-25">
          <span><strong>Chia sẻ lên mạng xã hội:-</strong></span>
          <ul class="margin-top-15">
            <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https://jobsvn.tk/cong-viec/{{$job->slug}}" title="Facebook" data-tippy-placement="top"><i class="icon-brand-facebook-f"></i></a>
            </li>
            <li><a href="#" title="Twitter" data-tippy-placement="top"><i class="icon-brand-twitter"></i></a></li>
            <li><a href="#" title="LinkedIn" data-tippy-placement="top"><i class="icon-brand-linkedin-in"></i></a>
            </li>
            <li><a href="#" title="Google Plus" data-tippy-placement="top"><i class="icon-brand-google"></i></a>
            </li>
            <li><a href="#" title="Whatsapp" data-tippy-placement="top"><i class="icon-brand-whatsapp"></i></a></li>
            <li><a href="#" title="Pinterest" data-tippy-placement="top"><i class="icon-brand-pinterest-p"></i></a>
            </li>
          </ul>
        </div>
      </div>

      <div class="utf-single-page-section-aera">
        <div class="utf-boxed-list-headline-item">
          <h3><i class="icon-material-outline-location-on"></i> Vị trí doanh nghiệp</h3>
        </div>
        <div id="utf-single-job-map-container-item">
          <iframe src="{{$job->userRecruitment->map}}" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
      </div>
    </div>

    <!-- Sidebar -->
    <div class="col-xl-4 col-lg-4">
      <div class="utf-sidebar-container-aera">
        <div class="utf-sidebar-widget-item">
          <div class="utf-job-overview">
            <div class="utf-job-overview-headline">Thông tin vị trí công việc</div>
            <div class="utf-job-overview-inner">
              <ul>
                <li>
                  <i class="icon-material-outline-business-center"></i> <span>Vị trí:</span>
                  <h5>{{$job->position}}</h5>
                </li>
                <li>
                  <i class="icon-material-outline-account-circle"></i> <span>Giới tính</span>
                  <h5>@if($job->gender == 1)
                    Nam
                    @elseif($job->gender == 2)
                    Nữ
                    @else
                    Tất cả
                    @endif
                  </h5>
                </li>
                <li>
                  <i class="icon-line-awesome-glass"></i> <span>Kinh nghiệm</span>
                  <h5>{{$job->exp}}</h5>
                </li>
                <li>
                  <i class="icon-material-outline-location-on"></i> <span>Địa điểm làm việc</span>
                  <h5>{{$job->userRecruitment->address}}</h5>
                </li>
                <li>
                  <i class="icon-material-outline-business-center"></i> <span>Thời gian làm việc</span>
                  <h5>{{$job->working_time}}</h5>
                </li>
                <li>
                  <i class="icon-line-awesome-gg-circle"></i> <span>Số lượng tuyển</span>
                  <h5>{{$job->quantity}} người</h5>
                </li>
                <li>
                  <i class="icon-material-outline-access-time"></i> <span>Hạn ứng tuyển</span>
                  <h5>{{date("d-m-Y", strtotime($job->deadline))}}</h5>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="utf-sidebar-widget-item">
          <h3>Mức lương</h3>
          <div class="utf-right-side">
            <div class="salary-box">
              @if($job->salary_min > 0 && $job->salary_max > 0 && $job->salary_max > $job->salary_min)
              <div class="salary-amount">Từ: {{number_format($job->salary_min)}} VND  <br> Đến: {{number_format($job->salary_max)}} VND</div>
              @elseif($job->salary_min == 0 && $job->salary_max == 0)
                <div class="salary-amount"> Thỏa Thuận </div>
                @elseif($job->salary_min == 0 && $job->salary_max > 0)
                <div class="salary-amount">{{number_format($job->salary_max)}} VND </div>
              @elseif($job->salary_min > 0 && $job->salary_max == 0)
                <div class="salary-amount">{{number_format($job->salary_min)}} VND </div>
                @elseif($job->salary_min == $job->salary_max)
                    <div class="salary-amount">{{number_format($job->salary_min)}} VND </div>
              @endif
            </div>
          </div>
        </div>
        @if(isset($ads))
        <div class="utf-sidebar-widget-item">
          <div class="utf-detail-banner-add-section">
            <a target="_blank" href="{{$ads->link}}"><img src="{{asset('storage/' . $ads->image)}}" alt="{{$ads->alt}}" /></a>
          </div>
        </div>
        @endif
      </div>
    </div>
    <!-- End side bar-->

    <div class="col-xl-8 col-lg-8 utf-content-right-offset-aera">
      <div class="utf-single-page-section-aera">
        <div class="utf-boxed-list-item margin-bottom-60">
          <div class="utf-boxed-list-headline-item">
            <h3><i class="icon-material-outline-business-center"></i> Công việc khác của công ty</h3>
          </div>
          <div class="utf-listings-container-part compact-list-layout">
            @foreach($blogs as $b)
            <a href="{{route('job', ['slug' => $b->slug])}}" class="utf-job-listing">
              <div class="utf-job-listing-details">
                <div class="utf-job-listing-company-logo">
                  <img src="{{asset('storage/' . $b->userRecruitment->avatar)}}" title="{{$b->userRecruitment->name}}" data-tippy-placement="top" alt="">
                </div>
                <div class="utf-job-listing-description">
                  <?php foreach (explode(",", $b->working_time) as $wt) : ?>
                    <span class="dashboard-status-button utf-job-status-item <?= ($wt == 'Full time') ? 'green' : 'yellow'; ?>"><i class="icon-material-outline-business-center"></i> {{$wt}}</span>
                  <?php endforeach; ?>
                  <h3 class="utf-job-listing-title">{{$b->title}}
                    @if($b->userRecruitment->verification == 1)
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
                @if(Auth:: check() && Auth::user()->role == 0 && isset($arrFavorite))
                <?php if (in_array($b->id, $arrFavorite)) : ?>
                  <span class="bookmark-icon job-favorite bookmarked" data-user-id="{{Auth::user()->id}}" data-id="{{$b->id}}"></span>
                <?php else : ?>
                  <span class="bookmark-icon job-favorite" data-user-id="{{Auth::user()->id}}" data-id="{{$b->id}}"></span>
                <?php endif ?>
                @endif
              </div>
            </a>
            @endforeach
          </div>
          <div class="utf-centered-button margin-top-10"> <a href="{{route('search')}}" class="button utf-button-sliding-icon">Xem thêm công việc <i class="icon-feather-chevron-right"></i></a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-4 col-lg-4">
      <div class="utf-sidebar-container-aera">
        @if(!isset(Auth::user()->id))
        <div class="utf-sidebar-widget-item">
          <div class="utf-quote-box">
            <div class="utf-quote-info">
              <h4>Tạo tài khoản trực tuyến!</h4>
              <p>Tạo hồ sơ của bạn trong vài phút để tiếp cận việc làm!</p>
              <a href="{{route('signup')}}" class="button utf-ripple-effect-dark utf-button-sliding-icon margin-top-0">Tạo tài khoản <i class="icon-feather-chevron-right"></i></a>
            </div>
          </div>
        </div>
        @endif
        <div class="utf-sidebar-widget-item">
          <h3>Liên hệ</h3>
          <form method="post" action="{{route('contact')}}" novalidate name="contactform" id="contactform">
            @csrf
            <input type="hidden" name="emailTo" value="{{$company_info->user->email}}">
            <input type="hidden" name="nameRecruitment" value="{{$company_info->name}}">
            <div class="row">
              <div class="col-md-12">
                <div class="utf-no-border">
                  <input class="utf-with-border" name="fullname" type="text" placeholder="Họ và Tên" required />
                </div>
              </div>
              <div class="col-md-12">
                <div class="utf-no-border">
                  <input class="utf-with-border" name="phone" type="number" placeholder="Số điện thoại" required />
                </div>
              </div>
              <div class="col-md-12">
                <div class="utf-no-border">
                  <input class="utf-with-border" name="email" type="email" placeholder="Địa chỉ email" required />
                </div>
              </div>
              <div class="col-md-12">
                <div class="utf-no-border">
                  <input class="utf-with-border" name="title" type="text" placeholder="Tiêu đề" required />
                </div>
              </div>
              <div class="col-md-12">
                <div class="utf-no-border">
                  <textarea class="utf-with-border" name="content" cols="40" rows="3" id="content" placeholder="Nội dung..." required></textarea>
                </div>
              </div>
              <div class="utf-centered-button margin-top-10">
                <input type="submit" id="btn-contact" class="submit button" value="Gửi Thư" />
              </div>
          </form>
          @if(session('msgSend'))
          <div class="msg_favorite">
            <script>
              alertify.success('Đã gửi thư liên hệ <i class="icon-material-outline-check-circle"></i>');
            </script>
          </div>
          @endif
        </div>
        @if(isset($ads))
        <div class="utf-sidebar-widget-item margin-top-20">
          <div class="utf-detail-banner-add-section">
            <a target="_blank" href="{{$ads->link}}"><img src="{{asset('storage/' . $ads->image)}}" alt="{{$ads->alt}}" /></a>
          </div>
        </div>
        @endif
      </div>
    </div>


    <div id="msg_alert">
    </div>
  </div>
</div>

<!-- Apply for a job popup -->
@isset($user)
<div id="small-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs">
  <div class="utf-signin-form-part">
    <ul class="utf-popup-tabs-nav-item">
      <li class="modal-title">Đơn ứng tuyển</li>
    </ul>
    <div class="utf-popup-container-part-tabs">
      <div class="utf-popup-tab-content-item" id="tab">
        <form method="post" id="apply-now-form" enctype="multipart/form-data">
          @csrf
          <input type="hidden" value="{{Auth::user()->id}}" name="user_candidate_id" />
          <input type="hidden" value="{{$job->id}}" name="blog_id" />
          <div class="utf-no-border">
            <input value="{{$user->name}}" type="text" class="utf-with-border" name="name_candidate" id="name" placeholder="Họ và tên *" />
          </div>
          <div class="utf-no-border">
            <input value="{{$user->phone_number}}" type="text" class="utf-with-border" name="phone_candidate" id="phonenumber" placeholder="Số điện thoại *"  />
          </div>
          <div class="utf-no-border">
            <input value="{{Auth::user()->email}}" type="text" class="utf-with-border" name="email_candidate" id="email" placeholder="Email *"  />
          </div>
          <div class="utf-no-border">
            <textarea cols="30" rows="2" class="utf-with-border" placeholder="Nội dung..." name="message"></textarea>
          </div>
          <div class="uploadButton">
            <input class="uploadButton-input" type="file" id="upload-cv" name="file" />
            <label class="uploadButton-button ripple-effect" for="upload-cv">Tải lên hồ sơ</label>
            <span class="uploadButton-file-name">Hồ sơ hợp lệ (Docx, Doc, PDF)</span>
          </div>
        </form>
        <button class="button margin-top-35 full-width utf-button-sliding-icon ripple-effect" type="submit" form="apply-now-form">Ứng tuyển <i class="icon-feather-chevron-right"></i></button>
        <p class="margin-top-15">Bạn có thể nộp đơn cho công việc này bằng cách sử dụng thông tin trực tuyến đã có của bạn. Nhấp vào liên kết bên dưới để gửi hồ sơ trực tuyến của bạn cho nhà tuyển dụng này.</p>
        <a href="{{route('apply_fast', ['user_id' => Auth::user()->id, 'blog_id' => $job->id])}}" class="button utf-ripple-effect-dark utf-button-sliding-icon margin-top-10">Ứng tuyển siêu tốc
          <i class="icon-feather-chevron-right"></i></a>
      </div>
    </div>
  </div>
</div>
@endisset
<!-- Apply for a job popup / End -->


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
  .time_ago {
    position: absolute;
    right: 5px;
    bottom: 5px;
    font-size: 0.7rem;
  }

  .error {
    color: red;
    font-size: 14px;
  }
  #upload-cv-error{
      position: absolute;
      bottom: 250px;
  }
</style>
<style>
  @import url('https://fonts.googleapis.com/css?family=Quicksand&display=swap');

  h3 {
    font-family: Quicksand;
  }
  .utf-sidebar-widget-item input {
    margin-bottom: 13px !important;
  }

  .alert1 {
    width: 100%;
    margin: 20px auto;
    padding: 20px;
    position: relative;
    border-radius: 5px;
    box-shadow: 0 0 15px 5px #ccc;
  }

  .close {
    position: absolute;
    width: 30px;
    height: 30px;
    opacity: 0.5;
    border-width: 1px;
    border-style: solid;
    border-radius: 50%;
    right: 15px;
    top: 18px;
    text-align: center;
    font-size: 1.6em;
    cursor: pointer;
  }

  .success-1 {
    background-color: #a8f0c6;
    border-left: 5px solid green;
  }

  .success-alert .close {
    border-color: green;
    color: green !important;
  }

  .danger-alert {
    background-color: #f7a7a3;
    border-left: 5px solid red;
  }

  .danger-alert .close {
    border-color: red;
    color: red !important;
  }

  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }
</style>
@endsection

@section('script')
<script>
  $('.job-favorite').on('click', function() {
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
<script>
  function hiddenAlert() {
    document.getElementById('alert-apply').hidden = true;
  }
</script>

<script>
  $("#contactform").validate({
    rules: {
      fullname: "required",
      phone: {
        required: true,
        minlength: 9
      },
      email: {
        required: true,
        email: true
      },
      title: "required",
      content: "required"
    },
    messages: {
      fullname: "Vui lòng nhập họ tên",
      phone: {
        required: "Vui lòng nhập số điện thoại",
        minlength: "Nhập tối thiểu 9 ký tự"
      },
      email: {
        required: "Vui lòng nhập email",
        email: "Nhập đúng định dạng email"
      },
      title: "Vui lòng nhập tiêu đề",
      content: "Vui lòng nhập nội dung"
    }
  });
</script>
<script>
        $("#apply-now-form").validate({
            rules: {
                name_candidate: "required",
                phone_candidate: {
                    required: true,
                    minlength: 9
                },
                email_candidate: {
                    required: true,
                    email: true
                },
                file: "required",
            },
            messages: {
                name_candidate: "Vui lòng nhập họ tên",
                phone_candidate: {
                    required: "Vui lòng nhập số điện thoại",
                    minlength: "Nhập tối thiểu 9 ký tự"
                },
                email_candidate: {
                    required: "Vui lòng nhập email",
                    email: "Nhập đúng định dạng email"
                },
                file: "Vui lòng tải lên hồ sơ",

            }
        });
</script>
@endsection
