<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('home');
});



Route::get('/login', function()
{
	return View::make('login');
});


Route::get('/portfolio', function()
{
	return View::make('portfolio');
});

/*-------------------------------------------------------------------------------------------------
// !post login
-------------------------------------------------------------------------------------------------*/
Route::post('/login', array('before' => 'csrf', function() {

	$credentials   = Input::only('login_id', 'password');

	if (Auth::attempt($credentials, $remember = false)) {
		return Redirect::intended('/portfolio')->with('flash_message', 'Welcome Back!');
	}
	else {
		return Redirect::to('/login')->with('flash_message', 'Log in failed; please try again.');
	}

	return Redirect::to('login');

}));

/*-------------------------------------------------------------------------------------------------
// !get logout
-------------------------------------------------------------------------------------------------*/
Route::get('/logout', function() {

	# Log out
	Auth::logout();

	# Send them to the homepage
	return Redirect::to('/');

});

Route::get('/signup', 
	array(
			'before' => 'guest',
			function() {

		    	return View::make('signup');
			}
	)
);


Route::post('/signup', array('before' => 'csrf', function() {
	$user = new User;
	$user->login_id    		 = Input::get('login_id');
	$user->FirstName    	 = Input::get('FirstName');
	$user->LastName    		 = Input::get('LastName');
	$user->Title    		 = Input::get('Title');
	$user->Cash    		     = '10000.00';
	$user->password 		 = Hash::make(Input::get('password'));


	try {
		$user->save();
	}
	catch (Exception $e) {
		return Redirect::to('/signup')
			->with('flash_message', 'Sign up failed; please try again.')
			->withInput();
	}

	# Log in
	Auth::login($user);

	return Redirect::to('/portfolio')->with('flash_message', 'Welcome to PlayStock!');
}));



/*-------------------------------------------------------------------------------------------------
// !Debug
-------------------------------------------------------------------------------------------------*/
Route::get('/debug', function() {

	echo '<pre>';

	echo '<h1>environment.php</h1>';
	$path   = base_path().'/environment.php';

	try {
		$contents = 'Contents: '.File::getRequire($path);
		$exists = 'Yes';
	}
	catch (Exception $e) {
		$exists = 'No. Defaulting to `production`';
		$contents = '';
	}

	echo "Checking for: ".$path.'<br>';
	echo 'Exists: '.$exists.'<br>';
	echo $contents;
	echo '<br>';

	echo '<h1>Environment</h1>';
	echo App::environment().'</h1>';

	echo '<h1>Debugging?</h1>';
	if(Config::get('app.debug')) echo "Yes"; else echo "No";

	echo '<h1>Database Config</h1>';
	print_r(Config::get('database.connections.mysql'));

	echo '<h1>Test Database Connection</h1>';
	try {
		$results = DB::select('SHOW DATABASES;');
		echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
		echo "<br><br>Your Databases:<br><br>";
		print_r($results);
	} 
	catch (Exception $e) {
		echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
	}

	echo '</pre>';

});