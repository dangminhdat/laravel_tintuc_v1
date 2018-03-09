@extends('layouts.index')

@section('title')
    Liên hệ
@endsection

@section('content')
<!-- Page Content -->
    <div class="container">

    	@include('layouts.slide')

        <div class="space20"></div>


        <div class="row main-left">
            @include('layouts.menu')

            <div class="col-md-9">
	            <div class="panel panel-default">            
	            	<div class="panel-heading" style="background-color:#337AB7; color:white;" >
	            		<h2 style="margin-top:0px; margin-bottom:0px;">Liên hệ</h2>
	            	</div>

	            	<div class="panel-body">
	            		<!-- item -->
                        <h3><span class="glyphicon glyphicon-align-left"></span> Thông tin liên hệ</h3>
					    
                        <div class="break"></div>
					   	<h4><span class= "glyphicon glyphicon-home "></span> Địa chỉ : </h4>
                        <p>41 Trần Quý Cáp, P. Vĩnh Điện, TX. Điện Bàn, T. Quảng Nam </p>

                        <h4><span class="glyphicon glyphicon-envelope"></span> Email : </h4>
                        <p>dangminhdat.qnam@gmail.com</p>

                        <h4><span class="glyphicon glyphicon-phone-alt"></span> Điện thoại : </h4>
                        <p>01215 300 516</p>



                        <br><br>
                        <h3><span class="glyphicon glyphicon-globe"></span> Bản đồ</h3>
                        <div class="break"></div><br>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3837.29413240368!2d108.24304461428437!3d15.893654248342191!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31420f8f6a6ca25f%3A0xc8e2a4f9caf6ba8d!2zNDEgVHLhuqduIFF1w70gQ8OhcCwgVsSpbmggxJBp4buHbiwgxJBp4buHbiBCw6BuLCBRdeG6o25nIE5hbSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1520410965775" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>

					</div>
	            </div>
        	</div>
        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->
@endsection