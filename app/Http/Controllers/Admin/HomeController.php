<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\ForgotPass;
use App\Models\ForgotPassword;
use App\Models\User;
use App\Models\UserAdmin;
use App\Models\UserCandidate;
use App\Models\UserRecruitment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $count_candidate = User::where('role', '=', '0')->count();
        $count_recruitment = User::where('role', '=', '50')->count();
        $count_admin = User::where('role', '=', '200')->count();
        $count_nhan_vien = User::where('role', '=', '150')->count();

        $startMonth = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $endMonth = Carbon::now('Asia/Ho_Chi_Minh')->endOfMonth()->toDateString();
        $stratWeek = Carbon::now('Asia/Ho_Chi_Minh')->startOfWeek()->toDateString();
        $endWeek = Carbon::now('Asia/Ho_Chi_Minh')->endOfWeek()->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        $useradmin = UserAdmin::whereDate('created_at', Carbon::today())->count();
        $useradmintuan = UserAdmin::whereBetween('created_at', [$stratWeek, $endWeek])->count();
        $useradminthang = UserAdmin::whereBetween('created_at', [$startMonth, $endMonth])->count();

        $usercan = UserCandidate::whereDate('created_at', Carbon::today())->count();
        $usercantuan = UserCandidate::whereBetween('created_at', [$stratWeek, $endWeek])->count();
        $usercanthang = UserCandidate::whereBetween('created_at', [$startMonth, $endMonth])->count();

        $userre = UserRecruitment::whereDate('created_at', Carbon::today())->count();
        $userretuan = UserRecruitment::whereBetween('created_at', [$stratWeek, $endWeek])->count();
        $userrethang = UserRecruitment::whereBetween('created_at', [$startMonth, $endMonth])->count();

        //tin tuyển dụng
        $blog = Blog::whereDate('created_at', Carbon::today())->count();
        $blogtuan = Blog::whereBetween('created_at', [$stratWeek, $endWeek])->count();
        $blogthang = Blog::whereBetween('created_at', [$startMonth, $endMonth])->count();

        $blog_active = Blog::orWhere('enable', '1')->whereDate('created_at', Carbon::today())->count();
        $blog_active_tuan = Blog::orWhere('enable', '1')->whereBetween('created_at', [$stratWeek, $endWeek])->count();
        $blog_active_thang = Blog::orWhere('enable', '1')->whereBetween('created_at', [$startMonth, $endMonth])->count();

        $blog_unactive = Blog::orWhere('enable', '0')->whereDate('created_at', Carbon::today())->count();
        $blog_unactive_tuan = Blog::orWhere('enable', '0')->whereBetween('created_at', [$stratWeek, $endWeek])->count();
        $blog_unactive_thang = Blog::orWhere('enable', '0')->count();

        // $blog_active = Blog::where('enable', '1')->orderBy('id', 'DESC')->count();
        // $blog_unactive = Blog::where('enable', '0')->orderBy('id', 'DESC')->count();

        $search = $request['keyword'] ?? "";
        if ($search != "") {
        } else {
            return view('admin.dashboard.index', compact('search', 'blog_active', 'count_candidate','count_recruitment', 'count_admin', 'count_nhan_vien', 'blog_unactive', 'now', 'usercan', 'usercantuan', 'usercanthang', 'userre', 'userretuan', 'userrethang', 'blog', 'blogtuan', 'blogthang', 'blog_active', 'blog_active_tuan', 'blog_active_thang', 'blog_unactive', 'blog_unactive_tuan', 'blog_unactive_thang'));
        }
        return view('admin.dashboard.index', compact('search', 'blog_active','count_candidate','count_recruitment','count_admin','count_nhan_vien','now', 'usercan', 'usercantuan', 'usercanthang', 'userre', 'userretuan', 'userrethang', 'blog', 'blogtuan', 'blogthang', 'blog_active', 'blog_active_tuan', 'blog_active_thang', 'blog_unactive', 'blog_unactive_tuan', 'blog_unactive_thang'));
    }
    public function login()
    {
        return view('admin.login');
    }
    public function postLogin(Request $request)
    {
        $request->validate(
            [
                'email' => 'required',
                'password' => 'required'
            ],
            [
                'email.required' => 'Vui lòng để trống email',
                'password.required' => 'Vui lòng để trống password'
            ]
        );

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            User::where('email', $request->email)->update(['active' => 1]);
            return redirect(route('dashboard'));
        } else {
            return redirect()->back()->with('msg_loginAdmin', 'Tài khoản mật khẩu không chính xác');
        }
    }
    public function logout()
    {
        $email = Auth::user()->email;
        User::where('email', $email)->update(['active' => 0]);
        Auth::logout();
        return redirect(route('admin_login'));
    }
    public function forgotPassword()
    {
        return view('admin.forgot-password');
    }
    public function PostForgotPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->back()->with('msg_err', 'Đại chỉ email không tồn tại trên hệ thống!');
        }

        $user_forgot = ForgotPassword::find($user->id);
        $time_code = time() - strtotime($user_forgot->updated_at);


        if ($request->code == $user_forgot->code) {
            if ($time_code > 300) {
                return redirect()->back()->with('msg_err', 'Mã xác nhận hết hạn, nhập lại email để lấy mã')->with('email', $request->email);
            }
            if ($request->password != $request->confirm_password) {
                return redirect()->back()->with('msg_err', 'Mật khẩu nhập lại không khớp')->with('email', $request->email)->with('code', $request->code);
            }
            $user->password = Hash::make($request->password);
            $user->save();
            $code = rand(100000, 999999);
            $user_forgot->code = $code;
            $user_forgot->save();
            return redirect(route('admin_login'))->with('msg', 'Đổi mật khẩu thành công');
        }
        if ($request->code && $request->code != $user->code) {
            return redirect()->back()->with('msg_err', 'Mã xác nhận không chính xác!')->with('email', $request->email);
        }


        $code = rand(100000, 999999);
        $user_forgot->code = $code;
        $user_forgot->save();
        $data = [
            'email' => $request->email,
            'code' => $code
        ];
        Mail::send('mail.mail-forgot-pass', $data, function ($message) use ($data) {
            $message->from('khuongtv27@gmail.com', 'Tìm việc JobS');
            $message->to($data['email'], 'Member');
            $message->subject('Đổi mật khẩu tài khoản JobS');
        });
        return redirect()->back()->with('msg', 'Đã gửi mã xác nhận tới địa chỉ email của bạn!')->with('email', $request->email);
    }
    public function changePassword()
    {
        return view('admin.change-password');
    }
    public function PostChangePassword(Request $request)
    {
        $request->validate(
            [
                'password' => 'required',
                'passNew' => 'required|min:6|confirmed',
                'confirm_password' => 'required',
            ],
            [
                'password.required' => 'Không để trống mật khẩu cũ',
                'passNew.required' => 'Không để trống mật khẩu mới',
                'passNew.min' => 'Mật khẩu tối thiểu 6 ký tự',
                'passNew.confirmed' => 'Mật khẩu không khớp',
                'confirm_password.required' => 'Vui lòng xác nhận mật khẩu'
            ]

        );
        $email = Auth::user()->email;
        $user = User::where('email', $email)->first();
        if (!empty($user)) {

            if (!password_verify($request->password, $user->password)) {
                return redirect()->back()->with('msg_err', 'Mật khẩu cũ không chính xác');
            } elseif ($request->passNew != $request->confirm_password) {
                return redirect()->back()->with('msg_passNewfals', 'Mật khẩu không khớp');
            }
            $passNew  = Hash::make($request->passNew);
            $user->update(['password' => $passNew]);
            return redirect()->back()->with('msg', 'Đổi mật khẩu thành công');
        } else {
            return redirect()->back()->with('msg_err', 'Email không chính xác');
        }
    }
}
