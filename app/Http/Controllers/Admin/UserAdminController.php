<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserAdmin;
use Illuminate\Http\Request;

class UserAdminController extends Controller
{
    public function index(Request $request)
    {
        $search = $request['keyword'] ?? "";
        if ($search != "") {
        } else {
            $userAdmin = UserAdmin::all();
            $userAdmin->load('getRole');
            $userArray = $userAdmin->toArray();
        }
        return view('admin.user_admin.list', compact('userArray', 'search'));
    }
}
