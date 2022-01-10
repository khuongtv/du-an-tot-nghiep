@include('client.layout.header')

<body>
  <!-- Wrapper -->
  <div id="wrapper">
    <!-- Header Container -->
    <header id="utf-header-container-block">
      @if(Auth::check() && Auth::user()->confirmed == 0)
      <div class="verify">
        <p>Tài khoản của bạn chưa được xác thực. Vui lòng xác thực tại email {{Auth::user()->email}} để sử dụng tối đa nhưng tính năng của JobS</p>
      </div>
      @endif
      <div id="header">
        <div class="container">
          <div class="utf-left-side">
            <div id="logo"> <a href="{{route('home')}}"><img src="{{asset('storage/' . $setting->logo)}}" alt=""></a> </div>
            @include('client.layout.navbar')
            <div class="clearfix"></div>
          </div>

          <div class="utf-right-side">
            @if(!$user)
            <div class="utf-header-widget-item">
              <a href="{{route('login')}}" class="log-in-button">
                <i class="icon-feather-log-in"></i>
                <span>Đăng nhập</span>
              </a>
            </div>
            @else
            <div class="utf-header-widget-item">
              <div class="utf-header-notifications user-menu">
                <div class="utf-header-notifications-trigger user-profile-title">
                  <a href="#">
                    <div class="user-avatar status-online">
                      @isset($user->avatar)
                      <img src="{{asset('storage/' . $user->avatar)}}" alt="">
                      @endisset
                    </div>
                    <div class="user-name">
                      {{$user->name}}
                    </div>
                  </a>
                </div>
                @if(Auth::user()->role > 100)
                <div class="utf-header-notifications-dropdown-block">
                  <ul class="utf-user-menu-dropdown-nav">
                    <li><a href="{{route('dashboard')}}"><i class="icon-feather-arrow-right-circle"></i> Trang quản trị</a></li>
                    <li><a href="{{route('change_password')}}"><i class="icon-line-awesome-key"></i> Đổi mật khẩu </a></li>
                    <li><a href="{{route('logout')}}"><i class="icon-material-outline-power-settings-new"></i> Đăng xuất</a></li>
                  </ul>
                </div>
                @elseif(Auth::user()->role == 0)
                <div class="utf-header-notifications-dropdown-block">
                  <ul class="utf-user-menu-dropdown-nav">
                    <li><a href="{{route('candidate', ['id' => Auth::user()->id])}}"><i class="icon-feather-user"></i> Trang cá nhân</a></li>
                    <li><a href="{{route('update.candidate')}}"><i class="icon-material-outline-dashboard"></i>Cập nhật thông tin </a></li>
                    <li><a href="{{route('cv')}}"><i class="icon-material-outline-person-pin"></i>Quản lý CV </a></li>
                    <li><a href="{{route('favorite')}}"><i class="icon-material-outline-favorite-border"></i> Công việc đã lưu</a></li>
                    <li><a href="{{route('apply')}}"><i class="icon-line-awesome-level-up"></i> Công việc đã ứng tuyển</a></li>
                    <li><a href="{{route('change_password')}}"><i class="icon-line-awesome-key"></i> Đổi mật khẩu </a></li>
                    <li><a href="{{route('logout')}}"><i class="icon-material-outline-power-settings-new"></i> Đăng xuất</a></li>
                  </ul>
                </div>
                @elseif(Auth::user()->role == 50)
                <div class="utf-header-notifications-dropdown-block">
                  <ul class="utf-user-menu-dropdown-nav">
                    <li><a href="{{route('statistical.index')}}"><i class="icon-feather-arrow-right-circle"></i> Nhà tuyển dụng</a></li>
                    <li><a href="{{route('company', ['slug' => $user->slug])}}"><i class="icon-feather-user"></i> Công ty của bạn</a></li>
                    <li><a href="{{route('change_password')}}"><i class="icon-line-awesome-key"></i> Đổi mật khẩu </a></li>
                    <li><a href="{{route('logout')}}"><i class="icon-material-outline-power-settings-new"></i> Đăng xuất</a></li>
                  </ul>
                </div>
                @endif

              </div>
            </div>
            @endif
            <span class="mmenu-trigger">
              <button class="hamburger utf-hamburger-collapse-item" type="button"> <span class="utf-hamburger-box-item">
                  <span class="utf-hamburger-inner-item"></span> </span> </button>
            </span>
          </div>
        </div>
      </div>
    </header>
    <div class="clearfix"></div>
    <!-- Header Container / End -->

    @yield('main-content')

    @yield('script')

    @include('client.layout.footer')
