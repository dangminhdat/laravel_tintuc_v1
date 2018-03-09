@extends('layouts.index')

@section('title')
Tim kiếm: {{ $tukhoa }}
@endsection

@section('content')
<!-- Page Content -->
    <div class="container">
        <div class="row">
            @include('layouts.menu')

            <div class="col-md-9 ">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:#337AB7; color:white;">
                        <h4><b>Tìm kiếm: {{ $tukhoa }}</b></h4>
                    </div>

                 
					@foreach($tintuc as $value)
                    <div class="row-item row">
                        <div class="col-md-3">

                            <a href="{{ route('pages.tintuc',$value->id) }}">
                                <br>
                                <img width="200px" height="200px" class="img-responsive" src="upload/tintuc/{{ $value->Hinh }}" alt="">
                            </a>
                        </div>

                        <div class="col-md-9">
                            <h3>{!! doimau($value->TieuDe,$tukhoa) !!}</h3>
                            <p>{!! doimau($value->TomTat,$tukhoa) !!}</p>
                            <a class="btn btn-primary" href="{{ route('pages.tintuc',$value->id) }}">Xem thêm <span class="glyphicon glyphicon-chevron-right"></span></a>
                        </div>
                        <div class="break"></div>
                    </div>
                    @endforeach

                    <!-- Pagination -->
                    <!-- <div class="row text-center">
                        <div class="col-lg-12">
                           
                        </div>
                    </div> -->
                    <!-- /.row -->

                </div>
            </div> 

        </div>

    </div>
    <!-- end Page Content -->
@endsection