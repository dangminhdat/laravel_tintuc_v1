@extends('layouts.index')

@section('title')
{{ $tintuc->TieuDe }}
@endsection


@section('content')
<!-- Page Content -->
    <div class="container">
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-9">

                <!-- Blog Post -->

                <!-- Title -->
                <h1>{{ $tintuc->TieuDe }}</h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">admin</a>
                </p>

                <!-- Preview Image -->
                <img class="img-responsive" src="upload/tintuc/{{ $tintuc->Hinh }}" alt="">

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on: {{ $tintuc->created_at }}</p>
                <hr>

                <!-- Post Content -->
                <p class="lead">{{ $tintuc->TomTat }}</p>
                <p{!! $tintuc->NoiDung !!}</p>

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                @if(Auth::check())
                <div class="well">
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
                    <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                    <form role="form" action="{{ route('pages.comment',$tintuc->id) }}" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="NoiDung"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Gửi</button>
                    </form>
                </div>
                @endif

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                @foreach($tintuc->comment as $comment)
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{ $comment->user->name }}
                            <small>{{ $comment->createa_at }}</small>
                        </h4>
                        {!! $comment->NoiDung !!}
                    </div>
                </div>
                @endforeach

             

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-3">

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin liên quan</b></div>
                    <div class="panel-body">

					@foreach($tinlienquan as $value)
                        <!-- item -->
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="{{ route('pages.tintuc',$value->id) }}">
                                    <img class="img-responsive" src="upload/tintuc/{{ $value->Hinh }}" alt="">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a href="{{ route('pages.tintuc',$value->id) }}"><b>{{ $value->TieuDe }}</b></a>
                            </div>
                            <!-- <p>{{ $value->TomTat }}</p> -->
                            <div class="break"></div>
                        </div>
                        <!-- end item -->
					@endforeach
						
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin nổi bật</b></div>
                    <div class="panel-body">

					@foreach($tinnoibat as $value)
                        <!-- item -->
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="{{ route('pages.tintuc',$value->id) }}">
                                    <img class="img-responsive" src="upload/tintuc/{{ $value->Hinh }}" alt="">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a href="{{ route('pages.tintuc',$value->id) }}"><b>{{ $value->TieuDe }}</b></a>
                            </div>
                            <!-- <p>{{ $value->TomTat }}</p> -->
                            <div class="break"></div>
                        </div>
                        <!-- end item -->
					@endforeach
                        
                    </div>
                </div>
                
            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->
@endsection