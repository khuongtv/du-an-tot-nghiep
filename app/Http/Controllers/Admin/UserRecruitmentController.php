<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserRecruitment;
use Illuminate\Http\Request;

class UserRecruitmentController extends Controller
{
    public function index(Request $request)
    {
        $user_recruitment = User::where('role', 50)->get();
        $user_recruitment->load('userFiles', 'userRecruitment');
        return view('admin.user_recruitment.index', compact('user_recruitment'));
    }

    /**
     * Show
     */
    public function showRecruitment(Request $request)
    {
        $show = UserRecruitment::find($request->id);
        $show->load('location');
        $show->load('category');
        return response()->json(['show' => $show]);
    }

    /**
     * On tick
     */
    public function onTick(Request $request)
    {
        $offTick = UserRecruitment::find($request->id);
        $offTick->verification = UserRecruitment::OFF_TICK;

        $offTick->save();

        return response()->json([
            "status" => 200
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function offTick(Request $request)
    {
        $onTick = UserRecruitment::find($request->id);
        $onTick->verification = UserRecruitment::ON_TICK;

        $onTick->save();

        return response()->json([
            "status" => 200
        ]);
    }
}
