<?php

namespace App\Http\Controllers\Client\Company;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\BlogsRequest;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Support\Facades\File;
use App\Models\UserRecruitment;
use Illuminate\Http\Request;
use SebastianBergmann\Environment\Console;

class BlogsController extends Controller
{
    public function index(Request $request)
    {

        $productQuery = Blog::orderByDesc('id')->where('title', 'like', "%" . $request->keyword . "%");
        $company_id = Auth::user()->id;

        if ($request->has('cate_id') && $request->cate_id > 0) {
            $productQuery = $productQuery->where('cate_id', $request->cate_id);
        }
        if ($request->has('location_id') && $request->location_id > 0) {
            $productQuery = $productQuery->where('location_id', $request->location_id);
        }
        $productQuery = $productQuery->where('user_recruitment_id', $company_id);
        $viewBlog = $productQuery->paginate(10);
        $cate = Category::all();
        $loca = Location::all();
        $viewBlog->load('location', 'apply', 'userRecruitment');
        return view('client.company.blog.index', compact('viewBlog', 'cate', 'loca'));
    }
    public function addForm()
    {
        $cate = Category::all();
        $loca = Location::all();
        $userRcruitment = UserRecruitment::all();
        return view('client.company.blog.add', compact('cate', 'loca', 'userRcruitment'));
    }
    public function saveAdd(BlogsRequest $request)
    {

        $model = new Blog();
        $model->fill($request->all());

        if ($request->hasFile('file_upload')) {
            $newFileName = uniqid() . '-' . $request->file_upload->getClientOriginalName();
            $path = $request->file_upload->storeAs('public/images/images', $newFileName);
            $model->image = str_replace('public/', '', $path);
        }
        if (count($request->working_time) == 1) {
            $model->working_time = $request->working_time[0];
        } else {
            $model->working_time = "Full time,Part time";
        }

        $model->save();
        return redirect('/nha-tuyen-dung/quan-ly-tin-tuyen-dung?mess=Thêm dữ liệu thành công');
    }
    public function editForm($id)
    {
        $cate = Category::all();
        $loca = Location::all();
        $blog = Blog::find($id);
        $userRcruitment = UserRecruitment::all();
        if (!$blog) {
            return redirect()->back();
        }
        return view('client.company.blog.edit', compact('cate', 'loca', 'blog', 'userRcruitment'));
    }
    public function saveEdit($id, BlogsRequest $request)
    {
        $model = Blog::find($id);
        if (!$model) {
            return redirect()->back();
        }

        if ($request->hasFile('file_upload')) {
            if (File::exists(public_path() . '/storage/' . $model->image)) {
                File::delete(public_path() . '/storage/' . $model->image);
            }
        }
        $model->fill($request->all());
        if ($request->hasFile('file_upload')) {
            $newFileName = uniqid() . '-' . $request->file_upload->getClientOriginalName();
            $path = $request->file_upload->storeAs('public/images/images', $newFileName);
            $model->image = str_replace('public/', '', $path);
        }
        $model->enable = 0;
        $model->save();
        return redirect('/nha-tuyen-dung/quan-ly-tin-tuyen-dung?mess=Sửa dữ liệu thành công');
    }
    public function delete($id)
    {
        $blog = Blog::find($id);
        if (File::exists(public_path() . '/storage/' . $blog->image)) {
            File::delete(public_path() . '/storage/' . $blog->image);
        }
        $blog->delete();
        return redirect()->back();
    }
    // public function index1()
    // {
    //     return view('client.company.searchuv.qlsearchuv');
    // }
}
