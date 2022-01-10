@include('client.company.layout.header')
<!-- <div class="preloader">
  <div class="utf-preloader">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
  </div>
</div> -->
<div id="wrapper">
  @include('client.company.layout.navbar')
  <div class="utf-dashboard-container-aera">
    @include('client.company.layout.sidebar')

    <div class="utf-dashboard-content-container-aera" data-simplebar>
      <div id="dashboard-titlebar" class="utf-dashboard-headline-item">

        <div class="row">

          <div class="col-xl-12">
            <h3>@yield('name')</h3>
            <!-- <nav id="breadcrumbs">
              <ul>
                <li><a href="index-1.html">Home</a></li>
                <li><a href="dashboard.html">Dashboard</a></li>
                <li>Manage Resume</li>
              </ul>
            </nav> -->
          </div>
        </div>
      </div>

      <div class="utf-dashboard-content-inner-aera">

        <div class="row">
          <div class="col-xl-12">
            @yield('main-content')
            <!-- Pagination -->
            
        <!-- Row / End -->
        <div class="utf-dashboard-footer-spacer-aera"></div>
        <div class="utf-small-footer margin-top-15">
          <div class="utf-small-footer-copyrights">Copyright &copy; {{$setting->copy_right}}.</div>
        </div>
      </div>
    </div>
    <!-- Dashboard Content / End -->
  </div>
</div>


@include('client.company.layout.footer')