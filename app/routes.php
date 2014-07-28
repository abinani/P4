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
	return View::make('welcome');
});

Route::get('welcome', function()
{
	return View::make('welcome');
});

Route::get('signup', function()
{
	return View::make('signup');
});

Route::get('/signup',
    array(
        'before' => 'guest',
        function() {
            return View::make('signup');
        }
    )
);


Route::post('/signup', 
    array(
        'before' => 'csrf',
        function() {
            $user = new User;
            $user->firstname = Input::get('first_name');
            $user->lastname  = Input::get('last_name');
            $user->email     = Input::get('email');
            $user->password  = Hash::make(Input::get('password'));

            $user->save();
        }
    )
);


Route::post('/login', 
    array(
        'before' => 'csrf', 
        function() {

            $credentials = Input::only('email', 'password');

            if (Auth::attempt($credentials, $remember = true)) {
                return Redirect::intended('/');
                //return Redirect::intended('/')->with('flash_message', 'Welcome Back!');
            }
            else {
                return Pre::render($credentials);
                return Redirect::to('/login');
                //return Redirect::to('/login')->with('flash_message', 'Log in failed; please try again.');
            }

            return Redirect::to('login');
        }
    )
);

Route::get('mysql-test', function() {

    # Use the DB component to select all the databases
    $results = DB::select('SHOW DATABASES;');

    # If the "Pre" package is not installed, you should output using print_r instead
    return Pre::render($results);

});
