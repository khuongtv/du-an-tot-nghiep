<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Keyword\AddKeywordRequest;
use App\Http\Requests\Keyword\EditKeywordRequest;
use App\Models\Keyword;
use Illuminate\Http\Request;

class KeywordController extends Controller
{
    public function index(Request $request)
    {
        $search = $request['keyword'] ?? "";
        if ($search != "") {
            $keywords = Keyword::where('keyword', 'like', "%" . $request->keyword . "%")->paginate(30);
        } else {
            $keywords = Keyword::orderBy('id', 'DESC')->paginate(20);
        }
        return view('admin.keywords.index', compact('keywords', 'search'));
    }
    public function add()
    {
        return view('admin.keywords.create');
    }
    public function store(AddKeywordRequest $request)
    {
        Keyword::create([
            'keyword' => $request->keyword
        ]);
        return redirect()->route('keyword.index')->with('alert', 'Thêm dữ liệu thành công!');
    }
    public function edit($id)
    {
        $key = Keyword::find($id);
        if(!$key){
            return redirect()->back();
        }
        return view('admin.keywords.edit', compact('key'));
    }
    public function update(EditKeywordRequest $request, $id)
    {
        $keyword = Keyword::find($id);
        if(!$keyword){
            return redirect()->back();
        }
        $keyword->update([
            'keyword' => $request->keyword
        ]);
        return redirect()->route('keyword.index')->with('success', 'Cập nhật dữ liệu thành công!');
    }
    public function delete($id)
    {
        $keyword = Keyword::find($id);
        if(!$keyword){
            return redirect()->back();
        }
        $keyword->delete();
        return redirect()->back()->with('message', 'Xóa dữ liệu thành công!');
    }
}
