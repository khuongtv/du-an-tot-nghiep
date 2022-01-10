<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserForm;
use App\Models\ForgotPassword;
use App\Models\User;
use App\Models\UserAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request['keyword'] ?? "";
        if ($search != "") {
            $users = User::where('email', 'like', "%" . $request->keyword . "%")->where('role', 200)->orWhere('role', 150)->paginate(30);
        } else {
            $users = User::where('role', 200)->orWhere('role', 150)->latest()->get();
        }
        return view('admin.users.list', compact('users', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.users.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserForm $request)
    {
        $user = new User();
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->confirmed = 1;
        $user->save();
        $user_id = User::max('id');
        $model_forgot = new ForgotPassword();
        $model_forgot['id'] = $user_id;
        $model_forgot['code'] = rand(100000, 999999);
        $model_forgot->save();

        if ($request->role == 200 || $request->role == 150) {
            $userAdmin = new UserAdmin();
            $userAdmin->fill($request->all());
            $userAdmin->id = $user->id;

            if ($request->hasFile('avatar')) {
                $name = uniqid() . '-' . $request->file('avatar')->getClientOriginalName();
                $request->file('avatar')->storeAs(
                    'public\images\users',
                    $name
                );
                $userAdmin['avatar'] = 'images/users/' . $name;
            }

            $userAdmin->save();
        }

        return redirect()->route('users.index')->with('alert', 'Thêm dữ liệu thành công!');;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::find($id);
        if(!$user){
            return redirect()->back();
        }
        if ($user->role == 200 || $user->role == 150) {
            $userAdmin = UserAdmin::find($id);
            return view('admin.users.edit', compact('user', 'userAdmin'));
        }
        return redirect()->back();
    }

    public function updated(UserForm $request, $id)
    {
        $user = User::find($id);
        if(!$user){
            return redirect()->back();
        }
        if ($request->role == 200 || $request->role == 150) {
            $user->fill($request->all());
            $user->save();
            $userAdmin = UserAdmin::find($id);
            if ($request->hasFile('avatar')) {
                if (File::exists(public_path() . '/storage/' . $userAdmin->avatar) && $userAdmin->avatar != "images/users/none.jpg") {
                    File::delete(public_path() . '/storage/' . $userAdmin->avatar);
                }
            }
            $userAdmin->fill($request->all());

            if ($request->hasFile('avatar')) {
                $newFileName = uniqid() . '-' . $request->avatar->getClientOriginalName();
                $path = $request->avatar->storeAs('public/images/users', $newFileName);
                $userAdmin->avatar = str_replace('public/', '', $path);
            }

            $userAdmin->save();
            // toast('Sửa tài khoản thành công !', 'success');

            return redirect()->route('users.index')->with('success', 'Cập nhật dữ liệu thành công!');;
        }
        // toast('Sửa tài khoản thành công !', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id == Auth::user()->id){
            return redirect()->back();
        }
        $deleteUser = User::find($id);
        if(!$deleteUser){
            return redirect()->back();
        }
        if ($deleteUser->role == 200 || $deleteUser->role == 150) {
            $user = UserAdmin::find($id);
            if (File::exists(public_path() . '/storage/' . $user->avatar) && $user->avatar != "images/users/none.jpg") {
                File::delete(public_path() . '/storage/' . $user->avatar);
            }
            $user->delete();
            $deleteUser->delete();

            return redirect()->route('users.index')->with('message', 'Xóa dữ liệu thành công!');;
        }
        return redirect()->back();
    }

    /**
     * @param Request $request
     */

    public function checkEmail(Request $request)
    {

        $check_email_ctv = User::where("email", $request->email)->count();
        echo json_encode($check_email_ctv <= 0);
    }
}
