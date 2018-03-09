@extends('admin.layouts.index')

@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Level</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user as $value)
                            <tr class="odd gradeX" align="center">
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->email }}</td>
                                <td>
                                    @if($value->quyen == 1)
                                        {{ "Admin" }}
                                    @else
                                        {{ "CTV" }}
                                    @endif
                                </td>
                                <td class="center"><i class="fa fa-trash-o fa-fw"></i><a href="{{ route('user.delete',$value->id) }}"> Xóa</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="{{ route('user.edit',$value->id) }}"> Sửa</a></td>
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