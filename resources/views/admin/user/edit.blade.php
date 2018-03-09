@extends('admin.layouts.index')

@section('content')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>{{ $user->name }}</small>
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

                        <form action="{{ route('user.postEdit',$user->id) }}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label>Tên</label>
                                <input class="form-control" name="name" value="{{ $user->name }}" placeholder="Vui lòng điền tên user" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" value="{{ $user->email }}" name="email" placeholder="Vui lòng điền email" readonly />
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="checkbox" name="checkPassword">
                                <label>Đổi mật khẩu</label>
                                <input type="password" class="form-control password" name="password" placeholder="Password" disabled />
                            </div>
                            <div class="form-group">
                                <label>Re-password</label>
                                <input type="password" class="form-control password" name="re-password" placeholder="Password" disabled />
                            </div>
                            <div class="form-group">
                                <label>Quyền</label>
                                <label class="radio-inline">
                                    <input type="radio" name="quyen"
                                    @if($user->quyen == 1)
                                        {{ "checked='true'" }}
                                    @endif
                                     value="1"> Admin
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="quyen"
                                    @if($user->quyen == 0)
                                        {{ "checked='true'" }}
                                    @endif
                                     value="0"> CTV
                                </label>
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

@section('script')
    <script>
        $(document).ready(function(){
            $('#checkbox').on("click",function(){
                // if($(this).prop("checked") == true)
                if($(this).is(":checked"))
                {
                    $(".password").removeAttr("disabled");
                }
                else
                {
                    $('.password').attr("disabled","true");
                }
            })
        })
    </script>
@endsection