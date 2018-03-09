<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;
use App\TinTuc;

class AjaxController extends Controller
{
    public function getLoaiTin($id)
    {
        $loaitin = LoaiTin::where("idTheLoai",$id)->get();
        foreach ($loaitin as $key => $value) {
            echo "<option value='".$value->id."''>".$value->Ten."</option>";
        }
    }
}
