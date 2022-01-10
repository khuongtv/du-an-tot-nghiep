<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Review\AddReviewRequest;
use App\Http\Requests\Review\EditReviewRequest;
use App\Models\Reviewer;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $search = $request['keyword'] ?? "";
        if ($search != "") {
            $review = Reviewer::where('name', 'like', "%" . $request->keyword . "%")->paginate(30);
        } else {
            $review = Reviewer::orderBy('id', 'DESC')->get();
        }
        return view('admin.review.index', compact('review'));
    }
    public function create()
    {
        return view('admin.review.create');
    }
    public function store(AddReviewRequest $request)
    {
        $model = new Reviewer();
        $model->fill($request->all());
        if ($request->hasFile('avatar')) {
            $name = uniqid() . '-' . $request->file('avatar')->getClientOriginalName();
            $request->file('avatar')->storeAs(
                'public\images\reviews',
                $name
            );
            $model['avatar'] = 'images/reviews/' . $name;
        }
        $model->save();
        return redirect()->route('review.index')->with('message', 'Thêm dữ liệu thành công!');
    }
    public function edit($id)
    {
        $review = Reviewer::find($id);
        if(!$review){
            return redirect()->back();
        }
        return view('admin.review.edit', compact('review'));
    }
    public function update(EditReviewRequest $request, $id)
    {
        $review = Reviewer::find($id);
        if(!$review){
            return redirect()->back();
        }
        if ($request->hasFile('avatar')) {
            if (File::exists(public_path() . '/storage/' . $review->avatar)) {
                File::delete(public_path() . '/storage/' . $review->avatar);
            }
        }
        $review->fill($request->all());
        if ($request->hasFile('avatar')) {
            $newFileName = uniqid() . '-' . $request->avatar->getClientOriginalName();
            $path = $request->avatar->storeAs('public/images/reviews', $newFileName);
            $review->avatar = str_replace('public/', '', $path);
        }
        $review->save();
        return redirect()->route('review.index')->with('alert', 'Cập nhật dữ liệu thành công!');
    }
    public function delete($id)
    {
        $review = Reviewer::findOrFail($id);
        if (File::exists(public_path() . '/storage/' . $review->avatar)) {
            File::delete(public_path() . '/storage/' . $review->avatar);
        }
        $review->delete();
        return redirect()->route('review.index')->with('message', 'Xóa dữ liệu thành công!');
    }
}
