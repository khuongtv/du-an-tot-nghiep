@extends('client.layout.layout')
@section('title', 'Công việc đã lưu')
@section('main-content')
<div id="titlebar" class="gradient">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Danh sách công việc yêu thích</h2>
                <nav id="breadcrumbs">
                    <ul>
                        <li><a href="{{route('home')}}">Trang Chủ</a></li>
                        <li>Công việc yêu thích</li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- Titlebar End -->

<!-- Page Content -->
<div class="container">
    <div class="row">
        <div class="col-xl-8 col-lg-9">

            <div class="utf-notify-box-aera">
                <div class="utf-switch-container-item">
                    <span>Đã yêu thích <strong>{{$count}}</strong> công việc</span>
                </div>
            </div>

            <div class="utf-listings-container-part compact-list-layout margin-top-35">
                @foreach($blog_data as $b)
                <a href="{{route('job', ['slug' => $b->slug])}}" class="utf-job-listing">
                    <div class="utf-job-listing-details">
                        <div class="utf-job-listing-company-logo"> <img src="{{asset('storage/'. $b->image)}}" alt="">
                        </div>
                        <div class="utf-job-listing-description">
                            <?php foreach (explode(",", $b->working_time) as $wt) : ?>
                                <span class="dashboard-status-button utf-job-status-item <?= ($wt == 'Full time') ? 'green' : 'yellow'; ?>"><i class="icon-material-outline-business-center"></i> {{$wt}}</span>
                            <?php endforeach; ?>
                            <h3 class="utf-job-listing-title"> {{$b->title}} <span class="utf-verified-badge" title="Verified Employer" data-tippy-placement="top"></span></h3>
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
                        <span class="bookmark-icon bookmarked" data-user-id="{{Auth::user()->id}}" data-id="{{$b->id}}"></span>
                    </div>
                </a>
                @endforeach
            </div>

            <div id="msg_alert">
            </div>
        </div>

        @if(isset($ads))
        <div class="col-xl-4 col-lg-3">
            <div class="utf-sidebar-container-aera">
                <a target="_blank" href="{{$ads->link}}"><img style="border-radius: 3px;" width="100%" src="{{asset('storage/' . $ads->image)}}" alt="{{$ads->alt}}" /></a>
            </div>
        </div>
        @endif
    </div>
</div>

@endsection

@section('script')

<script>
    $('.bookmark-icon').on('click', function() {
        var blog_id = $(this).data('id');
        var user_id = $(this).data('user-id');
        $.ajax({
            type: 'POST',
            url: '<?= asset('/') ?>' + 'api/yeu-thich',
            data: 'blog_id=' + blog_id + '&user_id=' + user_id,
            success: function(data) {
                //   $('#msg_alert').html(data);
                location.reload();

            }
        })
        // $('.alert').removeClass('nones');
        //   setTimeout(function() {

        //     $(".msg_favorite").addClass('nones');
        //   }, 4000);
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
    .time_ago {
        position: absolute;
        right: 5px;
        bottom: 5px;
        font-size: 0.7rem;
    }
</style>
@endsection
