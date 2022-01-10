<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\Apply;
use App\Models\ApplyDetail;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\Keyword;
use App\Models\Location;
use App\Models\Reviewer;
use App\Models\User;
use App\Models\UserCandidate;
use App\Models\UserFile;
use App\Models\UserRecruitment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->role === 0) {
                $userCandidate = UserCandidate::find(Auth::user()->id);
            }
        }

        $categories = Category::where('enable', 1)->get();
        $locations = Location::all();
        $keywords = Keyword::all();
        $reviewers = Reviewer::all();
        $ads = Ads::where('role', 200)->latest('id')->first();

        if (isset($userCandidate)) {
            $blogs['care'] = Blog::where('location_id', $userCandidate->location_id)->where('cate_id', $userCandidate->cate_id)->where('enable', 1)->limit(10)->get();
        } else {
            $blogs['care'] = Blog::where('enable', 1)->limit(10)->get();
        }

        $arrFavorite = [];
        if (isset($userCandidate)) {
            $favorites = Favorite::where('user_candidate_id', $userCandidate->id)->get();
            foreach ($favorites as $key => $f) {
                $arrFavorite[$key] = $f->blog_id;
            }
        }

        $blogs['new'] = Blog::where('enable', 1)->orderByDesc('id')->limit(5)->get();
        $desc_favorites = DB::table('favorites')->select('blog_id', DB::raw('count(*) as total'))->groupBy('blog_id')->orderByDesc('total')->limit(10)->get();
        if ($desc_favorites) {
            $arrBlogId = [];
            foreach ($desc_favorites as $key => $value) {
                $arrBlogId[$key] = $value->blog_id;
            }
            $blogs['favorite'] = Blog::where('enable', 1)->whereIn('id', $arrBlogId)->limit(5)->get();
        }

        $topKeywords = Keyword::orderBy('search', 'desc')->limit(5)->get();

        $arrData['member'] = User::count();
        $arrData['job'] = Blog::count();
        $arrData['job_enable'] = Blog::where('enable', 1)->count();
        $arrData['user_active'] = User::where('active', 1)->count();
        $arrData['recruitment'] = UserRecruitment::count();
        $arrData['candidate'] = UserCandidate::count();
        $arrData['company'] = UserRecruitment::where('verification', 1)->count();

        return view('client.index', compact('categories', 'locations', 'keywords', 'topKeywords', 'blogs', 'arrData', 'arrFavorite', 'ads', 'reviewers'));
    }

    public function profile($id)
    {
        $profile = UserCandidate::find($id);
        if (!$profile) {
            return redirect()->route('404');
        }
        $userFile = UserFile::where('user_id', $id)->first();
        $profile->load('location', 'category', 'user');
        return view('client.profile', compact('profile', 'userFile'));
    }

    public function search(Request $request)
    {
        $categories = Category::where('enable', 1)->get();
        $locations = Location::all();
        $keywords = Keyword::all();
        $topKeywords = Keyword::orderBy('search', 'desc')->limit(5)->get();
        $now = date('Y-m-d');
        $ads = Ads::where('role', '<', 200)
            ->where('to_time', '>', $now)
            ->get()->random(1)->first();

        return view('client.search', compact('categories', 'locations', 'keywords', 'topKeywords', 'ads'));
    }

    public function listBlog(Request $request)
    {
        $keyword = $request->keyword ? $request->keyword : NULL;
        $arrCateId = $request->categories ? implode(",", $request->categories) : NULL;
        $locationId = $request->location ? $request->location : NULL;
        $arrKeyword = explode(" ", $keyword);

        $deadline = $request->deadline ? $request->deadline : NULL;
        $arrWorkingTime = $request->workingTime ? $request->workingTime : NULL;
        $arrExp = $request->exp ? $request->exp : NULL;
        $arrSalary = $request->salary ? explode(",", $request->salary) : NULL;
        $arrPosition = $request->position ? $request->position : NULL;
        $page_number = $request->page ? $request->page : 1;

        $update_search_keyword = Keyword::where('keyword', 'LIKE', $keyword)->first();

        if ($update_search_keyword) {
            Keyword::where('keyword', $keyword)->update(['search' => $update_search_keyword->search + 1]);
        }

        $sql = ") AND (enable = 1";

        if ($deadline) {
            $sql .= ") AND (CURRENT_DATE() - deadline < 0";
        }

        if ($arrKeyword) {
            foreach ($arrKeyword as $key) {
                $sql .= ") AND (title LIKE " . "'%" . $key . "%'";
            }
        }

        if ($locationId) {
            $sql .= ") AND (blogs.location_id = " . $locationId;
        }

        if ($arrCateId) {
            $sql .= ") AND (blogs.cate_id IN (" . $arrCateId . ")";
        }

        if ($arrWorkingTime) {
            $check = true;
            foreach ($arrWorkingTime as $value) {
                if ($check) {
                    $sql .= ") AND (working_time LIKE " . "'%" . $value . "%'";
                } else {
                    $sql .= " OR working_time LIKE " . "'%" . $value . "%'";
                }
                $check = false;
            };
        }

        if ($arrExp) {
            $check = true;
            foreach ($arrExp as $value) {
                if ($check) {
                    $sql .= ") AND (exp = " . "'" . $value . "'";
                } else {
                    $sql .= " OR exp = " . "'" . $value . "'";
                }
                $check = false;
            };
        }

        if ($arrSalary) {
            $sql .= ") AND (salary_min BETWEEN " . $arrSalary[0] . " AND " . $arrSalary[1] . " OR salary_max BETWEEN " . $arrSalary[0] . " AND " . $arrSalary[1];
        }

        if ($arrPosition) {
            $check = true;
            foreach ($arrPosition as $value) {
                if ($check) {
                    $sql .= ") AND (position LIKE " . "'%" . $value . "%'";
                } else {
                    $sql .= " OR position LIKE " . "'%" . $value . "%'";
                }
                $check = false;
            };
        }

        $from = ($page_number - 1) * 10;

        $sql_job = "SELECT blogs.*, user_recruitment.name as company_name, user_recruitment.verification as company_verification, user_recruitment.slug as company_slug, user_recruitment.avatar as company_logo, locations.name as location_name FROM blogs LEFT OUTER JOIN user_recruitment ON user_recruitment.id = blogs.user_recruitment_id LEFT OUTER JOIN locations ON locations.id = blogs.location_id WHERE (1" . $sql . ") ORDER BY `deadline` DESC LIMIT " . $from . ", 10";

        $sql_count = "SELECT COUNT(blogs.id) FROM blogs LEFT OUTER JOIN user_recruitment ON user_recruitment.id = blogs.user_recruitment_id LEFT OUTER JOIN locations ON locations.id = blogs.location_id WHERE (1" . $sql . ")";

        $count_blogs = DB::select($sql_count);

        $data_blogs = DB::select($sql_job);

        $html['total_job'] = get_object_vars($count_blogs[0])['COUNT(blogs.id)'];
        $html['total_page'] = ceil($html['total_job'] / 10);
        $html['page_number'] = $page_number;

        if ($request->user) {
            $user_id_login = $request->user;
            $favorites = Favorite::where('user_candidate_id', $user_id_login)->get();
        } else {
            $favorites = [];
            $user_id_login = 0;
        }
        $arrFavorite = [];
        if ($favorites) {
            foreach ($favorites as $key => $f) {
                $arrFavorite[$key] = $f->blog_id;
            }
        }

        $html['job'] = "";
        foreach ($data_blogs as $b) {
            $verify = $b->company_verification ? '' : 'hidden';
            $woking_time = '';
            $time_ago = $this->timeSince(time() - strtotime($b->created_at));
            if (strtotime($b->deadline) - time() > 604800) {
                $deadline = date("d-m-Y", strtotime($b->deadline));
            } else {
                $deadline = $this->timeFor(strtotime($b->deadline) - time());
            }
            if (in_array($b->id, $arrFavorite)) {
                $class_favorite = 'bookmarked';
            } else {
                $class_favorite = '';
            }
            $hidden = $user_id_login ? '' : 'hidden';
            foreach (explode(",", $b->working_time) as $wt) {
                $color = $wt == 'Full time' ? 'green' : 'yellow';
                $woking_time .= /*html*/ '
                <span class="dashboard-status-button utf-job-status-item ' . $color . '"><i class="icon-material-outline-business-center"></i> ' . $wt . '</span>
                ';
            };

            $html['job'] .=  /*html*/ '
            <a href="' . route('job', ['slug' => $b->slug]) . '" class="utf-job-listing">
					<div class="utf-job-listing-details">
						<div class="utf-job-listing-company-logo">
                        <img src="' . asset('/') . 'storage/' . $b->company_logo . '" title="' . $b->company_name . '" data-tippy-placement="top" alt="">
						</div>
						<div class="utf-job-listing-description">
							' . $woking_time . '
							<h3 class="utf-job-listing-title">' . $b->title  . '
								<span ' . $verify . ' class="utf-verified-badge" title="Đã xác minh!" data-tippy-placement="top"></span>
							</h3>
							<div class="utf-job-listing-footer">
								<ul>
                                    <li><i class="icon-feather-briefcase"></i> ' . $b->position . '</li>
                                    <li><i class="icon-material-outline-account-balance-wallet"></i> ' . number_format($b->salary_max) . ' VND</li>
                                    <li><i class="icon-material-outline-location-on"></i> ' . $b->location_name . '</li>
									<li><i class="icon-material-outline-access-time"></i> ' . $deadline . '
									</li>
								</ul>
							</div>
							<p class="time_ago">
                            <span>
                                ' . $time_ago . '
                            </span>
                            </p>
						</div>
						<span ' . $hidden . ' class="bookmark-icon ' . $class_favorite . '" data-user-id="' . $user_id_login . '" data-id="' . $b->id . '"></span>
					</div>
				</a>
            ';
        }

        $html['job'] .= /*html*/ "
        <script>
        $('.bookmark-icon').on('click', function (e) {
            e.preventDefault();
            $(this).toggleClass('bookmarked');
            var blog_id = $(this).data('id');
            var user_id = $(this).data('user-id');
            $.ajax({
                type: 'POST',
                url: '" . asset('/') . "api/yeu-thich',
                data: 'blog_id=' + blog_id + '&user_id=' + user_id,
                success: function(data) {
                    $('#msg_alert').html(data);
                }
            })
            setTimeout(function() {
                $('.msg_favorite').addClass('nones');
            }, 4000);
        });
        </script>
        ";

        return $html;
    }

    public function timeSince($seconds)
    {
        if (!$seconds || $seconds < 10) {
            return "vài giây trước.";
        }

        $interval = $seconds / 31536000;

        if ($interval > 1) {
            return floor($interval) . " năm trước.";
        }
        $interval = $seconds / 2592000;
        if ($interval > 1) {
            return floor($interval) . " tháng trước.";
        }
        $interval = $seconds / (60 * 60 * 24 * 7);
        if ($interval > 1) {
            return floor($interval) . " tuần trước.";
        }
        $interval = $seconds / 86400;
        if ($interval > 1) {
            return floor($interval) . " ngày trước.";
        }
        $interval = $seconds / 3600;
        if ($interval > 1) {
            return floor($interval) . " giờ trước.";
        }
        $interval = $seconds / 60;
        if ($interval > 1) {
            return floor($interval) . " phút trước.";
        }
        return floor($seconds) . " giây trước.";
    }

    public function timeFor($seconds)
    {
        if ($seconds > (24 * 60 * 60 * 7)) {
            return date("d-m-Y", $seconds);
        }
        if (!$seconds || $seconds < 0) {
            return "Đã hết hạn.";
        }

        $interval = $seconds / 86400;
        if ($interval < 1) {
            return "Sắp hết hạn.";
        }

        return "Còn " . floor($interval) . " ngày.";
    }

    public function job(Request $request)
    {
        if (isset(Auth::user()->id)) {
            $user = UserCandidate::find(Auth::user()->id);
        }

        $slug = $request->slug;
        $job = Blog::where('slug', $slug)->where('enable', 1)->first();

        if (!$job) {
            return redirect()->route('404');
        }
        $job->load('userRecruitment', 'category');

        $company_info = UserRecruitment::where('slug', $job->userRecruitment->slug)->first();
        $company_info->load('user');

        $blogs = Blog::where('user_recruitment_id', $job->user_recruitment_id)->where('id', '!=', $job->id)->where('enable','=', 1)->orderByDesc('id')->limit(10)->get();

        $blogs->load('userRecruitment', 'category', 'location');
        $now = date('Y-m-d');
        $ads = Ads::where('role', '<', 200)
            ->where('to_time', '>', $now)
            ->get()->random(1)->first();

        if (!isset($user)) {
            return view('client.job', compact('job', 'blogs', 'ads', 'company_info'));
        }

        $arrFavorite = [];
        $favorites = Favorite::where('user_candidate_id', $user->id)->get();
        foreach ($favorites as $key => $f) {
            $arrFavorite[$key] = $f->blog_id;
        }

        return view('client.job', compact('job', 'blogs', 'user', 'arrFavorite', 'ads', 'company_info'));
    }

    public function postJob(Request $request)
    {
        $user = UserCandidate::find($request->user_candidate_id);
        $job = Blog::find($request->blog_id);
        $file = UserFile::where('user_id', $request->user_candidate_id)->get();
        $arrFile = [];
        foreach ($file as $key => $f) {
            $arrFile[$key] = $f->file;
        }
        $model = Apply::where('blog_id', $request->blog_id)->where('user_candidate_id', $request->user_candidate_id)->first();
        if (!$user || !$job) {
            return redirect()->route('404');
        }

        $validator = Validator::make(
            $request->all(),
            [
                'name_candidate' => 'required',
                'phone_candidate' => 'required|min:10|numeric',
                'email_candidate' => 'required|min:10|email',
                'file' => 'required|mimes:docx,doc,pdf'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->with('alert_err', 'Thất bại. Hãy nhập lại dữ liệu');
        }

        if (!$model) {
            $model = new Apply();
            $apply_detail = new ApplyDetail();
        } else {
            if (File::exists(public_path() . '/storage/' . $model->file) && !in_array($model->file, $arrFile)) {
                File::delete(public_path() . '/storage/' . $model->file);
            }
        }

        $model->fill($request->all());
        if ($request->hasFile('file')) {
            $newFileName = uniqid() . '-' . $request->file->getClientOriginalName();
            $path = $request->file->storeAs('public/files/candidate', $newFileName);
            $model->file = str_replace('public/', '', $path);
        }
        if ($model->save()) {
            return redirect()->back()->with('alert_suc', 'Đã gửi đơn ứng tuyển <i class="icon-material-outline-check-circle"></i>');
        }
        return redirect()->back()->with('alert_err', 'Thất bại. Hãy thử lại sau <i class="icon-material-outline-highlight-off"></i>');
    }

    public function postJobFast($user_id, $blog_id)
    {
        if (Auth::check()) {
            if (Auth::user()->id == $user_id && Auth::user()->role == 0) {
                $user = User::find($user_id);
                $user->load('userFiles', 'userCandidate');
            }
        }
        $job = Blog::find($blog_id);
        $file = UserFile::where('user_id', $user_id)->get();
        $arrFile = [];
        foreach ($file as $key => $f) {
            $arrFile[$key] = $f->file;
        }
        if (!isset($job) || !isset($user) || !isset($user->userFiles[0]->file) || ($user->userCandidate->name) == '' || ($user->userCandidate->phone_number) == '') {
            return redirect()->back()->with('alert_err', 'Thông tin cá nhân không đủ! <i class="icon-material-outline-highlight-off"></i>');
        }

        $model = Apply::where('blog_id', $blog_id)->where('user_candidate_id', $user_id)->first();
        if (!$model) {
            $model = new Apply();
        } else {
            if (File::exists(public_path() . '/storage/' . $model->file) && !in_array($model->file, $arrFile)) {
                File::delete(public_path() . '/storage/' . $model->file);
            }
        }

        $data = [
            'user_candidate_id' => $user_id,
            'blog_id' => $blog_id,
            'name_candidate' => $user->userCandidate->name,
            'phone_candidate' => $user->userCandidate->phone_number,
            'email_candidate' => $user->email,
            'file' => $user->userFiles[0]->file,
            'message' => 'Ứng tuyển nhanh.'
        ];

        $model->fill($data);
        if ($model->save()) {
            return redirect()->back()->with('alert_suc', 'Đã gửi đơn ứng tuyển <i class="icon-material-outline-check-circle"></i>');
        }
        return redirect()->back()->with('alert_err', 'Thất bại! Hãy thử lại sau <i class="icon-material-outline-highlight-off"></i>');
    }

    public function candidate(Request $request)
    {
        $id = $request->id;
        $profile = UserCandidate::find($id);
        if (!$profile) {
            return redirect()->route('404');
        }
        $userFile = UserFile::where('user_id', $id)->get();
        $profile->load('location', 'category', 'user');

        $userCandidate = UserCandidate::find($id);
        if (!$userCandidate) {
            return redirect()->route('404');
        }
        $userCandidate->load('location', 'category');

        $arrFavorite = [];
        $favorites = Favorite::where('user_candidate_id', $id)->get();
        foreach ($favorites as $key => $f) {
            $arrFavorite[$key] = $f->blog_id;
        }

        return view('client.profile-candidate', compact('userCandidate', 'profile', 'userFile', 'arrFavorite'));
    }

    public function company(Request $request)
    {
        $company_info = UserRecruitment::where('slug', $request->slug)->first();
        if (!$company_info) {
            return redirect(route('home'));
        }

        $blogs = Blog::where('user_recruitment_id', $company_info->id)->where('enable', 1)->get();
        $company_info->load('category', 'location', 'user');
        $blogs->load('location', 'userRecruitment');
        if (Auth::check()) {
            $favorites = Favorite::where('user_candidate_id', Auth::user()->id)->get();
            $arr = [];
            foreach ($favorites as $key => $f) {
                $arr[$key] = $f->blog_id;
            }
            return view('client.profile-recruitment', compact('company_info', 'blogs', 'arr'));
        }
        return view('client.profile-recruitment', compact('company_info', 'blogs'));
    }

    public function favorite(Request $request)
    {
        $check = Blog::find($request->blog_id)->id;
        if (!$check) {
            return false;
        }
        $favorite = Favorite::where('user_candidate_id', $request->user_id)->where('blog_id', $request->blog_id)->first();
        if ($favorite) {
            $query = 'DELETE FROM favorites where blog_id = ' . $request->blog_id  . ' AND user_candidate_id = ' . $request->user_id;
            if (DB::delete($query)) {
                $html = "<script> alertify.error('Đã hủy lưu công việc <i class=" . '"' . "icon-material-outline-highlight-off" . '"' . "></i>'); </script>";
                return $html;
            } else {
                return false;
            }
        }
        $model = new Favorite();
        $model['user_candidate_id'] = $request->user_id;
        $model['blog_id'] = $request->blog_id;
        if ($model->save()) {
            $html = "<script> alertify.success('Đã lưu công việc <i class=" . '"' . "icon-material-outline-check-circle" . '"' . "></i>'); </script>";
            echo $html;
        }
        return false;
    }

    public function jobSave()
    {
        if (Auth::check()) {
            $favorite = Favorite::where('user_candidate_id', Auth::user()->id)->get();
            $count = count($favorite);
            $arr = [];
            foreach ($favorite as $key => $f) {
                $arr[$key] = $f->blog_id;
            }

            $blog_data = Blog::whereIn('id', $arr)->get();
            $blog_data->load('location');
            $now = date('Y-m-d');
            $ads = Ads::where('role', '<', 200)
                ->where('to_time', '>', $now)
                ->get()->random(1)->first();
            return view('client.favorite', compact('blog_data', 'count', 'ads'));
        }
    }

    public function apply()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 0) {
                $user_id = Auth::user()->id;
            }
        }

        if (!$user_id) {
            return redirect()->route('home');
        }

        if (isset($_GET['view']) == 'tat-ca') {
            $limit = "";
        } else {
            $limit = " LIMIT 0, 10";
        }

        $sql = "SELECT apply.*, blogs.slug as blog_slug, blogs.title as blog_title, blogs.position as blog_position, user_recruitment.name as company_name, user_recruitment.verification as company_verification, user_recruitment.slug as company_slug, user_recruitment.avatar as company_logo FROM apply LEFT OUTER JOIN blogs ON blogs.id = apply.blog_id LEFT OUTER JOIN user_recruitment ON user_recruitment.id = blogs.user_recruitment_id WHERE apply.user_candidate_id = " . $user_id . " ORDER BY apply.id DESC" . $limit;
        $apply = DB::select($sql);
        $now = date('Y-m-d');
        $ads = Ads::where('role', '<', 200)
            ->where('to_time','>', $now)
            ->get()->random(1)->first();

        return view('client.apply', compact('apply', 'ads'));
    }

    public function applyDetail($id)
    {
        $detail = ApplyDetail::where('apply_id', $id)->orderByDesc('id')->get();
        $cv = Apply::find($id);

        $html = '<ul style="padding: 0;">';

        if (!isset($detail[0])) {
            $html .= '<p>Hãy chờ nhà tuyển dụng phản hồi. Chúng tôi sẽ thông báo qua email cho bạn khi có thay đổi!</p>';
        }

        foreach ($detail as $d) {
            $html .= '
            <div style="height: 15px;
            width: 15px;
            background-color: #ff8a00;
            border-radius: 50%;
            display: inline-block; position:absolute; left:13px;"></div>
            <li id="pc" style="padding:10px; display: flex; justify-content: space-between; border-left: 2px solid #ff8a00;">
                <p style="margin:-35px 0 0 20px; padding:20px 0; max-width:80%">' . $d->name . '</p>
                <span style="float: right; font-size: 11px;margin:-35px 0 0 0; padding:20px 0;font-weight:bold; color:#ff8a00;">' . date("H:i d-m", strtotime($d->created_at)) . '</span>
            </li>
            <li id="mobile" style="padding:10px; border-left: 2px solid #ff8a00; display: none;">
                <p style="margin:-35px 0 0 20px; padding:20px 0; max-width:80%">' . $d->name . '</p>
                <p style=" float: right; font-size: 11px;margin:-35px 0 0 20px; padding:20px 0;font-weight:bold; color:#ff8a00;">' . date("H:i d-m", strtotime($d->created_at)) . '</p>
            </li>
        ';
        }

        if (File::exists(public_path() . '/storage/' . $cv->file)) {
            $html .= '<a target="_blank" href="' . asset("storage/" . $cv->file)  . '" class="button margin-top-25 full-width utf-button-sliding-icon ripple-effect" type="submit" form="apply-now-form">Hồ sơ đã gửi <i class="icon-feather-chevron-right"></i></a>';
        } else {
            $html .= '<a href="#" class="button margin-top-25 full-width utf-button-sliding-icon ripple-effect" type="submit" form="apply-now-form">Hồ sơ này đã bị xóa! <i class="icon-feather-chevron-right"></i></a>';
        }

        $html .= '</ul>';

        return $html;
    }

    public function cv()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 0) {
                $user_id = Auth::user()->id;
            }
        }

        if (!$user_id) {
            return redirect()->route('home');
        }

        $cv = UserFile::where('user_id', $user_id)->get();
        $now = date('Y-m-d');
        $ads = Ads::where('role', '<', 200)
            ->where('to_time','>',$now)
            ->get()->random(1)->first();

        return view('client.cv', compact('cv', 'ads'));
    }

    public function newCv(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->role == 0) {
                $user_id = Auth::user()->id;
            }
        }

        if (!$user_id) {
            return redirect()->route('home');
        }

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'file' => 'required|mimes:pdf'
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->with('alert_err', 'Thất bại. Kiểm tra dữ liệu nhập');
        }
        $model = new UserFile();
        $model->fill($request->all());
        $model['user_id'] = $user_id;
        if ($request->hasFile('file')) {
            $newFileName = uniqid() . '-' . $request->file->getClientOriginalName();
            $path = $request->file->storeAs('public/files/candidate', $newFileName);
            $model->file = str_replace('public/', '', $path);
        }
        if ($model->save()) {
            return redirect()->back()->with('alert_suc', 'Thêm hồ sơ thành công <i class="icon-material-outline-check-circle"></i>');
        }
        return redirect()->back()->with('alert_err', 'Thất bại. Hãy thử lại sau <i class="icon-material-outline-highlight-off"></i>');
    }

    public function deleteCv($id)
    {
        if (Auth::check()) {
            if (Auth::user()->role == 0) {
                $user_id = Auth::user()->id;
            }
        }

        $cv = UserFile::find($id);

        if (!$user_id) {
            return redirect()->route('home');
        }

        if (!$cv) {
            return redirect()->back()->with('alert_err', 'Bạn không thể xóa CV này!');
        }

        if ($cv->user_id == $user_id) {
            if (File::exists(public_path() . '/storage/' . $cv->file)) {
                File::delete(public_path() . '/storage/' . $cv->file);
            }
            $cv->delete();
            return redirect()->back()->with('alert_suc', 'Đã xóa CV!');
        } else {
            return redirect()->back()->with('alert_err', 'Bạn không thể xóa CV này!');
        }
    }

    public function contact(Request $request)
    {
        $toMail = $request->emailTo;
        $data = [
            'nameRecruitment' => $request->nameRecruitment,
            'fullname' => $request->fullname,
            'phone' => $request->phone,
            'email' => $request->email,
            'title' => $request->title,
            'content' => $request->content,
        ];

        Mail::send('mail.mail-contact', $data, function ($messages) use ($toMail) {
            $messages->from('jobs.fpoly@gmail.com', 'Tìm việc JobS');
            $messages->to($toMail, 'Member JobS');
            $messages->subject('Thư liên hệ từ Website JobS');
        });

        return redirect()->back()->with('msgSend', 'Đã gửi thư liên hệ');
    }

    public function alert($apply_id, $company)
    {
        $apply = Apply::find($apply_id);
        if (!$apply) {
            return redirect()->route('404');
        }
        $status = '';
        if ($apply->status == 0) {
            $status = 'Đang chờ phê duyệt';
        } elseif ($apply->status == 1) {
            $status = 'Đã duyệt hồ sơ';
        } elseif ($apply->status == 2) {
            $status = 'Đang liên hệ';
        } elseif ($apply->status == 3) {
            $status = 'Hoàn thành';
        } elseif ($apply->status == 9) {
            $status = 'Không được duyệt';
        }
        $note = ApplyDetail::where('apply_id', $apply_id)->get()->max();
        if($note){
            $note_name = $note->name;
        } else{
            $note_name = "Không có";
        }
        $data = [
            'name' => $apply->name_candidate,
            'company' => $company,
            'status' => $status,
            'content_note' => $note_name
        ];

        Mail::send('mail.mail-alert', $data, function ($messages) use ($apply) {
            $messages->from('jobs.fpoly@gmail.com', 'Tìm việc JobS');
            $messages->to($apply->email_candidate, 'Member JobS');
            $messages->subject('Thông báo đơn ứng tuyển - JobS');
        });

        // return redirect()->back()->with('msgSend', 'Đã gửi thư liên hệ');
    }

    public function updateCadidate()
    {
        $id = Auth::user()->id;
        $user = UserCandidate::find($id);
        $cate = Category::where('enable', 1)->get();
        $location = Location::all();
        return view('client.update-candidate', compact('user', 'cate', 'location'));
    }

    public function PostUpdateCadidate(Request $request)
    {
        $id = Auth::user()->id;
        if ($request->name == '') {
            return redirect()->back();
        }
        $model = UserCandidate::find($id);

        if ($request->hasFile('avatar')) {
          	if (File::exists(public_path() . '/storage/' . $model->avatar) && $model->avatar != "images/avatar/none.jpg") {
                File::delete(public_path() . '/storage/' . $model->avatar);
            }
        }

        $model->fill($request->all());

        if ($request->hasFile('avatar')) {
            $name = uniqid() . '-' . $request->file('avatar')->getClientOriginalName();
            $request->file('avatar')->storeAs(
                'public\images\avatar',
                $name
            );
            $model['avatar'] = 'images/avatar/' . $name;
        }
        $model->save();
        return redirect()->back()->with('msg_update_candidate', 'Cập nhật thông tin thành công');
    }

    public function notFound()
    {
        return view('client.not-found');
    }
    public function sortBy(Request $request)
    {
        $now = date("Y-m-d");
        if ($request->action == 1) {
            $blogs = Blog::where('user_recruitment_id', $request->id_company)->get();
        } elseif ($request->action == 2) {
            $blogs = Blog::where('deadline', '>', $now)
                ->where('user_recruitment_id', $request->id_company)
                ->get();
        } elseif ($request->action == 3) {
            $blogs = Blog::where('deadline', '<', $now)
                ->where('user_recruitment_id', $request->id_company)
                ->get();
        } elseif ($request->action == 4) {
            $blogs = Blog::where('enable', '=', 1)
                ->where('user_recruitment_id', $request->id_company)
                ->get();
        } elseif ($request->action == 5) {
            $blogs = Blog::where('enable', '=', 0)
                ->where('user_recruitment_id', $request->id_company)
                ->get();
        }
        $html = '';
        foreach ($blogs as $b) {
            $enable = $b->enable == 0 ? '<span class="unpaid">Chưa duyệt</span>' : '';
            $working_time = '';
            foreach (explode(",", $b->working_time) as $wt) {
                $color = $wt == 'Full time' ? 'green' : 'yellow';
                $working_time .= /*html*/ '
                <span class="dashboard-status-button utf-job-status-item ' . $color . '"><i class="icon-material-outline-business-center"></i> ' . $wt . '</span>
                ';
            };
            $now = date('Y-m-d');
            $unpaid = '';
            if ($b->deadline < $now) {
                $unpaid = '<span class="unpaid">Hết hạn</span>';
            }
            if (strtotime($b->deadline) - time() > 604800) {
                $deadline = date("d-m-Y", strtotime($b->deadline));
            } else {
                $deadline = $this->timeFor(strtotime($b->deadline) - time());
            }
            $html .= '<li>
            <div class="utf-job-listing">
              <div class="utf-job-listing-details">
                <a href="' . route('job', ['slug' => $b->slug]) . '" class="utf-job-listing-company-logo"><img src="' . asset('/') . 'storage/' . $b->image . '" alt=""></a>
                <div class="utf-job-listing-description">
                  <h3 class="utf-job-listing-title">
                    <a href="' . route('job', ['slug' => $b->slug]) . '">' . $b->title . '</a> ' . $enable . $unpaid . $working_time . '
                  </h3>
                  <div class="utf-job-listing-footer">
                    <ul>
                      <li><i class="icon-feather-briefcase"></i>' . $b->position . '</li>
                      <li><i style="color: #0bbdc6" class="icon-material-outline-access-time"></i>' . $deadline . '</li>
                      <li><i class="icon-material-outline-account-balance-wallet"></i>' . number_format($b->salary_min) . 'đ->' . number_format($b->salary_max) . 'đ </li>
                      <li><i class="icon-material-outline-location-on"></i>' . $b->location->name . '</li>
                    </ul>
                    <div class="utf-buttons-to-right">
                      <a href="' . route('blog.edit', ['id' => $b->id]) . '" class="button green ripple-effect ico" title="Sửa" data-tippy-placement="top"><i class="icon-feather-edit"></i></a>
                      <a href="' . route('blog.delete', ['id' => $b->id]) . '" Onclick="return ConfirmDelete();" class="button red ripple-effect ico" title="Xóa" data-tippy-placement="top"><i class="icon-feather-trash-2"></i></a>
                      <script>
                        function ConfirmDelete() {
                          var x = confirm("Bạn có chắc chắn muốn xóa chứ?");
                          if (x)
                            return true;
                          else
                            return false;
                        }
                      </script>
                    </div>
                  </div>
                  <p class="time_ago">
                <span>
                  Ngày đăng: ' . date("d-m-Y", strtotime($b->created_at)) . '.
                </span>
              </p>
                </div>
              </div>
            </div>
          </li>';
        }
        return $html;
    }
    public function sortByApply(Request $request)
    {
        if ($request->action == 1) {
            $sql = "SELECT apply.*, apply.email_candidate as apply_mail, apply.name_candidate as name_candidate, apply.phone_candidate as apply_phone, apply.created_at as apply_created, user_candidate.avatar as candidate_avt FROM apply LEFT OUTER JOIN blogs ON blogs.id = apply.blog_id LEFT OUTER JOIN user_candidate ON apply.user_candidate_id = user_candidate.id LEFT OUTER JOIN user_recruitment ON user_recruitment.id = blogs.user_recruitment_id WHERE user_recruitment.id =" . $request->id_company ." AND blog_id= " .$request->id_blog;
            $apply = DB::select($sql);

        } elseif ($request->action == 2) {
        } elseif ($request->action == 3) {
        } elseif ($request->action == 4) {
        } elseif ($request->action == 5) {
        }
        $html = '';
        foreach ($apply as $a){
            $id_candidate = UserCandidate::find($a->user_candidate_id)->id;
            $name_company = UserRecruitment::find($request->id_company)->name;
            $option = '';
            foreach(config('common.apply_status') as $key => $val){
                $selected = ($a->status == $key) ? 'selected' : '';
                $option .= '<option'.$selected.' value="'.$key.'">'.$val.'
                </option>';
            }
            $html .= '<li>
            <div class="utf-manage-resume-overview-aera utf-manage-candidate">
                <div class="utf-manage-resume-overview-aera-inner">
                    <div class="utf-manage-resume-avatar">
                        <a href="'.route('candidate', ['id'=>$id_candidate]).'"><img src="'.asset('storage/' . $a->candidate_avt ).'" alt=""></a>
                    </div>
                    <div class="utf-manage-resume-item">
                        <h4><a href="'.route('candidate', ['id'=>$id_candidate]).'">'.$a->name_candidate.'</a><span class="dashboard-status-button ">
                                <div class="select">
                                    <select id="action" data-id="'.$a->id.'">'.$option.'
                                    </select>
                                </div>
                            </span></h4>
                        <span class="utf-manage-resume-detail-item" style=" margin-top: 10px !important;"><a href="#"><i class="icon-feather-mail"></i>'.$a->apply_mail.'</a></span>
                        <span class="utf-manage-resume-detail-item" style=" margin-top: 10px !important;"><i class="icon-feather-phone"></i>'.$a->phone_candidate.'</span>
                        <span class="utf-manage-resume-detail-item" style=" margin-top: 10px !important;"><i style="color: #40b660;" class="icon-material-outline-date-range"></i>'. date("d-m-Y", strtotime($a->apply_created)).'</span>

                        <div class="utf-buttons-to-right">
                            <a onclick="sendMail('. $a->id .', "'.$name_company.'")" href="javascript:void(0)" class="button ripple-effect" title="Gửi Mail" data-tippy-placement="top"><i class="icon-feather-mail"></i>Gửi Mail</a>
                            <a onclick="getDetail('. $a->id .')" href="#small-dialog" class="popup-with-zoom-anim button green ripple-effect ico" data-id="'.$a->id.'" href="#small-dialog" title="Ghi chú" data-tippy-placement="top"><i class="icon-material-outline-note-add"></i></a>
                            <a href="'.asset('storage/' . $a->file).'" target="_blank" class="button yellow ripple-effect ico" title="Xem file" data-tippy-placement="top"><i class="icon-feather-file-text"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </li>';
        }
        $html .= '<div style="z-index: 10 !important;" id="small-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs">
        <div class="utf-signin-form-part">
            <ul class="utf-popup-tabs-nav-item">
                <li class="modal-title">Ghi chú</li>
            </ul>
            <div class="utf-popup-container-part-tabs">
                <div class="utf-popup-tab-content-item" id="tab" style="padding:30px 20px; height:300px;
                overflow-x:hidden;
                overflow-y:auto; ">

                </div>
                <input type="hidden" id="apply_id" value="" style="">
                <div style="position: relative;">
                    <div style="margin-top: 10px !important;  " class="utf-no-border">
                        <input style="    padding-right: 57px;" type="text" class="utf-with-border" name="name" id="name_note" placeholder="Ghi chú..." />
                    </div>
                    <button style="position: absolute; top:15px; right:30px" id="submit_add" type="submit"> <i class="icon-feather-send"></i></button>
                </div>
                </ul>
            </div>
        </div>
    </div>';

        return $html;
    }
    public function getMessApply($id){
        $messApply = Apply::find($id);
        $html = $messApply->message;
        return $html;
    }
}
