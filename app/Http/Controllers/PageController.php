<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use App\TheLoai;
use App\Slide;
use App\TinTuc;
use App\LoaiTin;
use App\User;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    //
	function __construct()
	{
		$theloai = TheLoai::all();
		$slide = Slide::all();
		View::share("theloai",$theloai);
		View::share("slide",$slide);
		if(Auth::check())
		{
			View::share('nguoidung',Auth::user());
		}
	}

    public function trangchu()
    {
	    return view("pages.trangchu");
	}

	public function lienhe()
	{
		return view("pages.lienhe");
	}

	public function gioithieu()
	{
		return view("pages.gioithieu");
	}

	public function loaitin($slug,$id)
	{
		$loaitin = LoaiTin::find($id);
		$tintuc = TinTuc::where("idLoaiTin",$id)->paginate(5);
		return view("pages.loaitin",["loaitin"=>$loaitin,"tintuc"=>$tintuc]);
	}
	public function tintuc($id)
	{
		$tintuc = TinTuc::find($id);
		$tinnoibat = TinTuc::where("NoiBat",1)->take(4)->get();
		$tinlienquan = TinTuc::where("idLoaiTin",$tintuc->idLoaiTin)->take(4)->get();
		return view("pages.tintuc",["tintuc"=>$tintuc,"tinnoibat"=>$tinnoibat,"tinlienquan"=>$tinlienquan]);
	}

	public function getDangNhap()
	{
		return view("pages.dangnhap");
	}

	public function postDangNhap(Request $request)
	{
		$errors = [
			"email" => "required|email",
			"password" => "required"
		];

		$messages = [
			"email.required" => "Vui lòng nhập email",
			"email.email" => "Email chưa đúng định dạng",
			"password.required" => "Vui lòng nhập mật khẩu"
		];
		$this->validate($request,$errors,$messages);

		if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
		{
			return redirect()->route('pages.trangchu');
		}
		else
		{
			return redirect()->route('pages.getDangNhap')->with('loi','Sai tài khoản hoặc mật khẩu');
		}

	}

	public function getDangXuat()
	{
		Auth::logout();
		return redirect()->route('pages.trangchu');
	}

	public function getNguoiDung()
	{
		$user = Auth::user();
		return view("pages.nguoidung",["user"=>$user]);
	}

	public function postNguoiDung(Request $request)
	{
		$errors = [
			"name" => "required|min:3"
		];

		$messages = [
			"name.required" => "Vui lòng nhập tên người dùng",
			"name.min" => "Tên người dùng có ít nhất 3 ký tự"
		];
		$this->validate($request,$errors,$messages);

		$user = Auth::user();
		$user->name = $request->name;

		if($request->checkpassword == "on")
		{
			$errors = [
				"password" => "required|min:3|max:32",
				"re-password" => "required|same:password"
			];

			$messages = [
				"password.required" => "Vui lòng nhập mật khẩu",
				"password.min" => "Mật khẩu có ít nhất 3 ký tự",
				"password.max" => "Mật khẩu có nhiều nhất 32 ký tự",
				"re-password.required" => "Vui lòng nhập mật khẩu nhập lại",
				"re-password.same" => "Mật khẩu nhập lại không đúng"
			];
			$this->validate($request,$errors,$messages);
			$user->password = bcrypt($request->password);
		}
		$user->save();

		return redirect()->route('pages.getNguoiDung')->with('thongbao','Sửa thành công');
	}

	public function getDangKy()
	{
		return view('pages.dangky');
	}
	public function postDangKy(Request $request)
	{
		$errors = [
			"name" => "required|min:3",
			"email" => "required|email|unique:users,email",
			"password" => "required|min:6|max:32",
			"re-password" => "required|same:password"
		];

		$messages = [
			"name.required" => "Vui lòng nhập tên người dùng",
			"name.min" => "Tên người dùng có ít nhất 3 ký tự",
			"email.required" => "Vui lòng nhập email",
			"email.unique" => "Email đã tồn tại",
			"email.email" => "Email chưa đúng định dạng",
			"password.required" => "Vui lòng nhập mật khẩu",
			"password.min" => "Mật khẩu có ít nhất 6 ký tự",
			"password.max" => "Mật khẩu có nhiều nhất 32 ký tự",
			"re-password.required" => "Vui lòng nhập mật khẩu nhập lại",
			"re-password.same" => "Mật khẩu nhập lại không đúng"
		];

		$this->validate($request,$errors,$messages);

		$user = new User;
		$user->name = $request->name;
		$user->email = $request->email;
		$user->quyen = 0;
		$user->password = bcrypt($request->password);

		$user->save();

		return redirect()->route('pages.getDangKy')->with('thongbao','Đăng ký tài khoản thành công');
	}

	public function timkiem(Request $request)
	{
		$tukhoa = $request->tukhoa;
		$tintuc = Tintuc::where('TieuDe','like',"%$tukhoa%")->orwhere('TomTat','like',"%$tukhoa%")->orwhere('NoiDung','like',"%$tukhoa%")->take(10)->orderBy('id','desc')->get();
		return view('pages.timkiem',['tintuc'=>$tintuc,'tukhoa'=>$tukhoa]);
	}
}
