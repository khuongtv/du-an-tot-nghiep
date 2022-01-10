<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\AddCategoryRequest;
use App\Http\Requests\Category\EditCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request['keyword'] ?? "";
        if ($search != "") {
            $categories = Category::where('name', 'like', "%" . $request->keyword . "%")->get();
        } else {
            $categories = Category::orderBy('id', 'DESC')->get();
        }
        // dd(count($categories));
        return view('admin.category.index', compact('categories', 'search'));
    }
    public function add()
    {
        return view('admin.category.create');
    }
    public function store(AddCategoryRequest $request)
    {
        Category::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'enable' => $request->enable,
        ]);

        return redirect()->route('categories.index')->with('alert', 'Thêm dữ liệu thành công!');
    }
    public function edit($id)
    {
        $categories = Category::find($id);
        if(!$categories){
            return redirect()->back();
        }
        return view('admin.category.edit', compact('categories'));
    }
    public function update(EditCategoryRequest $request, $id)
    {
        $cate = Category::find($id);
        if(!$cate){
            return redirect()->back();
        }
        $cate->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'enable' => $request->enable,
        ]);
        return redirect()->route('categories.index')->with('message', 'Cập nhật dữ liệu thành công!');
    }
    public function ActiveCate($cate_id)
    {
        Category::where('id', $cate_id)->update(['enable' => 1]);
        return redirect()->back()->with('active', 'Danh mục đã được hiển thị!');
    }
    public function UnActiveCate($cate_id)
    {
        Category::where('id', $cate_id)->update(['enable' => 0]);
        return redirect()->back()->with('unactive', 'Danh mục đã được ẩn!');
    }
}
