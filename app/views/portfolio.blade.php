@extends('_master')

@section('ajax')
	<script language="JavaScript" type="text/javascript">
		function ajax_post(){
		    // Create our XMLHttpRequest object
		    var hr = new XMLHttpRequest();
		    // Create some variables we need to send to our PHP file
		    var url = "socksearch";
		    var id1 = document.getElementById("stock_id1").value;
		    var id2 = document.getElementById("stock_id2").value;
		    var id3 = document.getElementById("stock_id3").value;
		    var id4 = document.getElementById("stock_id4").value;
		    var id5 = document.getElementById("stock_id5").value;
		    var vars = "Stock1="+id1+"&Stock2="+id2+"&Stock3="+id3+"&Stock4="+id4+"&Stock5="+id5;
		    hr.open("POST", url, true);
		    // Set content type header information for sending url encoded variables in the request
		    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		    // Access the onreadystatechange event for the XMLHttpRequest object
		    hr.onreadystatechange = function() {
			    if(hr.readyState == 4 && hr.status == 200) {
				    var return_data = hr.responseText;
				    var return_data_list = return_data.split("+");
				    for (var i = 1; i <= return_data_list.length; ++i) {
				    	var curr_id = "stock_val"+i;
				    	document.getElementById(curr_id).innerHTML = Math.round (return_data_list[i-1]*100) / 100;

				    };
			    }
		    }
		    hr.send(vars); // Actually execute the request
		   //document.getElementById("stock_val1").innerHTML = "processing...";
		}
		
		function buySearchPrice(){

			 // Create our XMLHttpRequest object
		    var hr = new XMLHttpRequest();
		    // Create some variables we need to send to our PHP file
		    var url = "socksearch";
		    var id = document.getElementById("id_buy_stock").value;
		  
		    var vars = "Stock1="+id;
		    hr.open("POST", url, true);
		    // Set content type header information for sending url encoded variables in the request
		    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		    // Access the onreadystatechange event for the XMLHttpRequest object
		    hr.onreadystatechange = function() {
			    if(hr.readyState == 4 && hr.status == 200) {
				    var return_data = hr.responseText;
				    document.getElementById("id_buy_text").innerHTML = "&nbsp$ "+ return_data;
			    }
		    }
		    // Send the data to PHP now... and wait for response to update the status div
		    hr.send(vars); // Actually execute the request
		}

		function ComputeTotal(){
			var numUnits = document.getElementById("id_buy_units").value;
			var stockVal = document.getElementById("id_buy_text").value;

			var unitFl = parseInt(numUnits);

			if(isNaN(unitFl)){
				document.getElementById("id_buy_units").innerHTML = "Enter Integer";
			}
			else{
				var stockFl = stockVal.substr(2,stockVal.length);;
				document.getElementById("id_buy_total").innerHTML = "$ "+Math.round (stockFl*unitFl*100) / 100;
			}
			
		}

		function SearchStockFromStr(){
		
			var str = document.getElementById("id_buy_stock").value;
			var url = "searchStockName";

			 // Create our XMLHttpRequest object
		    var hr = new XMLHttpRequest();


		    var vars = "Stock_Str="+str;
		    hr.open("POST", url, true);
		    // Set content type header information for sending url encoded variables in the request
		    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		    // Access the onreadystatechange event for the XMLHttpRequest object
		    hr.onreadystatechange = function() {
			    if(hr.readyState == 4 && hr.status == 200) {
				    var return_data = hr.responseText;
				    //document.getElementById("id_buy_text").innerHTML = return_data;
			    }
		    }
		    // Send the data to PHP now... and wait for response to update the status div
		    hr.send(vars); // Actually execute the request

		}

		function Create_SellPage(){
			var User_Stocks_ToSell;
			var rows = document.getElementById("PortfolioTable").rows;
			var j =1;

	  		for(var i=1; i<rows.length; ++i) { 
	  				var currCheck_id =  "StockToSell_id"+i; 

	  				var td_stName_id =  "td_st_name"+i; 
	  				var td_Price_id =  "td_st_price"+i; 
	  				

	  				var currCheckBox = document.getElementById(currCheck_id).checked;

	  				if(currCheckBox==true)
	  				{
	  					var name = document.getElementById(td_stName_id).textContent;		
	  					var currPrice = document.getElementById(td_Price_id).textContent;							

						var div1 = document.createElement("div");
						div1.setAttribute("class", "col-md-12");

						var div11 = document.createElement("div");
						div11.setAttribute("class", "col-md-8");

						var div12 = document.createElement("div");
						div12.setAttribute("class", "col-md-4");

						var mybr1 = document.createElement("br");
						var mybr3 = document.createElement("br");
						var mybr2 = document.createElement("br");
						div1.appendChild( div11 );
						div1.appendChild( div12 );

						var input11 = document.createElement("output");
						input11.setAttribute("class", "btn-info");
						
						var add_name = document.createTextNode(name);
						input11.appendChild( add_name );

						div11.appendChild( input11 );

						var input12 = document.createElement("output");
						input12.setAttribute("class", "btn-info");

						var add_price = document.createTextNode(currPrice);
						input12.appendChild( add_price );

						div12.appendChild( input12 );


						document.getElementById("Sell_Body_div").appendChild(div1);
						document.getElementById("Sell_Body_div").appendChild(mybr1);
						document.getElementById("Sell_Body_div").appendChild(mybr2);
						document.getElementById("Sell_Body_div").appendChild(mybr3);

		

						// <div class="col-md-12">

						// 	<div class="col-md-8">
						// 		<input type="text" class="form-control form-group" id="stock_id1" name="Stock1" placeholder="Stock Name">
						// 	</div>

						// 	<div class="col-md-2">
						// 		<output class="btn-info" id="stock_val1">$ 0.00</output>
						// 	</div>
					
						// </div></br></br></br>

	  				}
	  		}

	  		// var newPara = document.createElement("p");
	  		// var add_news = document.createTextNode("The latest news goes here.");
	  		// newPara.appendChild( add_news );
	  		// var txt1 = "<p>Text.</p>"; 
		}
	</script>
@stop

@section('title')
	Your Portfolio
@stop

@section('containerfooter')

</br></br></br></br>
	<div class="row" id="main-content">

		<fieldset >
				<div class="row form-inline well">

					<div class="col-md-12">

						<div class="col-md-2">
						</div>

						<div class="col-md-8 text-center text-danger">
							<h2>Cash Available  $<?php echo $AccountCash?></h2>
						</div>

						<div class="col-md-2">
						</div>	

					</div></br></br></br></br>


					<div class="col-md-12">
						<div class="col-md-1">
						</div>

						<div class="col-md-10">
							<table class="table table-condensed" id="PortfolioTable">
								  <thead>
								  		<tr class="info">
								  				<th class="text-center"><label><input type="checkbox"></label></th>
								  				<th class="text-center">Row</th>
								  				<th class="text-center">Stock Name</th>
								  				<th class="text-center">Stock Symbol</th>
								  				<th class="text-center">Current Price</th>
								  				<th class="text-center"># Units</th>
								  				<th class="text-center">$ Value</th>
								  		</tr>
								  </thead>

								  <tbody>
								  	
								  		<?php 
								  		$i = 1;
								  		foreach ($User_Stocks as $User_Stock) { 
								  				$currCheck_id =  "StockToSell_id"; 
								  				$currCheck_id.=$i; 

								  				$td_st_name_id =  "td_st_name"; 
								  				$td_st_name_id.=$i; 

								  				$td_st_symb_id =  "td_st_symb"; 
								  				$td_st_symb_id.=$i; 

								  				$td_st_price_id =  "td_st_price"; 
								  				$td_st_price_id.=$i; 
								  				
								  				?> 

										  		<tr class="danger text-center">
										  			<td>
										  				<label>
										  					<input type="checkbox" id="<?php echo $currCheck_id ?>">
										  				</label>
										  			</td>
										            <td><p><?php echo $i ?></p></td>
										            <td id="<?php echo $td_st_name_id ?>"><?php echo $User_Stock['0'] ?></td>
										            <td id="<?php echo $td_st_symb_id ?>"><?php echo $User_Stock['1'] ?></td>
										            <td id="<?php echo $td_st_price_id ?>"><?php echo $User_Stock['2'] ?></td>
										            <td><?php echo $User_Stock['3'] ?></td>
										            <td>$ <?php echo $User_Stock['2'] * $User_Stock['3'] ?></td>
										        </tr>
										 <?php  $i++; } ?>

								  </tbody>	
							</table>
						</div>

						<div class="col-md-1">
						</div>

					</div>

					<div class="col-md-12">
						<br/>
					</div>
					<div class="col-md-12">
						<div class="col-md-1">
						</div>
						<div class="col-md-1">
							<a class="btn-lg btn-danger" role="button" href="#" onclick="Create_SellPage();" data-toggle="modal" data-target="#sell">Sell</a>
						</div>

						<div class="col-md-6">
						</div>

						<div class="col-md-3 pull-right">
								<a class="btn-lg btn-info" role="button" href="#" data-toggle="modal" data-target="#search">Search</a>
								<a class="btn-lg btn-success" role="button" href="#" data-toggle="modal" data-target="#buy">Buy Stock</a>
						</div>	
					</div>

				</div>
		</fieldset>

	</div>
@stop


@section('footer')

<div id="sell" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="false">

		<div class="modal-dialog">

			<div class="modal-content">
				<div class="modal-header text-center">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="false">
						&times;
					</button>

					<h3 class="modal-title" id="myModalLabel">Sell Stock</h3>

				</div>

				<div class="modal-body">
					
						<fieldset >								
							
								<div class="row form-inline" id="Sell_Body_div">
									
									<!-- <div class="col-md-12">

										<div class="col-md-8">
											<input type="text" class="form-control form-group" id="stock_id1" name="Stock1" placeholder="Stock Name">
										</div>

										<div class="col-md-2">
											<output class="btn-info" id="stock_val1">$ 0.00</output>
										</div>
								
									</div></br></br></br>

									<div class="col-md-12">

										<div class="col-md-8">
											<input type="text" class="form-control form-group" id="stock_id2" name="Stock2" placeholder="Stock Name">
										</div>

										<div class="col-md-2">
											<output class="btn-info" id="stock_val2">$ 0.00</output>
										</div>
								
									</div></br></br></br> -->
								</div>								
							
						</fieldset>					

						<div class="pull-right">
							<input name="Search" class="btn btn-success" type="submit" value="Sell Stock" onClick="javascript:ajax_post();">
							<button class="btn btn-danger" data-dismiss="modal" aria-hidden="false">cancel</button>
						</div></br>					
				</div>

				<div class="modal-footer">
						
							
				</div>
			</div>
		</div>
	</div>

<div id="search" class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="false">

		<div class="modal-dialog">

			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="false">
						&times;
					</button>

					<h3 class="modal-title" id="myModalLabel">Search Stock</h3>

				</div>

				<div class="modal-body">
					
						<fieldset >
								<div class="row form-inline">
									
									<div class="col-md-12">

										<div class="col-md-8">
											<input type="text" class="form-control form-group" id="stock_id1" name="Stock1" placeholder="Stock Name">
										</div>

										<div class="col-md-3">
											<label>
												<output class="btn btn-info btn-group-justified disabled" id="stock_val1">$ 0.00 </output>
											</label>
										</div>
								
									</div></br></br></br>

									<div class="col-md-12">

										<div class="col-md-8">
											<input type="text" class="form-control form-group" id="stock_id2" name="Stock2" placeholder="Stock Name">
										</div>

										<div class="col-md-3 ">
											<label>
												<output class="btn btn-info btn-group-justified disabled" id="stock_val2">$ 0.00</output>
											</label>
										</div>
								
									</div></br></br></br>

									<div class="col-md-12">

										<div class="col-md-8">
											<input type="text" class="form-control form-group" id="stock_id3" name="Stock3" placeholder="Stock Name">
										</div>

										<div class="col-md-3">
											<label>
												<output class="btn btn-info btn-group-justified disabled" id="stock_val3">$ 0.00</output>
											</label>
										</div>
								
									</div></br></br></br>

									<div class="col-md-12">

										<div class="col-md-8">
											<input type="text" class="form-control form-group" id="stock_id4" name="Stock4" placeholder="Stock Name">
										</div>

										<div class="col-md-3">
											<label>
												<output class="btn btn-info btn-group-justified disabled" id="stock_val4">$ 0.00</output>
											</label>
										</div>
								
									</div></br></br></br>

									<div class="col-md-12">

										<div class="col-md-8">
											<input type="text" class="form-control form-group" id="stock_id5" name="Stock5" placeholder="Stock Name">
										</div>

										<div class="col-md-3">
											<label>
												<output class="btn btn-info btn-group-justified disabled" id="stock_val5">$ 0.00</output>
											</label>
										</div>
								
									</div></br></br></br>
								</div>								
							
						</fieldset>					

						<div class="pull-right">
							<!-- <button name="SearchStock" id="SchStk" class="btn btn-success" onClick="javascript:ajax_post();">search</button> -->
							<input name="Search" class="btn btn-success" type="submit" value="Get Data" onClick="javascript:ajax_post();">
							<button class="btn btn-danger" data-dismiss="modal" aria-hidden="false">cancel</button>
						</div></br>
					<!-- </form> -->
					
				</div>

				<div class="modal-footer">
						
							
				</div>
			</div>
		</div>
	</div>


	<div id="buy" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="false">

		<div class="modal-dialog">

			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="false">
						&times;
					</button>

					<h3 class="modal-title" id="myModalLabel">Buy Stock</h3>

				</div>

				<div class="modal-body">
					{{ Form::open(array('url' => '/buy','method' => 'post')) }}
						<fieldset >
								<div class="row form-inline">
									
									<div class="col-md-12">

										<div class="col-md-3">
											<input type="text" class="form-control form-group" id="id_buy_stock" name="StockToBuy" placeholder="Stock Name" onkeyup="SearchStockFromStr()">
										</div>

										<div class="col-md-1">
										</div>

										<div class="col-md-3">
											<a class="btn btn-info" role="button" data-toggle="modal" href="javascript:buySearchPrice();">Search price</a>
											<!-- <input name="Search" class="btn btn-info" value="Search price" onClick="buySearchPrice();"> -->
										</div>

										<div class="col-md-2 pull-right">
											<label>
												<output class="disabled" id="id_buy_text">$ 0.00</output>
											</label>
										</div>							
									</div></br></br></br>


									<div class="col-md-10">

										<div class="col-md-5">
											<label>
												<h4>Number of Units</h4>
											</label>
										</div>

										<div class="col-md-2">
										</div>

										<div class="col-md-2 pull-right">
											<input type="number" class="form-control form-group input-sm" id="id_buy_units" name="UnitsToBuy" data-bind="value:replyNumber" 
													placeholder="# Units" onChange="ComputeTotal()">
										</div>							
									</div></br></br></br>

									<div class="col-md-10">

										<div class="col-md-5">
											<label>
												<h4>Total</h4>
											</label>
										</div>

										<div class="col-md-2">
										</div>

										<div class="col-md-2 pull-right">
											<label>
												<output class="btn  disabled" id="id_buy_total">$ 0.00</output>
											</label>
										</div>							
									</div></br></br></br>

								</div>								
							
						</fieldset>					

						<div class="pull-right">
							<!-- <a class="btn btn-success" role="button" data-toggle="modal" href="/buy">Buy Stock</a> -->
							<input name="BuyStock" class="btn btn-success" type="submit" value="Buy Stock" href="/buy">
							<button class="btn btn-danger" data-dismiss="modal" aria-hidden="false">cancel</button>
						</div></br></br>
					{{ Form::close() }}
					
				</div>

				<div class="modal-footer">
						
							
				</div>
			</div>
		</div>
	</div>
@stop