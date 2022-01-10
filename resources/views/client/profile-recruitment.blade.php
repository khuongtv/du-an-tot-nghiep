@extends('client.layout.layout')
@section('title', 'Thông tin công ty & tin tuyển dụng ' .$company_info->name)
@section('main-content')
<!-- Titlebar -->
<div class="single-page-header" data-background-image="{{asset('storage/'. $company_info->banner)}}">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="utf-single-page-header-inner-aera">
                    <div class="utf-left-side">
                        <div class="utf-header-image"><img src="{{asset('storage/' . $company_info->avatar)}}" alt=""></div>
                        <div class="utf-header-details">
                            <ul>
                                <li>{{$company_info->location->name}} <img class="flag" src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/21/Flag_of_Vietnam.svg/383px-Flag_of_Vietnam.svg.png" alt="" title="Việt Nam" data-tippy-placement="top"></li>
                            </ul>
                            <h3> {{$company_info->name}} <span class="utf-verified-badge" title="Đã xác minh!" data-tippy-placement="top"></span></h3>
                            <h4 class="text-muted"><i class="icon-material-outline-business-center"></i> {{$company_info->category->name}} </h4>
                            <h5><i class="icon-material-outline-location-on"></i> {{ $company_info->address }} </h5>
                            <h5><i class="icon-line-awesome-group"></i> {{ $company_info->company_size }} Nhân viên </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-xl-12">
            <div class="utf-account-type tab" style="display: flex; justify-content: center;">
                <div class="">
                    <input type="radio" name='company' class="tablinks utf-account-type-radio" id="company" onclick="openTab(event, 'Tab1')"></input>
                    <label for="company" title="Giới thiệu" data-tippy-placement="top" class="utf-ripple-effect-dark">
                        <i class="icon-line-awesome-info"></i> <span class="mobile">Thông tin</span></label>
                </div>

                <div class="">
                    <input type="radio" name='company' class="tablinks utf-account-type-radio" id="company1" onclick="openTab(event, 'Tab2')"></input>
                    <label for="company1" title="Tuyển dụng" data-tippy-placement="top" class="utf-ripple-effect-dark">
                        <i class="icon-material-outline-business-center"></i> <span class="mobile">Công việc</span> </label>
                </div>

                <div class="">
                    <input type="radio" name='company' class="tablinks utf-account-type-radio" id="company2" onclick="openTab(event, 'Tab3')"></input>
                    <label for="company2" title="Map" data-tippy-placement="top" class="utf-ripple-effect-dark">
                        <i class="icon-material-outline-map"></i> <span class="mobile">Map</span> </label>
                </div>

                <div class="">
                    <input type="radio" name='company' class="tablinks utf-account-type-radio" id="company3" onclick="openTab(event, 'Tab4')"></input>
                    <label for="company3" title="Liên hệ" data-tippy-placement="top" class="utf-ripple-effect-dark">
                        <i class="icon-material-outline-contact-support"></i> <span class="mobile">Liên hệ</span></label>
                </div>
            </div>
        </div>

        <!-- Tab content -->
        <div class="col-xl-12">
            <div id="Tab1" class="tabcontent utf-sidebar-container-aera">
                <div class="utf-single-page-section-aera">
                    <div class="utf-sidebar-widget-item">
                        <h3>Giới thiệu về công ty</h3>
                        <h4><strong> Mô tả ngắn: </strong></h4>
                        @if(isset($company_info->intro) && strlen($company_info->intro) >= 1)
                            {!!$company_info->intro!!}
                        @else
                            Chưa cập nhập đủ thông tin để hiển thị!
                        @endif
                        <h4> <strong> Chi tiết: </strong></h4>
                        @if(isset($company_info->detail) && strlen($company_info->detail) >= 1)
                        {!!$company_info->detail!!}
                        @else
                        Chưa cập nhập đủ thông tin để hiển thị!
                        @endif
                        <div class="job-description-image-aera">
                            <img src="{{asset('storage/' . $company_info->image)}}" alt="" />
                        </div>

                        <div class="utf-detail-social-sharing margin-top-25">
                            <span><strong>Chia sẻ lên mạng xã hội:-</strong></span>
                            <ul class="margin-top-15">
                                <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https://jobsvn.tk/cong-ty/{{$company_info->slug}}" title="Facebook" data-tippy-placement="top"><i class="icon-brand-facebook-f"></i></a>
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
                </div>
            </div>

            <div id="Tab2" class="tabcontent utf-sidebar-container-aera">
                <div class="utf-boxed-list-item margin-bottom-30">
                    <div class="utf-sidebar-widget-item">
                        <h3> Tuyển dụng</h3>
                        <div class="utf-listings-container-part compact-list-layout">

                            @foreach($blogs as $b)
                            <a href="{{route('job', ['slug' => $b->slug])}}" class="utf-job-listing">
                                <div class="utf-job-listing-details">
                                    <div class="utf-job-listing-company-logo"> <img src="{{asset('storage/' . $b->userRecruitment->avatar)}}" alt=""> </div>
                                    <div class="utf-job-listing-description">
                                        <?php foreach (explode(",", $b->working_time) as $wt) : ?>
                                            <span class="dashboard-status-button utf-job-status-item <?= ($wt == 'Full time') ? 'green' : 'yellow'; ?>"><i class="icon-material-outline-business-center"></i> {{$wt}}</span>
                                        <?php endforeach; ?>
                                        <h3 class="utf-job-listing-title">{{$b->title}}</h3>
                                        <div class="utf-job-listing-footer">
                                            <ul>
                                                <li><i class="icon-feather-briefcase"></i> {{$b->position}}</li>
                                                <li><i class="icon-material-outline-account-balance-wallet"></i> {{number_format($b->salary_max)}} VND</li>
                                                <li><i class="icon-material-outline-location-on"></i> {{$b->location->name}} </li>
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
                                @if(Auth::check() && Auth::user()->role == 0 && isset($arr))

                                <?php if (in_array($b->id, $arr)) : ?>
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
                </div>
            </div>
            <div id="Tab3" class="tabcontent">
                <div class="utf-sidebar-widget-item">
                    <h3>Địa chỉ google map</h3>
                    <div id="utf-single-job-map-container-item">
                        <div id="utf-single-job-map-container-item">
                            <iframe src="{{$company_info->map}}" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <div id="Tab4" class="tabcontent">
                <div class="utf-sidebar-widget-item">
                    <h3>Thông tin liên hệ</h3>
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-4 col-lg-4">
                                <div class="utf-boxed-list-headline-item margin-bottom-35">
                                    <h3><i class="icon-feather-map-pin"></i> Địa chỉ</h3>
                                </div>
                                <div class="utf-contact-location-info-aera margin-bottom-50">
                                    <div class="contact-address">
                                        <ul>
                                            <li><strong>Số điện thoại:-</strong> {{$company_info->phone}} </li>
                                            <li><strong>Website:-</strong> <a href="{{$company_info->link_website}}">{{$company_info->link_website}}</a></li>
                                            <li><strong>E-Mail:-</strong> <?= App\Models\User::find($company_info->id)->email?></li>
                                            <li><strong>Địa chỉ:-</strong> {{$company_info->address}} </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-8">
                                <section id="contact" class="margin-bottom-50">
                                    <div class="utf-boxed-list-headline-item margin-bottom-35">
                                        <h3><i class="icon-material-outline-description"></i> Liên hệ</h3>
                                    </div>
                                    <div class="utf-contact-form-item">
                                        <form method="post" action="{{route('contact')}}" novalidate name="contactform" id="contactform">
                                            @csrf
                                            <input type="hidden" name="emailTo" value="{{$company_info->user->email}}">
                                            <input type="hidden" name="nameRecruitment" value="{{$company_info->name}}">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="utf-no-border">
                                                        <input class="utf-with-border" name="fullname" type="text" placeholder="Họ và Tên" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="utf-no-border">
                                                        <input class="utf-with-border" name="phone" type="number" placeholder="Số điện thoại" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="utf-no-border">
                                                        <input class="utf-with-border" name="email" type="email" placeholder="Địa chỉ email" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="utf-no-border">
                                                        <input class="utf-with-border" name="title" type="text" placeholder="Tiêu đề" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <textarea class="utf-with-border" name="content" cols="40" rows="3" id="content" placeholder="Nội dung..." required></textarea>
                                            </div>
                                            <div class="utf-centered-button margin-top-10">
                                                <input type="submit" id="btn-contact" class="submit button" value="Gửi Thư" />
                                            </div>
                                        </form>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('msgSend'))
    <div class="msg_favorite">
        <script>
            alertify.success('Đã gửi thư liên hệ <i class="icon-material-outline-check-circle"></i>');
        </script>
    </div>
    @endif

</div>
@endsection

@section('script')
<script>
    function openTab(evt, cityName) {
        // Declare all variables
        var i, tabcontent, tablinks;
        // Get all elements with class="tabcontent" and hide them
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        // Get all elements with class="tablinks" and remove the class "active"
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        // Show the current tab, and add an "active" class to the button that opened the tab
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
    document.getElementById("company").click();
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
</style>
<style>
    .utf-account-type input.utf-account-type-radio:checked~label span {
        color: #fff;
    }

    .utf-account-type input.utf-account-type-radio~label:hover span {
        color: #fff;
    }

    @media screen and (max-width: 767px) {
        .mobile {
            display: none;
        }

        .single-page-header {
            margin-bottom: 24px;
        }
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>
@endsection
