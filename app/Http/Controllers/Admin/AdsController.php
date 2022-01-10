<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ads\AddAdsRequest;
use App\Http\Requests\Ads\EditAdsRequest;
use App\Models\Ads;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request['keyword'] ?? "";
        if ($search != "") {
            $ads = Ads::where('price', 'like', "%" . $request->keyword . "%")->paginate(30);
        } else {
            $ads = Ads::orderBy('id', 'DESC')->paginate(20);
            $ads->load('user');
        }
        return view('admin.ads.index', compact('ads', 'search'));
    }
    public function add()
    {
        return view('admin.ads.create');
    }
    public function store(AddAdsRequest $request)
    {
        $ads = new Ads();
        $ads->fill($request->all());
        if ($request->hasFile('image')) {
            $name = uniqid() . '-' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs(
                'public\images\ads',
                $name
            );
            $ads['image'] = 'images/ads/' . $name;
        }
        $ads->save();
        return redirect()->route('ads.index')->with('alert', 'Thêm dữ liệu thành công!');
    }
    public function edit($id)
    {
        $ads = Ads::find($id);
        return view('admin.ads.edit', compact('ads'));
    }
    public function update(EditAdsRequest $request, $id)
    {
        // dd($request->all());
        $ads = Ads::find($id);
        if (!$ads) {
            return redirect()->back();
        }
        if ($request->hasFile('image')) {
            if (File::exists(public_path() . '/storage/' . $ads->image)) {
                File::delete(public_path() . '/storage/' . $ads->image);
            }
        }
        $ads->fill($request->all());
        if ($request->hasFile('image')) {
            $newFileName = uniqid() . '-' . $request->image->getClientOriginalName();
            $path = $request->image->storeAs('public/images/ads', $newFileName);
            $ads->image = str_replace('public/', '', $path);
        }
        $ads->save();
        return redirect()->route('ads.index')->with('success', 'Cập nhật dữ liệu thành công!');
    }
    public function delete($id)
    {
        $ads = Ads::findOrFail($id);
        if (!$ads) {
            return redirect()->back();
        }
        $file_name = $ads->image;
        $file_path = public_path('storage/' . $file_name);
        unlink($file_path);
        $ads->delete();
        return redirect()->back()->with('message', 'Xóa dữ liệu thành công!');
    }
}
