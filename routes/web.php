<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',["as"=>"localhost","uses"=>"PageController@trangchu"]);

Route::get("admin/dangnhap",["as"=>"admin.dangnhap","uses"=>"UserController@getDangNhap"]);

Route::post("admin/dangnhap",["as"=>"admin.postDangNhap","uses"=>"UserController@postDangNhap"]);

Route::get("admin/logout",["as"=>"admin.logout","uses"=>"UserController@getDangXuat"]);

Route::group(["prefix"=>"admin","middleware"=>"adminLogin"],function(){
	Route::group(["prefix"=>"theloai"],function(){
		//admin/theloai/list
		Route::get("list",["as"=>"theloai.list","uses"=>"TheLoaiController@getList"]);
		//admin/theloai/edit
		Route::get("edit/{id}",["as"=>"theloai.edit","uses"=>"TheLoaiController@getEdit"]);
		//admin/theloai/add
		Route::get("add",["as"=>"theloai.add","uses"=>"TheLoaiController@getAdd"]);

		Route::post("add",['as'=>"theloai.postAdd","uses"=>"TheLoaiController@store"]);

		Route::post("edit/{id}",["as"=>"theloai.postEdit","uses"=>"TheLoaiController@edit"]);

		Route::get("delete/{id}",["as"=>"theloai.delete","uses"=>"TheLoaiController@getDelete"]);
	});

	Route::group(["prefix"=>"loaitin"],function(){
		//admin/theloai/list
		Route::get("list",["as"=>"loaitin.list","uses"=>"LoaiTinController@getList"]);
		//admin/theloai/edit
		Route::get("edit/{id}",["as"=>"loaitin.edit","uses"=>"LoaiTinController@getEdit"]);
		//admin/theloai/add
		Route::get("add",["as"=>"loaitin.add","uses"=>"LoaiTinController@getAdd"]);

		Route::post("add",['as'=>"loaitin.postAdd","uses"=>"LoaiTinController@store"]);

		Route::post("edit/{id}",["as"=>"loaitin.postEdit","uses"=>"LoaiTinController@edit"]);

		Route::get("delete/{id}",["as"=>"loaitin.delete","uses"=>"LoaiTinController@getDelete"]);
	});

	Route::group(["prefix"=>"tintuc"],function(){
		//admin/theloai/list
		Route::get("list",["as"=>"tintuc.list","uses"=>"TinTucController@getList"]);
		//admin/theloai/edit
		Route::get("edit/{id}",["as"=>"tintuc.edit","uses"=>"TinTucController@getEdit"]);
		//admin/theloai/add
		Route::get("add",["as"=>"tintuc.add","uses"=>"TinTucController@getAdd"]);

		Route::post("add",["as"=>"tintuc.postAdd","uses"=>"TinTucController@store"]);

		Route::post("edit/{id}",["as"=>"tintuc.postEdit","uses"=>"TinTucController@edit"]);

		Route::get("delete/{id}",["as"=>"tintuc.delete","uses"=>"TinTucController@getDelete"]);
	});

	Route::group(["prefix"=>"comment"],function(){
		Route::get("delete/{id}/{idTinTuc}",["as"=>"tintuc.comment","uses"=>"CommentController@deleteComment"]);
	});

	Route::group(["prefix"=>"slide"],function(){
		//admin/theloai/list
		Route::get("list",["as"=>"slide.list","uses"=>"SlideController@getList"]);
		//admin/theloai/edit
		Route::get("edit/{id}",["as"=>"slide.edit","uses"=>"SlideController@getEdit"]);
		//admin/theloai/add
		Route::get("add",["as"=>"slide.add","uses"=>"SlideController@getAdd"]);

		Route::post("add",["as"=>"slide.postAdd","uses"=>"SlideController@store"]);

		Route::post("edit/{id}",["as"=>"slide.postEdit","uses"=>"SlideController@edit"]);

		Route::get("delete/{id}",["as"=>"slide.delete","uses"=>"SlideController@getDelete"]);
	});

	Route::group(["prefix"=>"user"],function(){
		//admin/theloai/list
		Route::get("list",["as"=>"user.list","uses"=>"UserController@getList"]);
		//admin/theloai/edit
		Route::get("edit/{id}",["as"=>"user.edit","uses"=>"UserController@getEdit"]);
		//admin/theloai/add
		Route::get("add",["as"=>"user.add","uses"=>"UserController@getAdd"]);

		Route::post("add",["as"=>"user.postAdd","uses"=>"UserController@store"]);

		Route::post("edit/{id}",["as"=>"user.postEdit","uses"=>"UserController@edit"]);

		Route::get("delete/{id}",["as"=>"user.delete","uses"=>"UserController@getDelete"]);
	});

	Route::group(["prefix"=>"ajax"],function(){
		Route::get("loaitin/{id}",["as"=>"loaitin.load","uses"=>"AjaxController@getLoaiTin"]);
	});
});

Route::get('trangchu',["as"=>"pages.trangchu","uses"=>"PageController@trangchu"]);

Route::get('tintuc/{id}.html',["as"=>"pages.tintuc","uses"=>"PageController@tintuc"]);

Route::get('{slug}/{id}.html',["as"=>"pages.loaitin","uses"=>"PageController@loaitin"]);

Route::get('lienhe',["as"=>"pages.lienhe","uses"=>"PageController@lienhe"]);

Route::get('gioithieu',["as"=>"pages.gioithieu","uses"=>"PageController@gioithieu"]);

Route::get('dangnhap',["as"=>"pages.getDangNhap","uses"=>"PageController@getDangNhap"]);

Route::get('dangxuat',["as"=>"pages.getDangXuat","uses"=>"PageController@getDangXuat"]);

Route::post('dangnhap',["as"=>"pages.postDangNhap","uses"=>"PageController@postDangNhap"]);

Route::post('comment/{id}',["as"=>"pages.comment","uses"=>"CommentController@postComment"]);

Route::get('nguoidung',["as"=>"pages.getNguoiDung","uses"=>"PageController@getNguoiDung"]);

Route::post('nguoidung',["as"=>"pages.postNguoiDung","uses"=>"PageController@postNguoiDung"]);

Route::get('dangky',["as"=>"pages.getDangKy","uses"=>"PageController@getDangKy"]);

Route::post('dangky',["as"=>"pages.postDangKy","uses"=>"PageController@postDangKy"]);

Route::post("timkiem",["as"=>"pages.timkiem","uses"=>"PageController@timkiem"]);
