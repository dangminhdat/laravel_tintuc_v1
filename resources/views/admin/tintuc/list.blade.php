@extends('admin.layouts.index')

@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin tức
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
                                <th>Tên</th>
                                <th>Tóm Tắt</th>
                                <th>Thể Loại</th>
                                <th>Loại Tin</th>
                                <th>Xem</th>
                                <th>Nổi Bật</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tintuc as $value)
                            <tr class="odd gradeX" align="center">
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->TieuDe }}
                                    <img style="display: block;" width="100" height="100" src="upload/tintuc/{{ $value->Hinh }}" alt="">
                                </td>
                                <td>{{ $value->TomTat }}</td>
                                <td>{{ $value->loaitin->theloai->Ten }}</td>
                                <td>{{ $value->loaitin->Ten }}</td>
                                <td>{{ $value->SoLuotXem }}</td>
                                <td>
                                    @if($value->NoiBat == 1) {{ "Có" }}
                                    @else {{ "Không" }}
                                    @endif
                                </td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="{{ route('tintuc.delete',$value->id) }}"> Xóa</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{ route('tintuc.edit',$value->id) }}"> Sửa</a></td>
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