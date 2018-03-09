<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\LoaiTin;
use App\TheLoai;
use App\TinTuc;
use App\Slide;
use App\User;

class UserController extends Controller
{
    public function getList()
    {
    	$user = User::all();
    	return view("admin.user.list",["user"=>$user]);
    }

    public function getAdd()
    {
    	return view("admin.user.add");
    }

    public function store(Request $request)
    {
    	$errors = [
    		"name" => "required|min:3",
    		"email" => "required|email|unique:users,email",
    		"password" => "required|min:6|max:32",
    		"re-password" => "required|same:password"
    	];

    	$messages = [
    		"name.required" => "Vui lòng nhập tên user",
    		"name.min" => "Vui lòng nhập tên user ít nhất 3 ký tự",
    		"email.required" => "Vui lòng nhập email",
    		"email.email" => "Vui lòng nhập đúng định dạng email",
    		"email.unique" => "Email đã tồn tại",
    		"password.required" => "Vui lòng nhập mật khẩu",
    		"password.min" => "Mật khẩu có ít nhất 6 ký tự",
    		"password.max" => "Mật khẩu tối đa 32 ký tự",
    		"re-password.required" => "Vui lòng nhập mật khẩu nhập lại",
    		"re-password.same" => "Mật khẩu nhập lại chưa đúng"
    	];

    	$this->validate($request,$errors,$messages);

    	$user = new User;
    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->password = bcrypt($request->password);
    	$user->quyen = $request->quyen;

    	$user->save();

    	return redirect()->route("user.add")->with("thongbao","Thêm thành công");
    }

    public function getEdit($id)
    {
    	$user = User::find($id);
    	return view("admin.user.edit",["user"=>$user]);
    }

    public function edit($id,Request $request)
    {
    	$errors = [
    		"name" => "required|min:3"
    	];

    	$messages = [
    		"name.required" => "Vui lòng nhập tên user",
    		"name.min" => "Vui lòng nhập tên user ít nhất 3 ký tự"
    	];

    	$this->validate($request,$errors,$messages);

    	$user = User::find($id);
    	$user->name = $request->name;
    	$user->quyen = $request->quyen;

    	if($request->checkPassword == "on")
    	{
    		$errors = [
	    		"password" => "required|min:6|max:32",
	    		"re-password" => "required|same:password"
	    	];

	    	$messages = [
	    		"password.required" => "Vui lòng nhập mật khẩu",
	    		"password.min" => "Vui lòng nhập tên user ít nhất 6 ký tự",
	    		"password.max" => "Mật khẩu tối đa 32 ký tự",
	    		"re-password.required" => "Vui lòng nhập mật khẩu nhập lại",
	    		"re-password.same" => "Mật khẩu nhập lại chưa đúng"
	    	];

	    	$this->validate($request,$errors,$messages);

    		$user->password = bcrypt($request->password);
    	}

    	$user->save();

    	return redirect()->route("user.edit",$id)->with("thongbao","Sửa thành công");
    }

    public function getDelete($id)
    {
    	$user = User::find($id);
    	$user->delete();

    	return redirect()->route("user.list")->with("thongbao","Xóa thành công");
    }

    public function getDangNhap()
    {
        return view("admin.login");
    }

    public function postDangNhap(Request $request)
    {
        $errors = [
            "email" => "required|email",
            "password" => "required|min:6|max:32"
        ];

        $messages = [
            "email.required" => "Vui lòng nhập email",
            "email.email" => "Email chưa đúng định dạng",
            "password.required" => "Vui lòng nhập password",
            "password.min" => "Mật khẩu có ít nhất 3 ký tự",
            "password.max" => "Mật khẩu có nhiều nhất 32 ký tự"
        ];

        $this->validate($request,$errors,$messages);

        if(Auth::attempt(["email"=>$request->email,"password"=>$request->password]))
        {
            return redirect()->route("theloai.list");
        }
        else
        {
            return redirect()->route("admin.dangnhap")->with("loi","Sai tài khoản hoặc mật khẩu");
        }
    }

    public function getDangXuat()
    {
        Auth::logout();
        return redirect()->route("admin.dangnhap");
    }
}
