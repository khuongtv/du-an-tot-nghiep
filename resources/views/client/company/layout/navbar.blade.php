  <!-- Preloader Start -->
  <div class="preloader">
    <div class="utf-preloader">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <!-- Preloader End -->

  <header id="utf-header-container-block" class="fullwidth dashboard-header not-sticky">
    <div id="header">
      <div class="container">
        <div class="utf-left-side">
          <div id="logo"> <a href="{{route('home')}}"><img src="{{asset('storage/' . $setting->logo)}}" alt=""></a> </div>

          <div class="clearfix"></div>
        </div>

        <div class="utf-right-side">
          <div class="utf-header-widget-item hide-on-mobile">
            <div class="utf-header-notifications">

              <div class="utf-header-notifications-dropdown-block">
                <div class="utf-header-notifications-headline">
                  <h4>View All Notifications</h4>
                </div>
                <div class="utf-header-notifications-content">
                  <div class="utf-header-notifications-scroll" data-simplebar>
                    <ul>
                      <li class="notifications-not-read"><a href="dashboard-manage-resume.html"> <span class="notification-icon"><i class="icon-material-outline-group"></i></span> <span class="notification-text"> <strong>John Williams</strong> Applied for Jobs <span class="color_blue">Full Time</span> <strong>Web Designer</strong></span></a></li>
                      <li><a href="dashboard-manage-resume.html"><span class="notification-icon"><i class="icon-feather-briefcase"></i></span> <span class="notification-text"> <strong>John Williams</strong> Applied for Jobs <span class="color_green">Internship</span> <strong>Web Designer</strong></span></a></li>
                      <li><a href="dashboard-manage-resume.html"><span class="notification-icon"><i class="icon-feather-briefcase"></i></span> <span class="notification-text"> <strong>John Williams</strong> Applied for Jobs <span class="color_yellow">Part Time</span> <strong>Web Designer</strong></span></a></li>
                      <li><a href="dashboard-manage-resume.html"><span class="notification-icon"><i class="icon-material-outline-group"></i></span> <span class="notification-text"> <strong>John Williams</strong> Applied for Jobs <span class="color_blue">Full Time</span> <strong>Web Designer</strong></span></a></li>
                      <li><a href="dashboard-manage-resume.html"><span class="notification-icon"><i class="icon-material-outline-group"></i></span> <span class="notification-text"> <strong>John Williams</strong> Applied for Jobs <span class="color_yellow">Part Time</span> <strong>Web Designer</strong></span></a></li>
                    </ul>
                  </div>
                </div>
                <a href="javascript:void(0);" class="utf-header-notifications-button ripple-effect utf-button-sliding-icon">See All Notifications<i class="icon-feather-chevron-right"></i></a>
              </div>
            </div>
          </div>

          <div class="utf-header-widget-item">
            <div class="utf-header-notifications user-menu">
              <div class="utf-header-notifications-trigger user-profile-title">
                <a href="#"> <?php $fullname = \App\Models\UserRecruitment::find(Auth::user()->id)->name;
                              $avatars = \App\Models\UserRecruitment::find(Auth::user()->id)->avatar;

                              ?>
                  <div class="user-avatar status-online"><img src="{{asset('storage/' . $avatars)}}" alt=""> </div>
                  <div class="user-name">Hi, {{$fullname}}!</div>
                </a>
              </div>
              <div class="utf-header-notifications-dropdown-block">
                  <ul class="utf-user-menu-dropdown-nav">
                    <li><a href="{{route('company', ['slug' => $user->slug])}}"><i class="icon-feather-user"></i> Công ty của bạn</a></li>
                    <li><a href="{{route('change_password')}}"><i class="icon-line-awesome-key"></i> Đổi mật khẩu </a></li>
                    <li><a href="{{route('logout')}}"><i class="icon-material-outline-power-settings-new"></i> Đăng xuất</a></li>
                  </ul>
                </div>
            </div>
          </div>

          <span class="mmenu-trigger">
            <button class="hamburger utf-hamburger-collapse-item" type="button"> <span class="utf-hamburger-box-item"> <span class="utf-hamburger-inner-item"></span> </span> </button>
          </span>
        </div>
      </div>
    </div>
  </header>
  <div class="clearfix"></div>
  <!-- Header Container / End -->