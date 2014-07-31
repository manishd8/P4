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
	</script>
@stop

@section('title')
	Your Portfolio
@stop

@section('containerfooter')
	<div class="row" id="main-content">

		<div class="col-md-2">
		</div>

		<div class="col-md-8 center-block">

				<div class="well">
					<div class="col-md-1">
						
					</div>
					<div class="col-md-4 pull-right">
						<a class="btn btn-info" role="button" data-toggle="modal" data-target="#search">Search</a>
						<a class="btn btn-success" role="button" data-toggle="modal" data-target="#buy">Buy</a>
						<a class="btn btn-danger" role="button" data-toggle="modal" data-target="#sell">Sell</a>
						<!-- <input type="submit" class="btn btn-success" value="Buy">
						<input type="submit" class="btn btn-danger" value="Sell"> -->

					</div>
						</br></br></br></br>
					<div class="container-fluid table ">
						  <div class="row-fluid">
						   <!--  <div class="span4 center-block" style="background: #129bca;">
						    	<label>					    	
							        <div>Left Side</div>
							        <div>Left Side</div>
							        <div>Left Side</div> 
						        </label>
						    </div> -->
					</div>

				</div>

		</div>

		<div class="col-md-2">
		</div>

	</div>
@stop


@section('footer')

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


<div id="sell" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="false">

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
								
									</div></br></br></br>

									<div class="col-md-12">

										<div class="col-md-8">
											<input type="text" class="form-control form-group" id="stock_id3" name="Stock3" placeholder="Stock Name">
										</div>

										<div class="col-md-2">
											<output class="btn-info" id="stock_val3">$ 0.00</output>
										</div>
								
									</div></br></br></br>

									<div class="col-md-12">

										<div class="col-md-8">
											<input type="text" class="form-control form-group" id="stock_id4" name="Stock4" placeholder="Stock Name">
										</div>

										<div class="col-md-2">
											<output class="btn-info" id="stock_val4">$ 0.00</output>
										</div>
								
									</div></br></br></br>

									<div class="col-md-12">

										<div class="col-md-8">
											<input type="text" class="form-control form-group" id="stock_id5" name="Stock5" placeholder="Stock Name">
										</div>

										<div class="col-md-2">
											<output class="btn-info" id="stock_val5">$ 0.00</output>
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
									
									<div class="col-md-10">

										<div class="col-md-3">
											<input type="text" class="form-control form-group" id="id_buy_stock" name="Stock" placeholder="Stock Name">
										</div>

										<div class="col-md-2">
										</div>

										<div class="col-md-3">
											<input name="Search" class="btn btn-info" value="Search price" onClick="buySearchPrice();">
										</div>

										<div class="col-md-2 pull-right">
											<label>
												<output class="btn  disabled" id="id_buy_text">$ 0.00</output>
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
											<input type="number" class="input-sm form-control form-group" id="id_buy_units" data-bind="value:replyNumber" 
													name="Units" placeholder="# Units" onChange="ComputeTotal()">
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