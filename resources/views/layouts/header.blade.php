
<!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ route('localhost') }}">Laravel Tin Tức</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="{{ route('pages.gioithieu') }}">Giới thiệu</a>
                    </li>
                    <li>
                        <a href="{{ route('pages.lienhe') }}">Liên hệ</a>
                    </li>
                </ul>

                <form action="{{ route('pages.timkiem') }}" method="post" class="navbar-form navbar-left" role="search">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
			        <div class="form-group">
			          <input type="text" class="form-control" name="tukhoa" placeholder="Search">
			        </div>
			        <button type="submit" class="btn btn-default">Search</button>
			    </form>

			    <ul class="nav navbar-nav pull-right">
                    @if(!Auth::check())
                    <li>
                        <a href="">Đăng ký</a>
                    </li>
                    <li>
                        <a href="{{ route('pages.getDangNhap') }}">Đăng nhập</a>
                    </li>
                    @else
                    <li>
                    	<a href="{{ route('pages.getNguoiDung') }}">
                    		<span class ="glyphicon glyphicon-user"></span>
                    		 {{ Auth::user()->name }}
                    	</a>
                    </li>

                    <li>
                    	<a href="{{ route('pages.getDangXuat') }}">Đăng xuất</a>
                    </li>
                    @endif
                </ul>
            </div>


            
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
