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

		function SetDataToHiddenInput(){
			var stockSymb = document.getElementById("buy_dropdown").value;
			var hiddInp = document.getElementById("id_hiddenInput_buy");
			hiddInp.setAttribute("value", stockSymb);

			buySearchPrice();

		}

		
		function buySearchPrice(){

			 // Create our XMLHttpRequest object
		    var hr = new XMLHttpRequest();
		    // Create some variables we need to send to our PHP file
		    var url = "buySocksearch";
		    var id = document.getElementById("buy_dropdown").value;
		  
		    var vars = "Stock1="+id;
		    hr.open("POST", url, true);
		    // Set content type header information for sending url encoded variables in the request
		    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		    // Access the onreadystatechange event for the XMLHttpRequest object
		    hr.onreadystatechange = function() {
			    if(hr.readyState == 4 && hr.status == 200) {
				    var return_data = hr.responseText;
				    document.getElementById("id_buy_text").innerHTML = "&nbsp$ "+ return_data;

				    ComputeTotal();
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
				document.getElementById("id_buy_units").value = 1;
				unitFl = 1;
			}

			var stockFl = stockVal.substr(2,stockVal.length);
			document.getElementById("id_buy_total").innerHTML = "$ "+Math.round (stockFl*unitFl*100) / 100;
			
		}

		function SearchStockFromStr(){
			var dropDown = document.getElementById("buy_dropdown");

			var parentNode = dropDown.parentNode;
			parentNode.removeChild(dropDown);


			dropDown = document.createElement("select");
			dropDown.setAttribute("id", "buy_dropdown");
			dropDown.setAttribute("class", "form-control form-group");
			dropDown.setAttribute("onChange", "SetDataToHiddenInput()");
			
			parentNode.appendChild( dropDown );

			//var str = document.getElementById("id_buy_stock").value;
			var url = "searchStockName";

			 // Create our XMLHttpRequest object
		    var hr = new XMLHttpRequest();

		    var vars = "Stock_Str=val";
		    hr.open("POST", url, true);
		    // Set content type header information for sending url encoded variables in the request
		    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		    // Access the onreadystatechange event for the XMLHttpRequest object

		    hr.onreadystatechange = function() {
			    if(hr.readyState == 4 && hr.status == 200) {
				    var return_data = hr.responseText;

				    var return_data_list = return_data.split("+");
				    for (var i = 0; i < return_data_list.length; ++i) {

				    	if(i==0){
				    		document.getElementById("id_buy_text").innerHTML = "&nbsp$ "+ return_data_list[0];
				    	}
				    	else{

				    		if(i==2){
								var hiddInp = document.getElementById("id_hiddenInput_buy");
								hiddInp.setAttribute("value", name_symb[0]);
								ComputeTotal();
				    		}
					    	var name_symb = return_data_list[i].split("=");

					    	var currOption = document.createElement("option");
							currOption.setAttribute("value",name_symb[0]);
							  
							var add_name = document.createTextNode(name_symb[1]);
							currOption.appendChild( add_name );
					    	dropDown.appendChild( currOption );
					    }
				    }
			    }
		    }
		    // Send the data to PHP now... and wait for response to update the status div
		    hr.send(vars); // Actually execute the request

		}

		function Sell_Stock(){

			 // Create our XMLHttpRequest object
		    var hr = new XMLHttpRequest();

		   	var url = "sell";
		    hr.open("POST", url, true);

		    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

			var j =1;
		    var postData = "&YESSSS=1";

		     hr.onreadystatechange = function() {
			    if(hr.readyState == 4 && hr.status == 200) {
			    }
		    }
		    hr.send(postData);

		}


		function Create_SellPage(){
			var User_Stocks_ToSell;
			var rows = document.getElementById("PortfolioTable").rows;
			var j =1;

			var topDivElement = document.getElementById("Sell_Body_div");
		
			var parentNode = topDivElement.parentNode;
			parentNode.removeChild(topDivElement);

			topDivElement = document.createElement("div");
			topDivElement.setAttribute("class", "row form-inline");
			topDivElement.setAttribute("id", "Sell_Body_div");
			parentNode.appendChild( topDivElement );

	  		for(var i=1; i<rows.length; ++i) { 
	  				var currCheck_id =  "StockToSell_id"+i; 

	  				var td_stName_id =  "td_st_name"+i; 
	  				var td_Price_id =  "td_st_price"+i; 
	  				var td_Units_id =  "td_st_units"+i; 
	  				var td_Sell_Units_id =  "td_sell_st_units"+i;
	  				var td_st_symb_id = "td_st_symb"+i;

	  				var currCheckBox = document.getElementById(currCheck_id).checked;

	  				if(currCheckBox==true)
	  				{
	  					var name = document.getElementById(td_stName_id).textContent;		
	  					var currPrice = document.getElementById(td_Price_id).textContent;	
	  					var numUnits = document.getElementById(td_Units_id).textContent;		
	  					var stkSymb = document.getElementById(td_st_symb_id).textContent;					

						var div1 = document.createElement("div");
						div1.setAttribute("class", "col-md-12");

						var div11 = document.createElement("div");
						div11.setAttribute("class", "col-md-6");

						var div12 = document.createElement("div");
						div12.setAttribute("class", "col-md-2");

						var div13 = document.createElement("div");
						div13.setAttribute("class", "col-md-4");


						var mybr1 = document.createElement("br");
						var mybr3 = document.createElement("br");
						var mybr2 = document.createElement("br");
						div1.appendChild( div11 );
						div1.appendChild( div12 );
						div1.appendChild( div13 );

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

						var utName = "units"+i;
						var input13 = document.createElement("input");
						input13.setAttribute("type", "number");
						input13.setAttribute("name", stkSymb);
						input13.setAttribute("min", 1);
						input13.setAttribute("max", numUnits);
						input13.setAttribute("class", "form-control form-group input-sm");
						input13.setAttribute("data-bind", "value:replyNumber");
						input13.setAttribute("id", "td_Sell_Units_id");
						input13.setAttribute("value", numUnits);

						div13.appendChild( input13 );


						topDivElement.appendChild(div1);
						topDivElement.appendChild(mybr1);
						topDivElement.appendChild(mybr2);
						topDivElement.appendChild(mybr3);
	  				}
	  		}
		}

		function OnCheckAllChange(){
			
			var allCheckBoxFlag = document.getElementById("All_CheckBox_id").checked;
			var rows = document.getElementById("PortfolioTable").rows;
			for(var i=1; i<rows.length; ++i) { 
	  				var currCheck_id =  "StockToSell_id"+i; 
	  				var currCheckBox = document.getElementById(currCheck_id);
	  				if(allCheckBoxFlag==true){
	  					currCheckBox.checked = true;
	  				}
	  				else{
	  					currCheckBox.checked = false;
	  				}
	  				

	  			}
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
								  		<tr class="warning">
								  				<th class="text-center"><label><input id="All_CheckBox_id" type="checkbox" onclick="OnCheckAllChange();"></label></th>
								  				<th class="text-center">#</th>
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
								  				
								  				$td_st_units_id =  "td_st_units"; 
								  				$td_st_units_id.=$i;
								  				?> 

										  		<tr class="success text-center">
										  			<td>
										  				<label>
										  					<input type="checkbox" id="<?php echo $currCheck_id ?>">
										  				</label>
										  			</td>
										            <td><p><?php echo $i ?></p></td>
										            <td id="<?php echo $td_st_name_id ?>"><?php echo $User_Stock['0'] ?></td>
										            <td id="<?php echo $td_st_symb_id ?>"><?php echo $User_Stock['1'] ?></td>
										            <td id="<?php echo $td_st_price_id ?>"><?php echo $User_Stock['2'] ?></td>
										            <td id="<?php echo $td_st_units_id ?>"><?php echo $User_Stock['3'] ?></td>
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
							<!-- <a class="btn-lg btn-danger" role="button" href="#" onclick="Create_SellPage();" data-toggle="modal" data-target="#sell">Sell</a> -->
						</div>

						<div class="col-md-6">
						</div>

						<div class="col-md-3 pull-right">
								<a class="btn-lg btn-danger" role="button" href="#" onclick="Create_SellPage();" data-toggle="modal" data-target="#sell">Sell</a>
								<!-- <a class="btn-lg btn-info" role="button" href="#" data-toggle="modal" data-target="#search">Search</a> -->
								<a class="btn-lg btn-success" role="button" href="#" data-toggle="modal" data-target="#buy" onclick="SearchStockFromStr();">Buy Stock</a>
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
					{{ Form::open(array('url' => '/sell','method' => 'post')) }}
						<fieldset >								
							
								<div class="row form-inline" id="Sell_Body_div">
								</div>								
							
						</fieldset>					

						<div class="pull-right">
							<input class="btn btn-success" type="submit" value="Sell Stock" onClick="javascript:Sell_Stock();" >
							<button class="btn btn-danger" data-dismiss="modal" aria-hidden="false">cancel</button>
						</div></br>		
					{{ Form::close()}}			
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
									<input name="StockToBuy" type="hidden" id="id_hiddenInput_buy">
									<div class="col-md-12">
										
										<select id="buy_dropdown" name="Stock_To_Buy" class="form-control form-group" onchange="SetDataToHiddenInput()">
										</select>
										
									</div></br></br></br>

									<div class="col-md-12">

										<div class="col-md-5">
											<label>
												<h4>Current Stock Price</h4>
											</label>
										</div>

										<div class="col-md-3 pull-right">
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
											<input type="number" class="form-control form-group input-sm" id="id_buy_units" min="1" name="UnitsToBuy" data-bind="value:replyNumber" 
													placeholder="# Units" value="1" onChange="ComputeTotal()" onkeyup="ComputeTotal()" >
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