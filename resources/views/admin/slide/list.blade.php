@extends('admin.layouts.index')

@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Slide
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
                                <th>Nội Dung</th>
                                <th>Hình</th>
                                <th>Link</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($slide as $value)
                            <tr class="odd gradeX" align="center">
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->Ten }}</td>
                                <td>{{ $value->NoiDung }}</td>
                                <td><img width="400" src="upload/slide/{{ $value->Hinh }}" alt=""></td>
                                <td>{{ $value->link }}</td>
                                <td class="center"><i class="fa fa-trash-o fa-fw"></i><a href="{{ route('slide.delete',$value->id) }}"> Xóa</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{ route('slide.edit',$value->id) }}">Sửa</a></td>
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