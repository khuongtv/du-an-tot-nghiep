<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\UpdateSettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $search = $request['keyword'] ?? "";
        if ($search != "") {
            return;
        }
        $setting = DB::table('setting')->find(DB::table('setting')->max('id'));
        return view('admin.setting.edit', compact('setting', 'search'));
    }
    public function update(UpdateSettingRequest $request)
    {
        $setting = Setting::find(DB::table('setting')->max('id'));
        if ($request->hasFile('logo')) {
            if (File::exists(public_path() . '/storage/' . $setting->logo)) {
                File::delete(public_path() . '/storage/' . $setting->logo);
            }
        }
        $setting->fill($request->all());
        if ($request->hasFile('logo')) {
            $newFileName = uniqid() . '-' . $request->logo->getClientOriginalName();
            $path = $request->logo->storeAs('public/images/websites', $newFileName);
            $setting->logo = str_replace('public/', '', $path);
        }
        $setting->save();
        return redirect()->back()->with('message', 'Cập nhật dữ liệu thành công!');
    }
}
