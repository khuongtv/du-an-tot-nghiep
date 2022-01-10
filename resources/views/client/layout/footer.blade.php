  <!-- Subscribe Block Start -->
  <section class="utf_cta_area_item utf_cta_area2_block">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="utf_subscribe_block">
            <div class="col-xl-8 col-md-7">
              <div class="section-heading">
                <h2 class="utf_sec_title_item utf_sec_title_item2">Đăng ký Email!!</h2>
                <p class="utf_sec_meta">Để nhận nhưng công việc phù hợp, và thông tin mới nhất từ chúng tôi..</p>
              </div>
            </div>
            <div class="col-xl-4 col-md-5">
              <div class="contact-form-action">
                <form method="#">
                  <i class="icon-material-baseline-mail-outline"></i>
                  <input class="form-control" type="email" placeholder="Nhập vào email..." required="">
                  <button class="utf_theme_btn" type="submit">Đăng ký</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Subscribe Block End -->


  <!-- Footer -->
  <div id="footer">
    <div class="utf-footer-section-item-block">
      <div class="container">
        <div class="row">
          <div class="col-xl-4 col-md-12">
            <div class="utf-footer-item-links">
              <a href="{{route('home')}}"><img class="footer-logo" src="{{asset('storage/' . $setting->logo)}}" alt=""></a>
              <p>{{$setting->intro}}</p>
            </div>
          </div>

          <div class="col-xl-2 col-md-3 col-sm-6">
            <div class="utf-footer-item-links">
              <h3>{{$setting->name}}</h3>
              <ul>
                <li><a href="#"><i class="icon-feather-chevron-right"></i>
                    <span>Giới thiệu</span></a></li>
                <li><a href="#"><i class="icon-feather-chevron-right"></i>
                    <span>Tuyển dụng</span></a></li>
                <li><a href="#"><i class="icon-feather-chevron-right"></i>
                    <span>Liên hệ</span></a></li>
                <li><a href="#"><i class="icon-feather-chevron-right"></i>
                    <span>Hỏi đáp</span></a></li>
              </ul>
            </div>
          </div>

          <div class="col-xl-2 col-md-3 col-sm-6">
            <div class="utf-footer-item-links">
              <h3>Đối tác</h3>
              <ul>
                <li><a href="https://timviec365.com/"><i class="icon-feather-chevron-right"></i> <span>TopCV</span></a></li>
                <li><a href="https://www.topcv.vn/"><i class="icon-feather-chevron-right"></i>
                    <span>Timviec365</span></a></li>
                <li><a href="https://www.resumecoach.com/"><i class="icon-feather-chevron-right"></i>
                    <span>Create CV online</span></a></li>
              </ul>
            </div>
          </div>

          <div class="col-xl-2 col-md-3 col-sm-6">
            <div class="utf-footer-item-links">
              <h3>Cộng đồng</h3>
              <ul>
                <li><a href="https://www.facebook.com/page.kiz"><i class="icon-feather-chevron-right"></i> <span>Facebook FanPage</span></a></li>
                <li><a href="https://www.facebook.com/groups/567886291248073"><i class="icon-feather-chevron-right"></i> <span>Facebook Group</span></a></li>
                <li><a href="https://www.tiktok.com/@kien.kiz"><i class="icon-feather-chevron-right"></i> <span>Tiktok Channel</span></a></li>
                <li><a href="https://www.youtube.com"><i class="icon-feather-chevron-right"></i> <span>Youtube Channel</span></a></li>
              </ul>
            </div>
          </div>

          <div class="col-xl-2 col-md-3 col-sm-6">
            <div class="utf-footer-item-links">
              <h3>Trụ sở</h3>
              <div>
                {!!$setting->address!!}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer Copyrights -->
    <div class="utf-footer-copyright-item">
      <div class="container">
        <div class="row">
          <div class="col-xl-12">Copyright &copy; {{$setting->copy_right}}</div>
        </div>
      </div>
    </div>
    <!-- Footer Copyrights / End -->
  </div>
  <!-- Footer / End -->
  </div>
  <!-- Wrapper / End -->

  <!-- Scripts -->
  <script src="{{asset('theme/client')}}/js/jquery-3.3.1.min.js"></script>
  <script src="{{asset('theme/client')}}/js/jquery-migrate-3.0.0.min.js"></script>
  <script src="{{asset('theme/client')}}/js/mmenu.min.js"></script>
  <script src="{{asset('theme/client')}}/js/tippy.all.min.js"></script>
  <script src="{{asset('theme/client')}}/js/simplebar.min.js"></script>
  <script src="{{asset('theme/client')}}/js/bootstrap-slider.min.js"></script>
  <script src="{{asset('theme/client')}}/js/bootstrap-select.min.js"></script>
  <script src="{{asset('theme/client')}}/js/snackbar.js"></script>
  <script src="{{asset('theme/client')}}/js/clipboard.min.js"></script>
  <script src="{{asset('theme/client')}}/js/counterup.min.js"></script>
  <script src="{{asset('theme/client')}}/js/magnific-popup.min.js"></script>
  <script src="{{asset('theme/client')}}/js/slick.min.js"></script>
  <script src="{{asset('theme/client')}}/js/typed.js"></script>
  <script src="{{asset('theme/client')}}/js/custom_jquery.js"></script>

  <script>
    if ($('.utf-intro-banner-search-form-block')[0]) {
      setTimeout(function() {
        $(".pac-container").prependTo(".utf-intro-search-field-item.with-autocomplete");
      }, 300);
    }
  </script>
  <script>
    var typed = new Typed('.typed-words', {
      strings: [" Lập trình viên.", " Thiết kế đồ họa.", " Nhân viên Marketing.", " Thư ký.", " Kỹ sư."],
      typeSpeed: 80,
      backSpeed: 80,
      backDelay: 4000,
      startDelay: 1000,
      loop: true,
      showCursor: true
    });
  </script>
  </body>

  </html>