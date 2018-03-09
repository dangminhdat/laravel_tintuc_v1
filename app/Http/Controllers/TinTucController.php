<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;
use App\TinTuc;

class TinTucController extends Controller
{
    //
    public function getList()
    {
    	$tintuc = TinTuc::orderBy("id","desc")->get();
        return view("admin.tintuc.list",["tintuc"=>$tintuc]);
    }

    public function getAdd()
    {
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
       return view("admin.tintuc.add",["theloai"=>$theloai,"loaitin"=>$loaitin]);
    }

    public function store(Request $request)
    {
        $errors = [
            "LoaiTin" => "required",
            "TieuDe" => "required|min:3|unique:TinTuc,TieuDe",
            "TomTat" => "required",
            "NoiDung" => "required"
        ];

        $messages = [
            "LoaiTin.required" => "Vui lòng chọn loại tin",
            "TieuDe.required" => "Vui lòng nhập tiêu đề",
            "TieuDe.min" => "Tiêu đề có ít nhất 3 ký tự",
            "TieuDe.unique" => "Tiêu đề đã tồn tại",
            "TomTat.required" => "Vui lòng nhập tóm tắt",
            "NoiDung.required" => "Vui lòng nhập nội dung"
        ];

        $this->validate($request,$errors,$messages);

        $tintuc = new TinTuc;
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->SoLuotXem = 0;

        if($request->hasFile('Hinh'))
        {
            $file = $request->file('Hinh');
            $ext = $file->getClientOriginalExtension();
            if($ext != "jpg" && $ext != "png" && $ext != "jpeg")
            {
                return redirect()->route("tintuc.add")->with("loi","Lỗi định dạng ảnh"); 
            }
            $name = $file->getClientOriginalName();
            $hinh = str_random(4)."_".$name;
            while(file_exists("upload/tintuc/".$hinh))
            {
                $hinh = str_random(4)."_".$name;
            }
            $file->move("upload/tintuc",$hinh);
            $tintuc->Hinh = $hinh;
        }
        else
        {
            $tintuc->Hinh = "";
        }

        $tintuc->save();

        return redirect()->route("tintuc.add")->with("thongbao","Thêm thành công");
    }

    public function getEdit($id)
    {
        $tintuc = TinTuc::find($id);
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        return view("admin.tintuc.edit",["tintuc"=>$tintuc,"theloai"=>$theloai,"loaitin"=>$loaitin]);
    }

    public function edit($id,Request $request)
    {
        $errors = [
            "LoaiTin" => "required",
            "TieuDe" => "required|min:3|unique:TinTuc,TieuDe",
            "TomTat" => "required",
            "NoiDung" => "required"
        ];

        $messages = [
            "LoaiTin.required" => "Vui lòng chọn loại tin",
            "TieuDe.required" => "Vui lòng nhập tiêu đề",
            "TieuDe.min" => "Tiêu đề có ít nhất 3 ký tự",
            "TieuDe.unique" => "Tiêu đề đã tồn tại",
            "TomTat.required" => "Vui lòng nhập tóm tắt",
            "NoiDung.required" => "Vui lòng nhập nội dung"
        ];

        $this->validate($request,$errors,$messages);

        $tintuc = TinTuc::find($id);
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->SoLuotXem = 0;

        if($request->hasFile('Hinh'))
        {
            $file = $request->file('Hinh');
            $ext = $file->getClientOriginalExtension();
            if($ext != "jpg" && $ext != "png" && $ext != "jpeg")
            {
                return redirect()->route("tintuc.edit",$id)->with("loi","Lỗi định dạng ảnh"); 
            }
            $name = $file->getClientOriginalName();
            $hinh = str_random(4)."_".$name;
            while(file_exists("upload/tintuc/".$hinh))
            {
                $hinh = str_random(4)."_".$name;
            }
            unlink("upload/tintuc/".$tintuc->Hinh);
            $file->move("upload/tintuc",$hinh);
            $tintuc->Hinh = $hinh;
        }

        $tintuc->save();

        return redirect()->route("tintuc.edit",$id)->with("thongbao","Thêm thành công");
    }

    public function getDelete($id)
    {
        $tintuc = TinTuc::find($id);
        $tintuc->delete();

        return redirect()->route("tintuc.list")->with("thongbao","Xóa thành công");
    }
}
