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


Route::get('/portfolio', array('before' => 'auth', function()
{
	$UsrStocks = DB::table('userstocks')->where('user_id', Auth::user()['id'])->get();

	$retuenArray = array();
	foreach($UsrStocks as $UsrStock) {
		$values = array();
		$Stock = DB::table('stocks')->where('id', $UsrStock->stock_id)->first();
    	array_push($values, $Stock->stock_name);
    	array_push($values, $Stock->stock_symb);

	    $httpreq = 'http://finance.yahoo.com/d/quotes.csv?s=';
	    $httpreq.=$Stock->stock_symb;
	    $httpreq.="&f=snl1";
	    $json = file_get_contents($httpreq);
	    $data = explode("\n",$json);
	    $data_stock = explode("\",",$data['0']);	

	    array_push($values, $data_stock['2']);
	    array_push($values, $UsrStock->num_units);
	
	    array_push($retuenArray, $values);
	}

	return View::make('portfolio')->with('User_Stocks', $retuenArray)
								  ->with('AccountCash' , Auth::user()['Cash']);
}));


/*-------------------------------------------------------------------------------------------------
// !post login
-------------------------------------------------------------------------------------------------*/
Route::post('/portfolio', array('before' => 'csrf', function() {

	if(Input::only('search_id') == null)
		return 'InSearchStock';

	return Input::only('id');

}));


Route::post('/searchStockName', function() {
	$st_sym = Input::get('Stock_Str');

	$serStk = DB::table('stocks')->where('stock_symb', $st_sym)->pluck('stock_name');
	
	return $serStk;

});

Route::post('/socksearch', function() {

	$httpreq = 'http://finance.yahoo.com/d/quotes.csv?s=';
	$firstSet = false;
	for($i=1; $i<=5; ++$i)
	{
		$currID = "Stock";
		$currID.=$i;
		$stockID = Input::get($currID);
		if(!is_null($stockID))
		{
			if($firstSet == true)
			{
				$httpreq.="+";
			}

			$firstSet = true;
			$httpreq.=$stockID;
		}

	}

	$return = "";
	$httpreq.="&f=snl1";
	$firstSet = false;
	$json = file_get_contents($httpreq);


	$data = explode("\n",$json);

	$data_count = count($data)-1;

	for($j=0; $j<$data_count; ++$j)
	{
		$data_stock = explode("\",",$data[$j]);	

		if($firstSet==true)
		{
			$return.="+";
			$return.=$data_stock['2'];
		}
		else
		{
			$return=$data_stock['2'];
			$firstSet = true;
		}
	
	
	}
	

	return $return;

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
	$user->Cash    		     = '100000.00';
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



Route::post('/buy', array('before' => 'csrf', 'before' => 'auth', function() {
	
	$st_sym = Input::get('StockToBuy');
	$serStk = DB::table('stocks')->where('stock_symb', $st_sym)->first()->id;



	$userStocks = new Userstock();
	
	$userStocks->stock_id = $serStk;
	$userStocks->num_units = Input::get('UnitsToBuy');
	$userStocks->user_id = Auth::user()['id'];

	$httpreq = 'http://finance.yahoo.com/d/quotes.csv?s=';
    $httpreq.=$st_sym;
    $httpreq.="&f=snl1";
    $json = file_get_contents($httpreq);
    $data = explode("\n",$json);
    $data_stock = explode("\",",$data['0']);	

    $AccountCash = Auth::user()['Cash'];

    $totalCost = $data_stock['2']*Input::get('UnitsToBuy');
    if($totalCost<$AccountCash)
    {
    	$userStocks->save();
    	DB::table('users')
            ->where('id',  Auth::user()['id'])
            ->update(array('Cash' => ($AccountCash-$totalCost)));
    }

	
	return Redirect::to('/portfolio');
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