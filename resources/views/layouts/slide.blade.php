<!-- slider -->
    	<div class="row carousel-holder">
            <div class="col-md-12">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                    	@foreach($slide as $key => $value)
                        <li data-target="#carousel-example-generic"
						@if($key == 0)
							class="active"
						@endif
                         data-slide-to="{{ $key }}"></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner">
                    	@foreach($slide as $key => $value)
                        <div class="item 
							@if($key == 0)
								active
							@endif">
                            <img class="slide-image" src="upload/slide/{{ $value->Hinh }}" alt="{{ $value->NoiDung }}" style="height: 350px">
                        </div>
                        @endforeach
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
            </div>
        </div>
        <!-- end slide -->