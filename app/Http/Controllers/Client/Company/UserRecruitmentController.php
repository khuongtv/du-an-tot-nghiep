<?php

namespace App\Http\Controllers\client\company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use App\Models\Category;
use App\Models\Location;
use App\Models\UserFile;
use App\Models\UserRecruitment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use SebastianBergmann\Environment\Console;

class UserRecruitmentController extends Controller
{
    public function editForm($id)
    {
        $cate = Category::all();
        $loca = Location::all();
        $company = UserRecruitment::find($id);
        return view('client.company.userCompany.index', compact('company', 'cate', 'loca'));
    }
    public function saveEdit($id, CompanyRequest $request)
    {
        $model = UserRecruitment::find($id);
        if (!$model) {
            return redirect()->back();
        }
        //map
//
        if ($request->hasFile('image')) {
            if (File::exists(public_path() . '/storage/' . $model->image) && $model->image != "images/avatar/none.jpg") {
                File::delete(public_path() . '/storage/' . $model->image);
            }
        }
        if ($request->hasFile('avatar')) {
            if (File::exists(public_path() . '/storage/' . $model->avatar) && $model->avatar != "images/avatar/none.jpg") {
                File::delete(public_path() . '/storage/' . $model->avatar);
            }
        }
        if ($request->hasFile('banner')) {
            if (File::exists(public_path() . '/storage/' . $model->banner) && $model->banner != "images/avatar/none.jpg") {
                File::delete(public_path() . '/storage/' . $model->banner);
            }
        }

        $model->fill($request->all());
        $string_map = $request->map;
        preg_match('/src="([^"]+)"/', $string_map, $match);
        if(count($match)== 2){
            $link_map = $match[1];
        }
        else{
            $link_map = $request->map;
        }
        $model->map = $link_map;
        if ($request->hasFile('image')) {
            $newFileName = uniqid() . '-' . $request->image->getClientOriginalName();
            $path = $request->image->storeAs('public/images/company', $newFileName);
            $model->image = str_replace('public/', '', $path);
        }
        if ($request->hasFile('avatar')) {
            $newFileName = uniqid() . '-' . $request->avatar->getClientOriginalName();
            $path = $request->avatar->storeAs('public/images/company', $newFileName);
            $model->avatar = str_replace('public/', '', $path);
        }
        if ($request->hasFile('banner')) {
            $newFileName = uniqid() . '-' . $request->banner->getClientOriginalName();
            $path = $request->banner->storeAs('public/images/company', $newFileName);
            $model->banner = str_replace('public/', '', $path);
        };
        $model->save();

//        if ($request->hasFile('file')) {
//
//        };
        if($request->hasFile('file')){
            $userFile = UserFile::where('user_id',$model->id)->first();
            if($userFile){
                if (File::exists(public_path() . '/storage/' . $userFile->file)) {
                    File::delete(public_path() . '/storage/' . $userFile->file);
                }
                $userFile->name = $model->name;
                $userFile->user_id = Auth::user()->id;

                $newFileName = uniqid() . '-' . $request->file->getClientOriginalName();
                $path = $request->file->storeAs('public/files/recruitment', $newFileName);
                $userFile->file = str_replace('public/', '', $path);
                $userFile->save();

            } else{
                $userFile2 = new UserFile();
                $userFile2->name = $model->name;
                $userFile2->user_id = Auth::user()->id;

                $newFileName = uniqid() . '-' . $request->file->getClientOriginalName();
                $path = $request->file->storeAs('public/files/recruitment', $newFileName);
                $userFile2->file = str_replace('public/', '', $path);
                $userFile2->save();
            }
        }
//        if ($request->hasFile('file')) {
//
//        };

        // return redirect('/nha-tuyen-dung/user-nha-tuyen-dung?mess=Cập nhật dữ liệu thành công');

        return redirect()->back()->with('msg', 'Cập nhật dữ liệu thành công');
    }
}
