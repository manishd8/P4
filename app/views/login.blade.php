@extends('_master')

@section('title')
	Home Page
@stop


@section('containerfooter')
</br></br></br></br></br>
	<div class="row" id="main-content">
			<div class="col-md-4 pull-right" id="sidebar">

					<div class="well">

							<!-- <form action="/login" method="POST"> -->
							{{ Form::open(array('url' => '/login')) }}

									<fieldset>

										<legend>Login</legend>
										<input type="text" name="login_id" class="form-control form-group" placeholder="username">
										<input type="password" name="password" class="form-control form-group" placeholder="password">
										<div class="checkbox">
											<label>
												<input type="checkbox" name="remember_token"> Remember Me
											</label>
										</div>

										<div class="pull-right">
											<input type="submit" name="login" class="btn btn-primary" value="login">
											<a class="btn btn-info" role="button" data-toggle="modal" href="/signup">register</a>
										</div>

									</fieldset>

							<!-- </form> -->
							{{ Form::close() }}

					</div>

			</div>

			<div class="col-md-8">
			</div>

	</div>
@stop


<!-- @section('footer')
	<div id="register" class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">

		<div class="modal-dialog">

			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						&times;
					</button>

					<h3 class="modal-title" id="myModalLabel">Register</h3>

					
				</div>

				<div class="modal-body">
					<form action="/signup" method="POST">
						<fieldset >
								<div class="row form-inline">
									
									<div class="col-md-12">

										<select class="col-md-1 form-control form-group">
											<option>Mr.</option>
											<option>Mrs.</option>
											<option>Miss.</option>

										</select>
										<div class="col-md-5">
											<input type="text" class="form-control form-group"  placeholder="First Name">
										</div>
										<div class="col-md-5">
											<input type="text" class="form-control form-group" placeholder="Last Name">
										</div>
									</div></br></br></br>
								</div>
								
								<div class="row col-md-7"  >
									<input type="text" class="form-control form-group" placeholder="User Name">
							
									<input type="password" class="form-control form-group" placeholder="Password">
								</div>
								
							
						</fieldset>						

					</form>
				</div>

				<div class="modal-footer">
						<button class="btn btn-success" name="signup">signup</button>
						<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">cancel</button>
						
				</div>
			</div>
		</div>
	</div>

@stop -->