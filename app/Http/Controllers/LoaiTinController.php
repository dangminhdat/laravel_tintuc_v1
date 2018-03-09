<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;

class LoaiTinController extends Controller
{
    //
    public function getList()
    {
    	$loaitin = LoaiTin::all();
    	return view("admin.loaitin.list",['loaitin'=>$loaitin]);
    }

    public function getAdd()
    {
        $theloai = TheLoai::all();
    	return view("admin.loaitin.add",['theloai'=>$theloai]);
    }

    public function store(Request $request)
    {
        $errors = [
            "Ten" => "required|unique:LoaiTin,Ten|min:3|max:100",
            "TheLoai" => "required"
        ];

        $messages = [
            "Ten.required" => "Trường bắt buộc",
            "Ten.min" => "Vui lòng nhập ít nhất 3 ký tự",
            "Ten.max" => "Vui lòng nhập nhiều nhất 100 ký tự",
            "TheLoai.required" => "Vui lòng chọn thể loại"
        ];
    	$this->validate($request,$errors,$messages);

        $loaitin = new LoaiTin;
        $loaitin->Ten = $request->Ten;
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->save();

        return redirect()->route("loaitin.add")->with("thongbao","Thêm thành công");
    }

    public function getEdit($id)
    {
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::find($id);
    	return view("admin.loaitin.edit",['loaitin'=>$loaitin,"theloai"=>$theloai]);
    }

    public function edit($id,Request $request)
    {
        $loaitin = LoaiTin::find($id);
        $errors = [
            "Ten" => "required|unique:LoaiTin,Ten|min:3|max:30",
            "TheLoai" => "required"
        ];

        $messages = [
            "Ten.required" => "Trường bắt buộc",
            "Ten.unique" => "Tên thể loại đã tồn tại",
            "Ten.min" => "Vui lòng nhập ít nhất 3 ký tự",
            "Ten.max" => "Vui lòng nhập nhiều nhất 100 ký tự",
            "TheLoai.required" => "Vui lòng chọn thể loại"
        ];

        $this->validate($request,$errors,$messages);

        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->save();

        return redirect()->route("loaitin.edit",$id)->with("thongbao","Sửa thành công");
    }

    public function getDelete($id)
    {
        $loaitin = LoaiTin::find($id);
        $loaitin->delete();

        return redirect()->route("loaitin.list")->with("thongbao","Xóa thành công");
    }
}
