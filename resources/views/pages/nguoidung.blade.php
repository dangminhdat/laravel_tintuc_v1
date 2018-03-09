@extends('layouts.index')

@section('title')
{{ $user->name }}
@endsection

@section('content')
<!-- Page Content -->
    <div class="container">

    	<!-- slider -->
    	<div class="row carousel-holder">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
				  	<div class="panel-heading">Thông tin tài khoản</div>
				  	<div class="panel-body">
				    	<form action="{{ route('pages.postNguoiDung') }}" method="post">
				    	@if(session('thongbao'))
							<div class="alert alert-success">
								<strong>{{ session('thongbao') }}</strong>
							</div>
				    	@endif
				    		<input type="hidden" name="_token" value="{{ csrf_token() }}">
				    		<div>
				    			<label>Họ tên</label>
							  	<input type="text" class="form-control" placeholder="Tên tài khoản" name="name" aria-describedby="basic-addon1" value="{{ $user->name }}">
							</div>
							<br>
							<div>
				    			<label>Email</label>
							  	<input type="email" class="form-control" value="{{ $user->email }}" placeholder="Email" name="email" aria-describedby="basic-addon1" readonly />
							</div>
							<br>	
							<div>
								<input type="checkbox" name="checkpassword"  id="checkpassword" >
				    			<label>Đổi mật khẩu</label>
							  	<input type="password" class="form-control password" name="password" placeholder="Password" disabled>
							</div>
							<br>
							<div>
				    			<label>Nhập lại mật khẩu</label>
							  	<input type="password" class="form-control password" name="re-password" placeholder="Re-password" disabled>
							</div>
							<br>
							<button type="submit" class="btn btn-default">Sửa
							</button>

				    	</form>
				  	</div>
				</div>
            </div>
            <div class="col-md-2">
            </div>
        </div>
        <!-- end slide -->
    </div>
    <!-- end Page Content -->
@endsection

@section('script')
	<script>
		$(document).ready(function(){
			$('#checkpassword').on('click',function(){
				if($(this).is(":checked"))
				{
					$('.password').removeAttr('disabled');
				}
				else
				{
					$('.password').attr('disabled','true');
				}
			})
		})
	</script>
@endsection