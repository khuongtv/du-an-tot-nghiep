@extends('client.layout.layout')
@section('title', 'Tìm kiếm công việc')
@section('main-content')
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

<!-- Titlebar -->
<div id="titlebar" class="gradient">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>Tìm Kiếm Công Việc</h2>
				<nav id="breadcrumbs">
					<ul>
						<li><a href="{{route('home')}}">Trang chủ</a></li>
						<li><a href="#">Tìm kiếm công việc</a></li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
</div>
<!-- Titlebar End -->

<!-- Search Jobs Start -->
<div class="inner_search_block_section padding-top-0 padding-bottom-40">
	<div class="container">
		<div class="col-md-12">
			<form method="GET" action="{{route('search')}}" class="utf-intro-banner-search-form-block margin-top-40">
				<div class="utf-intro-search-field-item">
					<i class="icon-feather-search"></i>
					<input name="keyword" id="intro-keywords" @isset($_GET['keyword']) value="{{$_GET['keyword']}}" @endisset onblur="listKeyword(2)" onfocus="listKeyword(1); filterKeyword()" onkeyup="filterKeyword()" type="text" placeholder="Tìm kiếm công việc..." autocomplete="off">
					<ul onblur="blurUl(0)" hidden id="list-keywords">
						@foreach($keywords as $k)
						<li><a onclick="get('<?= $k->keyword ?>')" href="javascript:void(0)">{{$k->keyword}}</a></li>
						@endforeach
					</ul>
				</div>
				<div class="utf-intro-search-field-item">
					<select name="location" class="selectpicker default" data-live-search="true" data-selected-text-format="count" data-size="5" title="Chọn địa điểm">
						@foreach($locations as $l)
						<option value="{{$l->id}}" @isset($_GET['location']) @if($_GET['location']==$l->id) selected @endif @endisset>{{$l->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="utf-intro-search-field-item">
					<select name="categories[]" class="selectpicker default" data-live-search="true" data-selected-text-format="count" multiple data-size="5" title="Chọn ngành nghề">
						@foreach($categories as $c)
						<option value="{{$c->id}}" @isset($_GET['categories']) @foreach($_GET['categories'] as $cateId) @if($cateId==$c->id) selected @endif @endforeach @endisset>{{$c->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="utf-intro-search-button">
					<button class="button ripple-effect" type="submit"><i class="icon-material-outline-search"></i> Tìm Kiếm</button>
				</div>
			</form>
			<p class="utf-trending-silver-item"><span class="utf-trending-black-item">Tìm kiếm hàng đầu:</span>
				@foreach($topKeywords as $t)
				<a onclick="get('<?= $t->keyword ?>')" href="#">{{$t->keyword}}</a>,
				@endforeach
			</p>
		</div>
	</div>
</div>
<!-- Search Jobs End -->

<!-- Page Content -->
<div class="container">
	<div class="row">
		<div class="col-xl-3 col-lg-4">
			<div class="utf-sidebar-container-aera">
				@if(!isset(Auth::user()->id))
				<div class="utf-sidebar-widget-item">
					<div class="utf-quote-box utf-jobs-listing-utf-quote-box">
						<div class="utf-quote-info">
							<h4>Tạo tài khoản trực tuyến!</h4>
							<p>Tạo hồ sơ của bạn trong vài phút để tiếp cận việc làm!</p>
							<a href="{{route('signup')}}" class="button utf-ripple-effect-dark utf-button-sliding-icon margin-top-0">Tạo tài khoản <i class="icon-feather-chevron-right"></i></a>
						</div>
					</div>
				</div>
				@endif

				<div class="utf-sidebar-widget-item">
					<h3>Hạn nộp hồ sơ</h3>
					<div class="utf-radio-btn-list">
						<div class="checkbox">
							<input name="deadline" value="1" class="filter_selector deadline" type="checkbox" id="checkbox-deadline">
							<label for="checkbox-deadline"><span class="checkbox-icon"></span> Còn hạn</label>
						</div>
					</div>
				</div>
				<div class="utf-sidebar-widget-item">
					<h3>Thời gian làm việc</h3>
					<div class="utf-radio-btn-list">
						@foreach(config('common.working_time') as $key => $val)
						<div class="checkbox">
							<input name="working_time" value="{{$key}}" class="filter_selector working_time" type="checkbox" id="checkbox-wt-{{$loop->iteration}}" checked>
							<label for="checkbox-wt-{{$loop->iteration}}"><span class="checkbox-icon"></span> {{$val}}</label>
						</div>
						@endforeach
					</div>
				</div>
				<div class="clearfix"></div>

				<div class="utf-sidebar-widget-item">
					<h3>Yêu cầu kinh nghiệm</h3>
					<div class="utf-radio-btn-list">
						@foreach(config('common.exp') as $key => $val)
						<div class="checkbox">
							<input name="exp" value="{{$key}}" class="filter_selector exp" type="checkbox" id="checkbox-exp-{{$loop->iteration}}">
							<label for="checkbox-exp-{{$loop->iteration}}"><span class="checkbox-icon"></span> {{$val}}</label>
						</div>
						@endforeach
					</div>
				</div>
				<div class="clearfix"></div>

				<div class="utf-sidebar-widget-item">
					<h3>Mức lương mong muốn</h3>
					<div class="margin-top-55"></div>
					<div class="margin-left-15 margin-right-15 filter_selector">
						<input class="range-slider salary" type="text" data-value="0,20000000" data-slider-currency="VND" data-slider-min="0" data-slider-max="50000000" data-slider-step="1000000" data-slider-value="[0,20000000]" />
					</div>
					<div class="utf-account-type margin-top-20">
						<div>
							<input value="50000000,1000000000" type="checkbox" name='salary' class="filter_selector salary_diff tablinks utf-account-type-radio" id="salary-50"></input>
							<label for="salary-50" title="Trên 50 triệu 1 tháng" data-tippy-placement="top" class="utf-ripple-effect-dark">
								<i class="icon-material-outline-money"></i> Trên 50 triệu</label>
						</div>
					</div>
				</div>

				<div class="utf-sidebar-widget-item">
					<h3>Chức vụ mong muốn</h3>
					<div class="utf-tags-container-item">
						@foreach(config('common.position') as $key => $val)
						<div class="tag">
							<input name="position" value="{{$key}}" class="filter_selector position" type="checkbox" id="tag-position-{{$loop->iteration}}" />
							<label for="tag-position-{{$loop->iteration}}"> {{$val}}</label>
						</div>
						@endforeach
					</div>
					<div class="clearfix"></div>
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

		<div class="col-xl-9 col-lg-8">
			<div class="utf-inner-search-section-title jobs">
				<h4><i class="icon-material-outline-search"></i> Danh sách kết quả tìm thấy!</h4>
			</div>
			<div class="utf-notify-box-aera margin-top-15">
				<div class="utf-switch-container-item total_job">
					<span>Không có kết quả nào hợp lệ!</span>
				</div>
			</div>

			<div id="data_blogs" class="utf-listings-container-part compact-list-layout margin-top-35">
			</div>
			<div id="msg_alert">
			</div>

			<!-- Pagination -->
			<div class="clearfix"></div>
			<div class="row">
				<div class="col-md-12">
					<div class="utf-pagination-container-aera margin-top-30 margin-bottom-60">
						<nav class="pagination">
							<ul id="pagination">

							</ul>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('script')
<script>
	function filterKeyword() {
		var input, filter, ul, li, a, i, txtValue;
		input = document.getElementById("intro-keywords");
		filter = input.value.toUpperCase();
		ul = document.getElementById("list-keywords");
		li = ul.getElementsByTagName("li");
		for (i = 0; i < li.length; i++) {
			a = li[i].getElementsByTagName("a")[0];
			txtValue = a.textContent || a.innerText;
			if (txtValue.toUpperCase().indexOf(filter) > -1) {
				li[i].style.display = "";
			} else {
				li[i].style.display = "none";
			}
		}
	}

	function listKeyword(key) {
		if (key === 1) {
			document.getElementById('list-keywords').hidden = false;
		} else if (key === 0) {
			document.getElementById('list-keywords').hidden = true;
		} else {
			setTimeout(function() {
				document.getElementById('list-keywords').hidden = true;
			}, 250);
		}
	}

	function get(key) {
		document.getElementById("intro-keywords").value = key;
		listKeyword(0);
	}
</script>

<script>
	function filter_data(page) {
		$('html, body').animate({
			scrollTop: $(".jobs").offset().top
		}, 1000);

		var deadline = get_filter('deadline');
		var workingTime = get_filter('working_time');
		var exp = get_filter('exp');
		var position = get_filter('position');

		var salary = $('.salary').attr('data-value');
		var salary_diff = get_filter('salary_diff');
		if (salary_diff.length > 0) {
			salary = salary_diff.join(',');
		}

		var url = new URL(window.location.href);
		var keyword = url.searchParams.get("keyword");
		var categories = url.searchParams.getAll("categories[]");
		var location = url.searchParams.get("location");
		var user = <?= $user_id ?>;
		$.ajax({
			url: '/api/danh-sach-tim-kiem-cong-viec',
			type: 'POST',
			data: {
				keyword: keyword,
				categories: categories,
				location: location,
				deadline: deadline,
				workingTime: workingTime,
				exp: exp,
				salary: salary,
				position: position,
				page: page,
				user: user
			},
			success: function(data) {
				var pagination = '';
				if (data.total_page > 5) {
					var page_left = (page - 2) >= 1 ? page - 2 : 1;
					var page_right = (page + 2) <= data.total_page ? page + 2 : data.total_page;
					if (page < 3) {
						page_left = 1;
						page_right = 5;
					}
					if (page > data.total_page - 2) {
						page_left = data.total_page - 5;
						page_right = data.total_page;
					}
				} else {
					var page_left = 1;
					var page_right = data.total_page;
				}

				for (let i = page_left; i <= page_right; i++) {
					if (i == data.page_number) {
						pagination += `
						<li class="filter_page" data-page="${i}"><a class="current-page" onclick="filter_data(${i})" href="javascript:void(0)">${i}</a></li>
						`;
					} else {
						pagination += `
						<li class="filter_page" data-page="${i}"><a onclick="filter_data(${i})" href="javascript:void(0)">${i}</a></li>
						`;
					}
				}

				var load_page = '';
				if (data.total_page == 1) {
					load_page += `
					${pagination}
					`;
				} else if (page == 1) {
					load_page += `
					${pagination}
					<li class="utf-pagination-arrow"><a onclick="filter_data(${page+1})" href="javascript:void(0)"><i class="icon-material-outline-keyboard-arrow-right"></i></a></li>
					`;
				} else if (page == data.total_page) {
					load_page += `
					<li class="utf-pagination-arrow"><a onclick="filter_data(${page-1})" href="javascript:void(0)"><i class="icon-material-outline-keyboard-arrow-left"></i></a></li>
					${pagination}
					`;
				} else {
					load_page += `
					<li class="utf-pagination-arrow"><a onclick="filter_data(${page-1})" href="javascript:void(0)"><i class="icon-material-outline-keyboard-arrow-left"></i></a></li>
					${pagination}
					<li class="utf-pagination-arrow"><a onclick="filter_data(${page+1})" href="javascript:void(0)"><i class="icon-material-outline-keyboard-arrow-right"></i></a></li>
					`;
				}

				if (data.total_job == 0) {
					$('.total_job').html(`<span>Không có kết quả nào hợp lệ!</span>`)
				} else {
					$('.total_job').html(`<span>Tìm thấy <b>${data.total_job}</b> kết quả! Hiển thị trong <b>${data.total_page}</b> trang</span>`)
				}
				if (data.total_job == 0) {
					$('#pagination').html('');
				} else {
					$('#pagination').html(load_page);
				}
				$('#data_blogs').html(data.job);
			}
		});
	}
	filter_data(1);

	function get_filter(className) {
		var filter = [];
		$("." + className + ":checked").each(function() {
			filter.push($(this).val());
		});
		return filter;
	}

	$('.filter_selector').click(function() {
		filter_data(1);
	});

	function get(key) {
		document.getElementById("intro-keywords").value = key;
		listKeyword(0);
	}
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
	#list-keywords {
		max-height: 250px;
		border-radius: 5px;
		overflow: auto;
		z-index: 9;
		position: absolute;
		top: 100%;
		width: 100%;
		background-color: white;
	}

	#list-keywords li {
		list-style: none;
		padding: 5px 0;
	}

	.time_ago {
		position: absolute;
		right: 5px;
		bottom: 5px;
		font-size: 0.7rem;
	}
</style>
@endsection
