<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoaiTin extends Model
{
    //
    protected $table = "loaitin";
    // public $timestamps = false;

    public function theloai()
    {
    	return $this->belongsTo('App\TheLoai','idTheLoai','id');
    }

    public function tintuc()
    {
    	return $this->hasMany('App\TinTuc','idLoaiTin','id');
    }
}
