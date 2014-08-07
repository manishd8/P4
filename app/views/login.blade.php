@extends('_master')

@section('title')
	Home Page
@stop


@section('containerfooter')
</br></br></br></br></br>
	<div class="row" id="main-content">
			<div class="col-md-4 pull-right" id="sidebar">

					<div class="well">

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
											<a class="btn btn-info" role="button" data-toggle="modal" data-target="#signUp" href="#">register</a>
										</div>

									</fieldset>

							{{ Form::close() }}

					</div>

			</div>

			<div class="col-md-8">
			</div>

	</div>
@stop

@section('footer')

<div id="signUp" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="false">
		<div class="modal-dialog">

			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="false">
						&times;
					</button>

					<h3 class="modal-title" id="myModalLabel">Register</h3>

					
				</div>

				<div class="modal-body">
					{{ Form::open(array('url' => '/signup')) }}
						<fieldset >
								<div class="row form-inline">
									
									<div class="col-md-12">

										<select name="Title" class="col-md-1 form-control form-group">
											<option>Mr</option>
											<option>Mrs</option>
											<option>Ms</option>

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
						<button class="btn btn-danger" data-dismiss="modal" aria-hidden="false">cancel</button>
					{{ Form::close() }}
				</div>

				<div class="modal-footer">
						
							
				</div>
			</div>
		</div>
</div>

@stop