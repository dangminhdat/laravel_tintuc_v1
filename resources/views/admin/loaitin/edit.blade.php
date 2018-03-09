@extends('admin.layouts.index')

@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Loại tin
                            <small>{{ $loaitin->Ten }}</small>
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

                        <form action="{{ route('loaitin.postEdit',$loaitin->id) }}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label>Tên thể loại</label>
                                <select class="form-control" name="TheLoai">
                                    @foreach($theloai as $value)
                                        <option 
                                        @if($value->id == $loaitin->idTheLoai)
                                            {{ "selected='selected'" }}
                                        @endif
                                         value="{{ $value->id }}">{{ $value->Ten }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tên loại tin</label>
                                <input class="form-control" name="Ten" value="{{ $loaitin->Ten }}" placeholder="Vui lòng nhập loại tin" />
                            </div>
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection