<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;
use App\TinTuc;
use App\Slide;

class SlideController extends Controller
{
    public function getList()
    {
    	$slide = Slide::all();
    	return view("admin.slide.list",["slide"=>$slide]);
    }

    public function getAdd()
    {
    	return view("admin.slide.add");
    }

    public function store(Request $request)
    {
    	$errors = [
    		"Ten" => "required|min:3|unique:Slide,Ten",
    		"NoiDung" => "required"
    	];

    	$messages = [
    		"Ten.required" => "Trường Tên bắt buộc",
    		"Ten.min" => "Tên slide có ít nhất 3 ký tự",
    		"Ten.unique" => "Tên slide đã tồn tại",
    		"NoiDung.required" => "Trường Nội Dung bắt buộc"
    	];

    	$this->validate($request,$errors,$messages);
    	$slide = new Slide;
    	$slide->Ten = $request->Ten;
    	$slide->NoiDung = $request->NoiDung;
    	$slide->link = $request->link;

    	if($request->hasFile("Hinh"))
    	{
    		$file = $request->file("Hinh");
    		$ext = $file->getClientOriginalExtension();
    		if($ext != "jpg" && $ext != "png" && $ext != "jpeg")
    		{
    			return redirect()->route("slide.add")->with("loi","Lỗi định dạng ảnh");
    		}
    		$name = $file->getClientOriginalName();
    		$hinh = str_random(4)."_".$name;
    		while (file_exists("upload/slide/".$hinh)) 
    		{
    			$hinh = str_random(4)."_".$name;
    		}
    		$file->move("upload/slide",$hinh);
    		$slide->Hinh = $hinh;
    	}
    	else
    	{
    		$slide->Hinh = "";
    	}
    	$slide->save();

    	return redirect()->route("slide.add")->with("thongbao","Thêm thành công");
    }

    public function getEdit($id)
    {
    	$slide = Slide::find($id);
    	return view("admin.slide.edit",["slide"=>$slide]);
    }

    public function edit($id,Request $request)
    {
    	$errors = [
    		"Ten" => "required|min:3|unique:Slide,Ten",
    		"NoiDung" => "required"
    	];

    	$messages = [
    		"Ten.required" => "Trường Tên bắt buộc",
    		"Ten.min" => "Tên slide có ít nhất 3 ký tự",
    		"Ten.unique" => "Tên slide đã tồn tại",
    		"NoiDung.required" => "Trường Nội Dung bắt buộc"
    	];

    	$this->validate($request,$errors,$messages);
    	$slide = Slide::find($id);
    	$slide->Ten = $request->Ten;
    	$slide->NoiDung = $request->NoiDung;
    	$slide->link = $request->link;

    	if($request->hasFile("Hinh"))
    	{
    		$file = $request->file("Hinh");
    		$ext = $file->getClientOriginalExtension();
    		if($ext != "jpg" && $ext != "png" && $ext != "jpeg")
    		{
    			return redirect()->route("slide.add")->with("loi","Lỗi định dạng ảnh");
    		}
    		$name = $file->getClientOriginalName();
    		$hinh = str_random(4)."_".$name;
    		while (file_exists("upload/slide/".$hinh)) 
    		{
    			$hinh = str_random(4)."_".$name;
    		}
    		unlink("upload/slide/".$slide->Hinh);
    		$file->move("upload/slide",$hinh);
    		$slide->Hinh = $hinh;
    	}
    	$slide->save();

    	return redirect()->route("slide.edit",$slide->id)->with("thongbao","Sửa thành công");
    }

    public function getDelete($id)
    {
    	$slide = Slide::find($id);
    	$slide->delete();

    	return redirect()->route("slide.list")->with("thongbao","Xóa thành công");
    }
}
