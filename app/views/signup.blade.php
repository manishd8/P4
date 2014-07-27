@extends('_master')

@section('title')
	SignUp
@stop


@section('footer')
	<!-- <div id="register" class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="false"> -->

		<div class="modal-dialog">

			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="false">
						&times;
					</button>

					<h3 class="modal-title" id="myModalLabel">Register</h3>

					
				</div>

				<div class="modal-body">
					<!-- <form action="/signup" method="POST"> -->
					{{ Form::open(array('url' => '/signup')) }}
						<fieldset >
								<div class="row form-inline">
									
									<div class="col-md-12">

										<select name="Title" class="col-md-1 form-control form-group">
											<option>Mr</option>
											<option>Mrs</option>
											<option>Ms</option>
											<option>Miss</option>

										</select>
										<div class="col-md-5">
											<input type="text" class="form-control form-group" name="FirstName" placeholder="First Name">
										</div>
										<div class="col-md-5">
											<input type="text" class="form-control form-group" name="LastName" placeholder="Last Name">
										</div>
									</div></br></br></br>
								</div>
								
								<div class="row col-md-7"  >
									<input type="text" class="form-control form-group" name="login_id" placeholder="User Name">
							
									<input type="password" class="form-control form-group" name="password" placeholder="Password">
								</div>
								
							
						</fieldset>					

						<button class="btn btn-success" type="submit">signup</button>
						<button class="btn btn-danger" data-target="/login">cancel</button>
					<!-- </form> -->
					{{ Form::close() }}
				</div>

				<div class="modal-footer">
						
							
				</div>
			</div>
		</div>
	<!-- </div> -->

@stop