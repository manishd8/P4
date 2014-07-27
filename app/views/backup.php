<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="uft-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Login\SignUp</title>

		
		
		<link href="css/bootstrap.css" rel="stylesheet" media="screen">
		<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">

	</head>



	<body>
		<div class="container">
			<header class="row"> 
				<div class="col-md-12">
					<nav class="navbar navbar-default">
						<div class="navbar-header">

							<a href="#" class="navbar-brand">StockPlay</a>
							<!-- <a class="btn btn-info" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</a> -->
						</div>

						<!-- <div class="navbar-collapse collapse"> -->
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
						<!-- </div> -->
					
					</nav>
				</div>
			</header>

			<div class="row" id="main-content">
				<div class="col-md-4" id="sidebar">
					<div class="well">
						<form>
							<fieldset>
								<legend>Login</legend>
								<input type="text" class="form-control form-group"placeholder="username">
								<input type="text"  class="form-control form-group" placeholder="password">
								<div class="checkbox">
									<label>
										<input type="checkbox"> Remember Me
									</label>
								</div>

								<div class="pull-right">
									<input type="submit" class="btn btn-primary" value="login">
									<a class="btn btn-info">register</a>
								</div>

							</fieldset>

						</form>
					</div>
				</div>
				<div class="col-md-8"></div>

			</div>
			<footer class="row"></footer>
		</div>



		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>

	</body>

</html>