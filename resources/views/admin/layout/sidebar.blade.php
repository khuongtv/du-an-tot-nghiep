<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">
            <!-- Từ khóa -->
            <li class="menu mb-1">
                <a href="#datatables" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle @yield('keyword-menu')">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers @yield('keyword-menu')">
                            <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                            <polyline points="2 17 12 22 22 17"></polyline>
                            <polyline points="2 12 12 17 22 12"></polyline>
                        </svg>
                        <span>Từ khóa</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="datatables" data-parent="#accordionExample">
                    <li>
                        <a href="{{route('keyword.index')}}">Danh sách</a>
                        <a href="{{route('keyword.add')}}">Thêm mới</a>
                    </li>
                </ul>
            </li>
            <!-- Slide quảng cáo -->
            <li class="menu">
                <a href="#forms" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle @yield('slide-menu')">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard @yield('slide-menu')">
                            <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                            <rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                        </svg>
                        <span>ADS quảng cáo</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="forms" data-parent="#accordionExample">
                    <li>
                        <a href="{{route('ads.index')}}"> Danh sách </a>
                    </li>
                    <li>
                        <a href="{{route('ads.add')}}"> Thêm mới </a>
                    </li>
                </ul>
            </li>
            <!-- Danh mục -->
            <li class="menu">
                <a href="#app" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle @yield('category-menu')">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-cpu @yield('category-menu')">
                            <rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect>
                            <rect x="9" y="9" width="6" height="6"></rect>
                            <line x1="9" y1="1" x2="9" y2="4"></line>
                            <line x1="15" y1="1" x2="15" y2="4"></line>
                            <line x1="9" y1="20" x2="9" y2="23"></line>
                            <line x1="15" y1="20" x2="15" y2="23"></line>
                            <line x1="20" y1="9" x2="23" y2="9"></line>
                            <line x1="20" y1="14" x2="23" y2="14"></line>
                            <line x1="1" y1="9" x2="4" y2="9"></line>
                            <line x1="1" y1="14" x2="4" y2="14"></line>
                        </svg>
                        <span>Danh mục</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="app" data-parent="#accordionExample">
                    <li>
                        <a href="{{route('categories.index')}}"> Danh sách </a>
                    </li>
                    <li>
                        <a href="{{route('categories.add')}}"> Thêm mới </a>
                    </li>
                </ul>
            </li>
            <!-- Tin tuyển dụng -->
            <li class="menu mb-1">
                <a href="#components" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle @yield('blog-menu')">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box @yield('blog-menu')">
                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                            </path>
                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                            <line x1="12" y1="22.08" x2="12" y2="12"></line>
                        </svg>
                        <span>Tin tuyển dụng</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="components" data-parent="#accordionExample">
                    <li class="">
                        <a href="{{route('blog.listActive')}}">DS Tin đã duyệt</a>
                    </li>
                    <li class="">
                        <a href="{{route('blog.listUnactive')}}">DS Tin chưa duyệt</a>
                    </li>
                </ul>
            </li>
            <!-- Đánh giá -->
            <li class="menu">
                <a href="#users4" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle @yield('review-menu')">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users @yield('review-menu')">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <span>Đánh giá</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="users4" data-parent="#accordionExample">
                    <li>
                        <a href="{{route('review.index')}}"> Danh sách </a>
                    </li>
                    <li>
                        <a href="{{route('review.create')}}"> Thêm mới </a>
                    </li>
                </ul>
            </li>
            <!-- Tỉnh thành phố -->
            <li class="menu">
                <a href="{{route('location.index')}}" class="justify-content-start dropdown-toggle @yield('location-menu')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-zap @yield('location-menu')">
                        <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                    </svg>
                    <span>Tỉnh thành phố</span>
                </a>
            </li>
            <!-- Quản lý giao diện -->
            @if(Auth::user()->role == 200)
            <li class="menu">
                <a href="{{route('setting.index')}}" class="justify-content-start dropdown-toggle @yield('setting-menu')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-terminal @yield('setting-menu')">
                        <polyline points="4 17 10 11 4 5"></polyline>
                        <line x1="12" y1="19" x2="20" y2="19"></line>
                    </svg>
                    <span>Cập nhật giao diện</span>
                </a>
            </li>
            @endif
            <!-- Email tự động -->
            <!-- <li class="menu">
                <a href="#" class="justify-content-start dropdown-toggle">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file">
                        <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                        <polyline points="13 2 13 9 20 9"></polyline>
                    </svg>
                    <span>Mail tự động</span>
                </a>
            </li> -->
            <!-- Quản lý tài -->
            <li class="menu">
                <a href="#users3" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle @yield('user-menu')">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users @yield('user-menu')">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                        <span>Tài khoản</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="users3" data-parent="#accordionExample">
                    @if(Auth::user()->role == 200)
                    <li>
                        <a href="{{route('users.index')}}"> Danh sách </a>
                    </li>

                    <li>
                        <a href="{{route('users.create')}}"> Thêm mới </a>
                    </li>
                    @endif

                    <li>
                        <a href="{{route('candidate.index')}}"> Tài khoản ứng viên </a>
                    </li>
                    <li>
                        <a href="{{route('recruitment.index')}}"> Tài khoản công ty </a>
                    </li>
                </ul>
            </li>
            <style>
                .actives {
                    background-color: #1B2E4B !important;
                    color: white !important;
                }
            </style>
        </ul>

    </nav>

</div>