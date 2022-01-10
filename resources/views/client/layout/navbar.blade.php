<nav id="navigation">
  <ul id="responsive">
    <li><a href="{{route('home')}}">Trang chủ</a></li>
    <li><a href="#">Việc làm</a>
      <ul class="dropdown-nav">
        <li><a href="{{route('search')}}"><i class="icon-feather-chevron-right"></i> Tìm kiếm công việc</a>
        </li>
        @if($user && Auth::user()->role == 0)
        <li><a href="{{route('apply')}}"><i class="icon-feather-chevron-right"></i> Việc làm đã ứng tuyển</a>
        </li>
        <li><a href="{{route('favorite')}}"><i class="icon-feather-chevron-right"></i> Việc làm đã lưu</a>
        </li>
        @endif
      </ul>
    </li>
    @if($user && Auth::user()->role == 0)
    <li><a href="{{route('cv')}}">Quản lý CV</a></li>
    @endif
  </ul>
</nav>