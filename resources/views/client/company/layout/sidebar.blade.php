<div class="utf-dashboard-sidebar-item">
        <div class="utf-dashboard-sidebar-item-inner" data-simplebar>
          <div class="utf-dashboard-nav-container">
            <!-- Responsive Navigation Trigger -->
            <a href="#" class="utf-dashboard-responsive-trigger-item"> <span
                class="hamburger utf-hamburger-collapse-item"> <span class="utf-hamburger-box-item"> <span
                    class="utf-hamburger-inner-item"></span> </span> </span> <span class="trigger-title">Bảng điều khiển</span> </a>
            <!-- Navigation -->
            <div class="utf-dashboard-nav">
              <div class="utf-dashboard-nav-inner">
                <div class="dashboard-profile-box">
                  <span class="avatar-img"> 
                    <?php $fullname = \App\Models\UserRecruitment::find(Auth::user()->id)->name;
                          $avatars = \App\Models\UserRecruitment::find(Auth::user()->id)->avatar;
                          $fullname2 = \App\Models\UserRecruitment::find(Auth::user()->id); 
                          $cate = \App\Models\Category::find($fullname2['cate_id']); 
                    ?>
                    <img alt="" src="{{asset('storage/' . $avatars)}}" class="photo">
                  </span>
                  <div class="user-profile-text">
                   
                    <span class="fullname">{{$fullname}}</span>
                    <span class="user-role">{{$cate->name}}</span>
                  </div>
                </div>
                <div class="clearfix"></div>
                <ul>
                <li><a href="{{route('statistical.index')}}"><i class="icon-material-outline-dashboard"></i>Thống kê</a></li>
                  <li><a href="{{route('userCompany.edit', ['id' => Auth::user()->id])}}"><i class="icon-material-outline-account-balance"></i>Công ty</a></li>
                  
                  <li><a href="{{route('apply.index')}}"><i class="icon-material-outline-assignment"></i> Quản lý đơn ứng tuyển</a></li>
                  <li><a href="{{route('candidatesearch.index')}}"><i class="icon-material-outline-search"></i> Tìm kiếm ứng viên</a></li>   
                  <li><a href="{{route('blog.index')}}"><i class="icon-material-outline-business-center"></i> Quản lý tin tuyển dụng</a>
                    <ul class="dropdown-nav">
                    <li><a href="{{route('blog.index')}}"><i class="icon-line-awesome-table"></i> Danh sách tin tuyển dụng</a></li>
                      <li><a href="{{route('blog.add')}}"><i class="icon-line-awesome-plus"></i> Thêm tin tuyển dụng</a></li>
                    </ul>
                </li>                                               
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Dashboard Sidebar / End -->