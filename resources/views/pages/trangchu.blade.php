@extends('layouts.index')

@section('title')
Trang chủ
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
	            		<h2 style="margin-top:0px; margin-bottom:0px;">Laravel Tin Tức</h2>
	            	</div>

	            	<div class="panel-body">
	            		@foreach($theloai as $value)
	            		@if(count($value->loaitin) > 0)
	            		<!-- item -->
					    <div class="row-item row">
		                	<h3>
		                		<a href="category.html">{{ $value->Ten }}</a> | 	
		                		@foreach($value->loaitin as $valueC)
		                		<small><a href="{{ route('pages.loaitin',[$valueC->TenKhongDau,$valueC->id]) }}"><i>{{ $valueC->Ten }}</i></a>/</small>
		                		@endforeach
		                	</h3>
		                	<?php 
		                		$data = $value->tintuc->where("NoiBat",1)->sortByDesc("created_at")->take(5);
		                		$tin1 = $data->shift();
		                	?>
		                	<div class="col-md-8 border-right">
		                		<div class="col-md-5">
			                        <a href="{{ route('pages.tintuc',$tin1['id']) }}">
			                            <img class="img-responsive" src="upload/tintuc/{{ $tin1['Hinh'] }}" alt="{{ $tin1['TieuDe'] }}">
			                        </a>
			                    </div>

			                    <div class="col-md-7">
			                        <h3>{{ $tin1['TieuDe']}}</h3>
			                        <p>{{ $tin1['TomTat'] }}</p>
			                        <a class="btn btn-primary" href="{{ route('pages.tintuc',$tin1['id']) }}">Xem thêm <span class="glyphicon glyphicon-chevron-right"></span></a>
								</div>

		                	</div>
		                    

							<div class="col-md-4">
								@foreach($data->all() as $valueK)
								<a href="{{ route('pages.tintuc',$valueK['id']) }}">
									<h4>
										<span class="glyphicon glyphicon-list-alt"></span>
										{{ $valueK->TieuDe }}
									</h4>
								</a>
								@endforeach
							</div>
							
							<div class="break"></div>
		                </div>
		                <!-- end item -->
		                @endif
						@endforeach
					</div>
	            </div>
        	</div>
        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->
@endsection