<?php

namespace App\Http\Controllers\Client\Company;
use Illuminate\Support\Facades\Auth;
use App\Models\Apply;
use App\Models\Blogs;
use App\Models\ApplyDetail;
use App\Models\Usercandidate;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;


class ApplysController extends Controller
{
    public function index(Request $request){
        $blogQuery = Blog::orderByDesc('user_recruitment_id')->where('title' , 'like' , "%".$request->keyword."%")->where('user_recruitment_id',Auth::user()->id);
        $blog = $blogQuery->paginate(10);
        $blog->load('apply');
        return view('client.company.apply.index' , compact('blog'));
    }
    public function detail($id){
        $blog = Blog::where("id", "=", "$id")->get();
        $apply = Apply::where("blog_id", "=", "$id")->latest()->paginate(2);;

        return view('client.company.apply.detail' , compact('apply','blog','id'));
    }
    public function update(Request $request){
        $id = $request -> id;
        $apply = Apply::find($id);
        $newdata= [];
        $newdata['status'] =  $request->act;
        $apply->update($newdata);
    }
    public function addNote(Request $request){
      $model = new ApplyDetail;
      $model->fill($request->all());
      $model->save();

      return 'Thành công';
    }


    public function listNote($id)
    {
        $detail = ApplyDetail::where('apply_id', $id)->orderByDesc('id')->get();
        $cv = Apply::find($id);

        $html = '<ul style="padding: 0;">';

        if (!isset($detail[0])) {
            $html .= '<p>Không có ghi chú nào!</p>';
        }

        foreach ($detail as $d) {
            $html .= '
            <div ></div>
            <li style="padding:10px; display: flex; justify-content: space-between; border-left: 2px solid #ff8a00;">

                <p style="  margin:-35px 0 0 20px; padding:20px 0; width:60%;text-align: justify;">' . $d->name . '</p>
                <span style="float: right; font-size: 11px;margin:-35px 0 0 0; padding:20px 0;font-weight:bold; color:#ff8a00;">' . date("H:i d-m", strtotime($d->created_at)) . '</span>
                <a onclick="return ConfirmDelete('.$d->id.','.$cv->id.');" style="color:red; font-size: 20px;margin-top: -10px" id="delete_'.$d->id.'" data-id_note="' .$d->id .'"><i class="icon-feather-delete"></i></a>
            </li>
        ';
        }
        return $html;
    }
    public function deleteNote(Request $request){
        $id = $request->note_id;
        ApplyDetail::destroy($id);

        return 'Thành công';

    }


}
