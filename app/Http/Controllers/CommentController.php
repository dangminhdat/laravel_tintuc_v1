<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;
use App\TinTuc;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function deleteComment($id,$idTinTuc)
    {
        $comment = Comment::find($id);
        $comment->delete();

        return redirect()->route("tintuc.edit",$idTinTuc)->with("thongbao","Xóa bình luận thành công");
    }

    public function postComment($id,Request $request)
    {
    	$errors = [
    		"NoiDung" => "required"
    	];

    	$messages = [
    		"NoiDung.required" => "Vui lòng nhập bình luận"
    	];

    	$this->validate($request,$errors,$messages);

    	$comment = new Comment;
    	$comment->idUser = Auth::user()->id;
    	$comment->idTinTuc = $id;
    	$comment->NoiDung = $request->NoiDung;

    	$comment->save();
    	return redirect()->route('pages.tintuc',$id)->with('thongbao',"Thêm bình luận thành công");
    }
}
