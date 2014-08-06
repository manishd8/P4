<html lang="en">

	<head>
		<meta charset="uft-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<title>@yield('title','Virtual Stock Market')</title>
		
		<link href="css/bootstrap.css" rel="stylesheet" media="screen">
		<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">

		@yield('ajax')

		<script language="JavaScript" type="text/javascript">

			function start(){


			    var hr = new XMLHttpRequest();

			    var url = "getStockPriceList";
			    hr.open("POST", url, true);

			    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			    hr.onreadystatechange = function() {
				    if(hr.readyState == 4 && hr.status == 200) {
					    var return_data = hr.responseText;
					    var return_data_list = return_data.split("+");
					    var topDivElement = document.getElementById("marqueeDiv_id");


					    for (var i = 1; i <= return_data_list.length; ++i) {
					    	var nameValPair = return_data_list[i-1];
					    	var nameVallist = nameValPair.split("=");


 						  	var label1 = document.createElement("label");
					 

					    	var h31 = document.createElement("h3");
					   

					    	label1.appendChild( h31 );
					    	label1.setAttribute("class", "label-danger");
					    	
							
					    	var displayStr = "";
							var stkID = nameVallist[0];
							stkID = stkID.substring(1);
							displayStr+=stkID;
					    	displayStr+="= ";
					    	
					    	displayStr+=nameVallist[1];
					    	displayStr+=".....";

					    	var name = document.createTextNode(displayStr);
					   
							h31.appendChild( name );
				
							topDivElement.appendChild( label1 );

					  //   	var label1 = document.createElement("label");
					  //   	var label2 = document.createElement("label");

					  //   	var h31 = document.createElement("h3");
					  //   	var h32 = document.createElement("h3");

					  //   	label1.appendChild( h31 );
					    	
							// label2.appendChild( h32 );
							

							// var stkID = nameVallist[0];
							// stkID = stkID.substring(1);
							// var stkVal = nameVallist[1];
					  //   	var name = document.createTextNode(stkID);
					  //   	var value = document.createTextNode(stkVal);
							// h31.appendChild( name );
							// h31.appendChild(  document.createTextNode("  ==  ") );
							// h32.appendChild( "  "+value );
							// h32.appendChild(  document.createTextNode(" ,     ") );

							// topDivElement.appendChild( label1 );
							// topDivElement.appendChild( label2 );
					    }
				    }
			    }

			    // Send the data to PHP now... and wait for response to update the status div
			    hr.send(); // Actually execute the request
			}
		</script>
		<style type="text/css">
body {
   background: lightgreen !important;
}</style>

	</head>


	<body onload="start()" background>
		<div class="container text-info">
			<header class="row"> 

					<div class="col-md-12">

							<nav class="navbar navbar-default">
								<div class="col-md-7">
									<div class="navbar-header">
											<a href="#" class="navbar-brand">LiveStock</a>
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
										<a class="navbar-brand">Welcome <?php echo Auth::user()['FirstName'];?> <?php echo Auth::user()['LastName']; ?></a>
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

			<marquee scrollAmount= "6" onmouseover="this.setAttribute('scrollamount', 0, 0);" onmouseout="this.setAttribute('scrollamount', 6, 0);">

				<div class="col-md-12 text-center text-success" id="marqueeDiv_id">
					
				</div>
				
			</marquee>

			@yield('containerfooter')
			
			

		</div>

		@yield('footer')
	

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>

	</body>

</html>