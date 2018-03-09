@extends('admin.layouts.index')

@section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin tức
                            <small>{{ $tintuc->TieuDe }}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                    @if(count($errors) > 0)
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger">
                                <strong>{{ $error }}</strong>
                            </div>
                        @endforeach
                    @endif

                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            <strong>{{ session('thongbao') }}</strong>
                        </div>
                    @endif

                    @if(session('loi'))
                        <div class="alert alert-danger">
                            <strong>{{ session('loi') }}</strong>
                        </div>
                    @endif

                        <form action="{{ route('tintuc.postEdit',$tintuc->id) }}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label>Tên thể loại</label>
                                <select class="form-control" name="TheLoai" id="TheLoai">
                                    @foreach($theloai as $value)
                                    <option 
                                    @if($tintuc->loaitin->theloai->id == $value->id)
                                        {{ 'selected="selected"' }}
                                    @endif
                                     value="{{ $value->id }}">{{ $value->Ten }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tên loại tin</label>
                                <select class="form-control" name="LoaiTin" id="LoaiTin">
                                    @foreach($loaitin as $value)
                                    <option
                                    @if($tintuc->loaitin->id == $value->id)
                                        {{ 'selected="selected"' }}
                                    @endif
                                     value="{{ $value->id }}">{{ $value->Ten }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input class="form-control" name="TieuDe" value="{{ $tintuc->TieuDe }}" placeholder="Vui lòng điền tiêu đề" />
                            </div>
                            <div class="form-group">
                                <label>Tóm tắt</label>
                                <textarea class="form-control ckeditor" name="TomTat" rows="3" id="demo">{{ $tintuc->TomTat  }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Nội Dung</label>
                                <textarea class="form-control ckeditor" name="NoiDung" rows="3" id="demo">{{ $tintuc->NoiDung }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <p><img width="400" src="upload/tintuc/{{ $tintuc->Hinh }}" alt=""></p>
                                <input type="file" class="form-control" name="Hinh" id="Hinh">
                            </div>
                            <div class="form-group">
                                <label>Nổi Bật</label>
                                <label class="radio-inline">
                                    <input name="NoiBat" value="1" 
                                    @if($tintuc->NoiBat == 1)
                                        {{ 'checked="true"'}}
                                    @endif
                                     type="radio">Có
                                </label>
                                <label class="radio-inline">
                                    <input name="NoiBat" value="0" 
                                    @if($tintuc->NoiBat == 1)
                                        {{ 'checked="true"'}}
                                    @endif
                                     type="radio">Không
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->

                 <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Bình luận
                            <small>list</small>
                        </h1>
                        @if(session('thongbao'))
                            <div class="alert alert-success">
                                <strong>{{ session('thongbao') }}</strong>
                            </div>
                        @endif
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Người dùng</th>
                                <th>Nội Dung</th>
                                <th>Ngày đăng</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tintuc->comment as $value)
                            <tr class="odd gradeX" align="center">
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->user->name }}</td>
                                <td>{{ $value->NoiDung }}</td>
                                <td>{{ $value->created_at }}</td>
                                <td class="center"><i class="fa fa-trash-o fa-fw"></i><a href="{{ route('tintuc.comment',[$value->id,$tintuc->id]) }}"> Xóa</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#TheLoai').on("change",function(){
                $id = $(this).val();
                $.ajax({
                    url : "admin/ajax/loaitin/"+$id,
                    type: "get",
                    data : {
                        id : $id
                    },
                    success: function(data){
                        $('#LoaiTin').html(data);
                    }
                });
            });
        });
    </script>
@endsection