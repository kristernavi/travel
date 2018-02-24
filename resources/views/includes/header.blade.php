<body>
	<!-- banner -->
	<div class="banner" style="min-height: {{ Request::segment(1) == '' ? '790px':'105px'}};">
		<div class="header agileinfo-header"><!-- header -->
			<nav class="navbar navbar-default">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<h1><a href="{{ url('') }}"><span> Bohol Travel &amp; Stay</span></a></h1>
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav navbar-left">
							<li><a href="{{ url('') }}" class="w3ls-hover {{ Request::segment(1) == '' ? ' active':'' }}">Home</a></li>

							<li><a href="{{ url('destinations') }}" class="btn w3ls-hover {{ Request::segment(1) == 'destinations' ? ' active':'' }}">Packages</a></li>
							<li><a href="{{ url('services') }}" class="btn w3ls-hover {{ Request::segment(1) == 'services' ? ' active':'' }}">Services</a></li>
							<li><a href="{{ url('contact') }}" class="btn w3ls-hover">Contact</a></li>
							<li><a href="{{ url('checkout-order')}}" class="btn w3ls-hover">Cart <lavel id="cart-badge" class="badge badge-warning">{{ Cart::getContent()->count()}}</lavel></a></li>
							<li><a href="{{ route('business-register')}}" class="btn w3ls-hover">Register</a></li>
							<li><a href="{{ url('about-us') }}" class="btn w3ls-hover">About</a></li>


							@guest
    						<li><a href="{{ route('login') }}" class="btn w3ls-hover" >Login</a></li>
							@endguest
							@auth
						    <li><a href="{{ route('logout') }}" class="btn w3ls-hover"  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Logout</a></li>
						    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
							@endauth



						</ul>
						<div class="clearfix"> </div>
					</div><!-- //navbar-collapse -->
				</div><!-- //container-fluid -->
			</nav>
		</div><!-- //header -->
