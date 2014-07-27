<html lang="en">

	<head>
		<meta charset="uft-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<title>@yield('title','Virtual Stock Market')</title>
		
		<link href="css/bootstrap.css" rel="stylesheet" media="screen">
		<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">

	</head>



	<body>

		<div class="container">
			<header class="row"> 

					<div class="col-md-12">

							<nav class="navbar navbar-default">
								<div class="col-md-7">
									<div class="navbar-header">
											<a href="#" class="navbar-brand">StockPlay</a>
									</div>

									<ul class="nav navbar-nav">
											<li class="divider-vertical"></li>
											<li><a href="#">Home</a></li>
											<li class="divider-vertical"></li>
											<li><a href="#">Blog</a></li>
											<li class="divider-vertical"></li>
											<li><a href="#">about</a></li>
											<li class="divider-vertical"></li>

											<li class ="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													connect
													<b class="caret"></b>
												</a>
												<ul class="dropdown-menu">
													<li><a href="#">twitter</a></li>
													<li><a href="#">facebook</a></li>
													<li><a href="#">google+</a></li>
													<li class="divider"></li>
													<li><a href="#">contact</a></li>
												</ul>
											</li>
											<li class="divider-vertical"></li>
									</ul>	
								</div>	

								<div class="col-md-3 navbar-header">
									@if(Auth::check())
										<a class="navbar-brand">Welcome <?php echo Auth::user()['FirstName']; echo Auth::user()['LastName']; ?></a>
									@endif
								</div>
								<div class="col-md-2">
										<ul class="nav navbar-nav">

											<li class ="dropdown">
													<a href="#" class="dropdown-toggle" data-toggle="dropdown">
														Account
														<b class="caret"></b>
													</a>
													<ul class="dropdown-menu">

														@if(Auth::check())
															<li><a href="/logout">Logout</a></li>
														@else 
															<li><a href="/login">Login</a></li>
														@endif

													</ul>
											</li>
											<li class="divider-vertical"></li>
										</ul>		
								</div

							</nav>

					</div>


			</header>

			@yield('containerfooter')
			
		</div>

		@yield('footer')
		

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>

	</body>

</html>