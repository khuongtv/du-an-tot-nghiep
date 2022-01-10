<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ForgotPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index');
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
                'password.required' => 'Vui lòng để trống mật khẩu'
            ]
        );

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            User::where('email', $request->email)->update(['active' => 1]);
            return redirect(route('dashboard'));
        } else {
            return redirect()->back()->with('msg_loginAdmin', 'Xin lỗi! Tài khoản hoặc mật khẩu không chính xác.');
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
                'passNew' => 'required|min:6',
                'confirm_password' => 'required',
            ],
            [
                'password.required' => 'Không để trống mật khẩu cũ',
                'passNew.required' => 'Không để trống mật khẩu mới',
                'passNew.min' => 'Mật khẩu tối thiểu 6 ký tự',
                // 'passNew.confirmed' => 'Mật khẩu không khớp',
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
