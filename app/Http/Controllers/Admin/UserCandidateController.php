<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserCandidate;
use Illuminate\Http\Request;

class UserCandidateController extends Controller
{
    public function index(Request $request)
    {

        $user_candidate = User::where('role', 0)->get();
        $user_candidate->load('userFiles');
        $user_candidate->load('userCandidate');

        return view('admin.user_candidate.index', compact('user_candidate'));
    }
}
