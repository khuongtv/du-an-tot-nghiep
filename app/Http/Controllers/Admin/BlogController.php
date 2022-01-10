<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\AddBlogRequest;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function listActive(Request $request)
    {
        $search = $request['keyword'] ?? "";
        if ($search != "") {
            $blogs = Blog::where('title', 'like', "%" . $request->keyword . "%")->paginate(30);
        } else {
            $blogs = Blog::where('enable', '1')->orderBy('id', 'DESC')->get();
            $blogs->load('category', 'location', 'userRecruitment');
        }
        $locations = Location::all();
        $categories = Category::all();
        return view('admin.blog.listActive', compact('categories', 'blogs', 'locations', 'search'));
    }
    public function listUnactive(Request $request)
    {
        $blogs = Blog::where('enable', '0')->orderBy('id', 'DESC')->get();
        $blogs->load('category', 'location', 'userRecruitment');
        // $blogs = Blog::where('title', 'like', "%" . $request->keyword . "%")->paginate(30);
        $locations = Location::all();
        $categories = Category::all();
        return view('admin.blog.listUnactive', compact('categories', 'blogs', 'locations'));
    }
    public function show($id)
    {
        $blogs =  Blog::find($id);
        return view('admin.blog.show', compact('blogs'));
    }
    public function delete($id)
    {
        $blog = Blog::findOrFail($id);
        if (!$blog) {
            return redirect()->back();
        }
        $blog->delete();
        return redirect()->back()->with('message', 'Xóa dữ liệu thành công!');
    }
    public function activeBlog($blog_id)
    {
        DB::table('blogs')->where('id', $blog_id)->update(['enable' => 1]);
        return redirect(route('blog.listActive'));
    }
    public function unactiveBlog($blog_id)
    {
        DB::table('blogs')->where('id', $blog_id)->update(['enable' => 0]);
        return redirect(route('blog.listUnactive'));
    }
}
