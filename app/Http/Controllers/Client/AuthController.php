<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Models\ForgotPassword;
use App\Models\User;
use App\Models\UserCandidate;
use App\Models\UserRecruitment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Stmt\For_;

class AuthController extends Controller
{
    public function signup()
    {
        return view('client.register');
    }

    public function postSignup(Request $request)
    {
        if ($request->role != 0 && $request->role != 50) {
            return redirect()->back();
        }
        $request->validate(
            [
                'email' => [
                    'required',
                    Rule::unique('users')
                ],
                'password' => 'required|min:6|confirmed'
            ],
            [
                'email.required' => 'Vui lòng không để trống email',
                'email.unique' => 'Email đã tồn tại',
                'password.required' => 'Vui lòng không để trống mật khẩu',
                'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
                'password.confirmed' => 'Mật khẩu không khớp'
            ]
        );
        $confirmation_code = time() . uniqid(true);
        $model = new User();
        $model->fill($request->all());
        $model['password'] = Hash::make($request->password);
        $model['confirmation_code'] = $confirmation_code;
        if ($model->save()) {
            $user_id = User::max('id');
            if ($request->role == 0) {
                $model_candidate = new UserCandidate();
                $model_candidate['id'] = $user_id;
                $model_candidate['name'] = "Ứng viên #" . $user_id;
                $model_candidate->save();
            } else if ($request->role == 50) {
                $model_recruitment = new UserRecruitment();
                $model_recruitment['id'] = $user_id;
                $model_recruitment['name'] = "Nhà tuyển dụng #" . $user_id;
                $model_recruitment['slug'] = uniqid();
                $model_recruitment->save();
            }
            $model_forgot = new ForgotPassword();
            $model_forgot['id'] = $user_id;
            $model_forgot['code'] = rand(100000, 999999);
            $model_forgot->save();

            $data = [
                'toMail' => $request->email,
                'confirmation_code' => $confirmation_code
            ];
            Mail::send('mail.mail-verify', $data, function ($messages) use ($data) {
                $messages->from('khuongtv27@gmail.com', 'Website JobS');
                $messages->to($data['toMail'], 'Trần Văn Khương');
                $messages->subject('Email xác thực thông tin tài khoản');
            });
        }

        return redirect(route('login'))->with('msg', 'Xác thực tài khoản')->with('span', 'Bạn vui lòng truy cập vào email ' . $data['toMail'] . ' để xã nhận tài khoản của mình');
    }

    public function verify($code)
    {
        $user = User::where('confirmation_code', $code);
        if ($user->count() > 0) {
            $user->update([
                'confirmed' => 1,
                'confirmation_code' => null
            ]);
            return redirect(route('login'))->with('msg', 'Xác thực tài khoản thành công')->with('span', 'Hãy đăng nhập để tiếp tục sử dụng và trải nghiệm những dịch vụ của JobS');
        } else {
            return redirect(route('login'))->with('msg_error', 'Xác thực tài khoản thất bại')->with('span', 'Đã xảy ra lỗi khi xác thực tài khoản của bạn, vui lòng kiểm tra lại email');
        }
    }

    public function login()
    {
        return view('client.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate(
            [
                'email' => ['required', 'email'],
                'password' => 'required'
            ],
            [
                'email.required' => "Vui lòng không để trống email",
                'email.email' => "Vui lòng nhập đúng định dạng email",
                'password.required' => "Vui lòng không để trống password"
            ]
        );
        $check_user = User::where('email', $request->email)->first();
        if (!empty($check_user)) {
            if ($check_user['confirmed'] == 0) {
                return redirect()->back()->with('msg_error', 'Vui lòng xác thực tài khoản')->with('span', 'Bạn vui lòng truy cập vào email ' . $request->email . ' để xác thực tài khoản của mình')->with('html','jjj')->with('email', $check_user->id);
            }
        }
        $remember = $request->has('remember') ? true : false;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            User::where('email', $request->email)->update(['active' => 1]);
            return redirect(route('home'));
        } else {
            return redirect()->back()->with('msg_err', 'Tài khoản mật khẩu không chính xác');
        }
    }

    public function logout()
    {
        $email = Auth::user()->email;
        User::where('email', $email)->update(['active' => 0]);
        Auth::logout();
        return redirect(route('home'));
    }

    public function changePassword()
    {
        return view('client.change-password');
    }

    public function PostChangePassword(Request $request)
    {
        $email = Auth::user()->email;
        $user = User::where('email', $email)->first();
        if (!empty($user)) {
            if (!password_verify($request->password, $user->password)) {
                return redirect()->back()->with('msg_chagepass', 'Mật khẩu cũ không chính xác');
            } elseif ($request->passNew != $request->confirm_password) {
                return redirect()->back()->with('msg_passNewfals', 'Mật khẩu không khớp');
            }
            $passNew  = Hash::make($request->passNew);
            $user->update(['password' => $passNew]);
            return redirect()->back()->with('msg_success_chagepass', 'vvv');
        } else {
            return redirect()->back()->with('msg_falseemail', 'Email không chính xác');
        }
    }

    public function forgot()
    {
        return view('client.forgot-password');
    }

    public function forgotPassword(Request $request)
    {
        // dd($request->all());
        $request->validate(
            [
                'email' => 'required',
            ],
            [
                'email.required' => 'Không để trống email',
            ]
        );
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->with('msg_errEmail', 'Địa chỉ email không tồn tại');
        }
        if ($user->confirmed == 0) {
            return redirect()->back()->with('msg-err', 'Tài khoản của bạn chưa được xác thực')->with('span', 'Vui lòng xác thực tài khoản tại email ' . $request->email . ' để thực hiện đổi mật khẩu');
        }
        $user_forgot = ForgotPassword::find($user->id);
        $time_code = time() - strtotime($user_forgot->updated_at);
        if ($user_forgot->code == $request->code) {
            if ($time_code > 300) {
                return redirect()->back()->with('msg-err', 'Mã xác nhận hết hạn, nhập lại email để lấy mã')->with('email', $request->email);
            }
            $user->password = Hash::make($request->password);
            $user->save();
            $code = rand(100000, 999999);
            $user_forgot->code = $code;
            $user_forgot->save();
            return redirect(route('login'))->with('msg', 'Đổi mật khẩu thành công')->with('span', 'Mật khẩu của bạn đã được thay đổi thành công, đăng nhập để tiếp tục sử dụng và trải nghiệm những dịch vụ của JobS !');
        }
        if ($request->code && $user_forgot->code != $request->code) {
            return redirect()->back()->with('msg-err', 'Mã xác nhận không chính xác!')->with('email', $request->email)->with('span', 'Vui lòng kiểm tra lại mã xác nhận gồm 6 ký tự đã gửi trong email ' . $request->email);
        }
        $code = rand(100000, 999999);
        $user_forgot->code = $code;
        $user_forgot->save();
        $data = [
            'email' => $request->email,
            'code' => $code
        ];
        Mail::send('mail.mail-forgot-pass', $data, function ($message) use ($data) {
            $message->from('jobs.fpoly@gmail.com', 'Tìm việc JobS');
            $message->to($data['email'], 'Member');
            $message->subject('Đổi mật khẩu tài khoản JobS');
        });
        return redirect()->back()->with('msg', 'Đã gửi mã xác nhận tới Email!')->with('email', $request->email)->with('span', 'Chúng tôi đã gửi 1 mã xác nhận tới địa chỉ email ' . $request->email . '. Vui lòng truy cập email để nhận mã  ');
    }
    public function sendMailVery($id){
        $user = User::find($id);
        if($user->confirmed == 1){
            return redirect()->back();
        }
        $data = [
            'toMail' => $user->email,
            'confirmation_code' => $user->confirmation_code
        ];
        Mail::send('mail.mail-verify', $data, function ($messages) use ($data) {
            $messages->from('khuongtv27@gmail.com', 'Website JobS');
            $messages->to($data['toMail'], 'Trần Văn Khương');
            $messages->subject('Email xác thực thông tin tài khoản');
        });
        return redirect(route('login'))->with('msg', 'Xác thực tài khoản')->with('span', 'Bạn vui lòng truy cập vào email ' . $data['toMail'] . ' để xã nhận tài khoản của mình');
    }
}
