<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;

class TheLoaiController extends Controller
{
    //
    public function getList()
    {
    	$theloai = TheLoai::all();
    	return view("admin.theloai.list",['theloai'=>$theloai]);
    }

    public function getAdd()
    {
    	return view("admin.theloai.add");
    }

    public function store(Request $request)
    {
        $errors = [
            "Ten" => "required|unique:TheLoai,Ten|min:3|max:100"
        ];

        $messages = [
            "Ten.required" => "Trường bắt buộc",
            "Ten.unique" => "Tên thể loại tồn tại",
            "Ten.min" => "Vui lòng nhập ít nhất 3 ký tự",
            "Ten.max" => "Vui lòng nhập nhiều nhất 100 ký tự"
        ];
    	$this->validate($request,$errors,$messages);

        $theloai = new TheLoai;
        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();

        return redirect()->route("theloai.add")->with("thongbao","Thêm thành công");
    }

    public function getEdit($id)
    {
        $theloai = TheLoai::find($id);
    	return view("admin.theloai.edit",['theloai'=>$theloai]);
    }

    public function edit($id,Request $request)
    {
        $theloai = TheLoai::find($id);
        $errors = [
            "Ten" => "required|unique:TheLoai,Ten|min:3|max:30"
        ];

        $messages = [
            "Ten.required" => "Trường bắt buộc",
            "Ten.unique" => "Tên thể loại đã tồn tại",
            "Ten.min" => "Vui lòng nhập ít nhất 3 ký tự",
            "Ten.max" => "Vui lòng nhập nhiều nhất 100 ký tự"
        ];

        $this->validate($request,$errors,$messages);

        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();

        return redirect()->route("theloai.edit",$id)->with("thongbao","Sửa thành công");
    }

    public function getDelete($id)
    {
        $theloai = TheLoai::find($id);
        $theloai->delete();

        return redirect()->route("theloai.list")->with("thongbao","Xóa thành công");
    }
}
