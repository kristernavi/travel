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
							<li><a href="#" class="btn w3ls-hover">About</a></li>   
							<li><a href="{{ url('destinations') }}" class="btn w3ls-hover {{ Request::segment(1) == 'destinations' ? ' active':'' }}">Destinations</a></li> 
							<li><a href="#" class="btn w3ls-hover">Packages</a></li> 
							<li><a href="#" class="btn w3ls-hover">Contact</a></li>
						</ul>	    
						<div class="clearfix"> </div>
					</div><!-- //navbar-collapse --> 
				</div><!-- //container-fluid -->
			</nav>
		</div><!-- //header -->	