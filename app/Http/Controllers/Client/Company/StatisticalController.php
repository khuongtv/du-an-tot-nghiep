<?php

namespace App\Http\Controllers\Client\Company;

use App\Http\Controllers\Controller;
use App\Models\Apply;
use App\Models\Blog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserRecruitment;
use App\Models\UserCandidate;
use Illuminate\Support\Facades\DB;

class StatisticalController extends Controller
{
    public function index(Request $request)
    {
        $TongDon = DB::table("user_recruitment")
            ->select(
                "user_recruitment.id as user_recruitment_id",
                "apply.blog_id as apply_blog_id",
            )
            ->join("blogs", "blogs.user_recruitment_id", "=", "user_recruitment.id")
            ->join("apply", "blogs.id", "=", "apply.blog_id")
            ->where('user_recruitment.id', Auth::user()->id)
            ->count();

        $DonChuaDuyet = Blog::where('enable', '=', 0)
        ->where('user_recruitment_id', Auth::user()->id)  
        ->count();
            
        $DaXacNhan = Blog::where('enable', '=', 1)
        ->where('user_recruitment_id', Auth::user()->id)
        ->count();

        $TongTin = Blog::where('user_recruitment_id', Auth::user()->id)->count('user_recruitment_id');
        $id = Auth::user()->id;
        $company = UserRecruitment::find($id);
        $candidate = UserCandidate::where('location_id', $company['location_id'])->where('cate_id', $company['cate_id'])->get();

        $data = $request->all();

        $stratWeek = Carbon::now('Asia/Ho_Chi_Minh')->startOfWeek()->toDateString();
        $endWeek = Carbon::now('Asia/Ho_Chi_Minh')->endOfWeek()->toDateString();


        $blog = Blog::where('user_recruitment_id', Auth::user()->id)->get();
        $ngay = 0;
        $tuan = 0;
            foreach($blog as $b){
               $bien = Apply::where('blog_id',$b->id)
                   ->WhereDate('created_at', Carbon::today())
                   ->count();
               $bien2 = Apply::where('blog_id',$b->id)
                   ->WhereBetween('created_at', [$stratWeek, $endWeek])
                   ->count();
                $ngay += $bien;
                $tuan += $bien2;

    }
        return view('client.company.statistical.index', compact('TongDon', 'TongTin', 'DonChuaDuyet','DaXacNhan', 'tuan', 'ngay', 'candidate'));
    }
}
