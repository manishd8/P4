<html lang="en">

	<head>
		<meta charset="uft-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<title>@yield('title','Virtual Stock Market')</title>
		
		<link href="css/bootstrap.css" rel="stylesheet" media="screen">
		<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">

		@yield('ajax')

		<style type="text/css">
			.flash-message {
				width:20%;
				position:absolute;
				top:0;
				left:0;
				background-color:yellow;
				text-align:left;
				padding:5px;
			}


		</style>
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
					    	displayStr+="(";
					    	
					    	displayStr+=nameVallist[1];
					    	displayStr+=").....";

					    	var name = document.createTextNode(displayStr);
					   
							h31.appendChild( name );
				
							topDivElement.appendChild( label1 );
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


	<body onload="start()">

		@if(Session::get('flash_message'))
			<div class='flash-message'>{{ Session::get('flash_message') }}</div>
		@endif

		<div class="container text-info">
			<header class="row"> 

					<div class="col-md-12">

							<nav class="navbar navbar-default">
								<div class="col-md-7">
									<div class="navbar-header">
											<a class="navbar-brand"><b class="text-danger">LiveStock</b></a>
									</div>

									<ul class="nav navbar-nav">
											<li class="divider-vertical"></li>
											<li><a href="/portfolio">My Portfolio</a></li>
											<li class="divider-vertical"></li>
											<li><a data-toggle="modal" data-target="#aboutInfo" href="#">about</a></li>
											<li class="divider-vertical"></li>

											<li class ="dropdown">
												<a href="#" class="dropdown-toggle" data-toggle="dropdown">
													connect
													<b class="caret"></b>
												</a>
												<ul class="dropdown-menu">
													<li class="disabled"><a href="#">twitter</a></li>
													<li class="disabled"><a href="#">facebook</a></li>
													<li class="disabled"><a href="#">google+</a></li>
													<li class="divider"></li>
													<li><a data-toggle="modal" data-target="#contactInfo" href="#">contact</a></li>
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


			</header> </br></br></br>

			<marquee scrollAmount= "8" onmouseover="this.setAttribute('scrollamount', 0, 0);" onmouseout="this.setAttribute('scrollamount', 8, 0);">

				<div class="col-md-12 text-center text-success" id="marqueeDiv_id">
					
				</div>
				
			</marquee>

			@yield('containerfooter')
			
			

		</div>

		<div id="aboutInfo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="false">
			<div class="modal-dialog">

				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="false">
							&times;
						</button>

						<h3 class="modal-title text-center" id="myModalLabel">About <b class="text-danger">LiveStock</b></h3>

						
					</div>

					<div class="modal-body">
							<fieldset >
									<div class="row form-inline">
										
										<div class="col-md-12">

												<label>
													<p class="text-justify"> 
														<big>
															<b class="text-danger">Livestock</b> is a portal which introduces a budding investor to the thrills & excitement of real time stock trading in a risk free environment. A user friendly tool, the portal provides virtual money which can be used for trading shares using their real time current prices, thus creating an understanding of the dynamics & the niftiness of the stock market. <b class="text-danger">Livestock</b> places the chip on the user's shoulder by creating a arena where learning is easy & getting a grasp on trading basics is done in an effective & enjoyable manner. The users inch forward into the real time trading world with added confidence & ever so needed sharpness.
													    </big>
													</p>
												</label>	

										</div>	</br></br></br>			

									</div>									
								
							</fieldset>					
							
					</div>

				    <div class="modal-footer">
							
								<button class="btn btn-danger pull-right" data-dismiss="modal" aria-hidden="false">cancel</button>
					</div>
				</div>
			</div>
		</div>

		<div id="contactInfo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="false">
			<div class="modal-dialog">

				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="false">
							&times;
						</button>

						<h3 class="modal-title" id="myModalLabel">Contact Info</h3>

						
					</div>

					<div class="modal-body">
							<fieldset >
									<div class="row form-inline">
										
										<div class="col-md-12">

											<div class="col-md-5">
												<label>
													<h4>Phone No</h4>
												</label>
											</div>

											<div class="col-md-4 pull-right">
												<label>
													<output class="disabled">9876543210</output>
												</label>
											</div>		
										</div>	</br></br></br>			

										<div class="col-md-12">

											<div class="col-md-4">
												<label>
													<h4>Email ID</h4>
												</label>
											</div>

											<div class="col-md-5 pull-right">
												<label>
													<output class="disabled">manishgo81@gmail.com</output>
												</label>
											</div>		
										</div>	</br></br></br>				
									</div>
									
								
							</fieldset>					
							
					</div>

				    <div class="modal-footer">
							
								<button class="btn btn-danger pull-right" data-dismiss="modal" aria-hidden="false">cancel</button>
					</div>
				</div>
			</div>
		</div>

		@yield('footer')
	

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>

	</body>

</html>