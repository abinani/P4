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
	return Redirect::to('welcome');
});

Route::get('welcome', function()
{
    if(Auth::check())
    {
        $user = Auth::user();
        $pending_tasks = Task::where("user_id", "=", $user->id)
                 ->where('status',"<>", 'COMPLETED')->get();
        $completed_tasks = Task::where("user_id", "=", $user->id)
                 ->where('status',"=", 'COMPLETED')->get();
        return View::make('welcome')->with('pending_tasks', $pending_tasks)->with('completed_tasks',$completed_tasks);
    }
    else
    {
        return View::make('welcome');
    }
});

/*
Route::get('signup', function()
{
	return View::make('signup');
});
 */

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

            $credentials = Input::only($user->email, $user->password);

            if (Auth::attempt($credentials, $remember = true)) {
                return Redirect::intended('/')->with('flash_message', 'Welcome Back!');
            }
            else {
                return Redirect::to('/')->with('flash_message', 'Log in failed. Please try again.');
            }
        }
    )
);


Route::post('/login', 
    array(
        'before' => 'csrf', 
        function() {

            $credentials = Input::only('email', 'password');

            if (Auth::attempt($credentials, $remember = true)) {
                return Redirect::intended('/')->with('flash_message', 'Welcome Back!');
            }
            else {
                return Redirect::to('/')->with('flash_message', 'Log in failed. Please try again.');
            }

        }
    )
);

/*-------------------------------------------------------------------------------------------------
// !get logout
-------------------------------------------------------------------------------------------------*/
Route::get('/logout', function() {
	
	# Log out
	Auth::logout();
	
	# Send them to the homepage
	return Redirect::to('/');
	
});


Route::get('addtask', function()
{
	return View::make('addtask');
});

Route::post('addtask', 
    array(
        'before' => 'csrf', 
        function() {
            $user = Auth::user();
            
            $task_desc = Input::get('task_desc'); 
            $task_time = new DateTime(Input::get('due_date'));

            $task = new Task();

            $task->description = $task_desc;
            $task->status = "PENDING";
            $task->due_date = $task_time;

            $task->user()->associate($user);
            $task->save();


            return Redirect::to('/')->with('flash_message', "Successfully Added task for {$user->firstname}.");
        }
    )
);

Route::get('edittask/{id}',function($id)
{
    $task = Task::where("id", "=", $id)->first();
    
    return View::make('edittask')->with('task', $task);
});

Route::post('edittask/{id}', 
    array(
        'before' => 'csrf', 
        function($id) {
            
            $user = Auth::user();

            $task_desc = Input::get('task_desc'); 
            $task_status = Input::get('status');
            $task_time = new DateTime(Input::get('due_date'));

            DB::table('tasks')
                ->where("id", $id)
                ->update(array(
                           'description'=> $task_desc, 
                           'due_date'   => $task_time,
                           'status'     => $task_status));

            return Redirect::to('welcome')->with('flash_message', "Successfully Updated task for {$id}.");
        }
    )
);


Route::get('mysql-test', function() {

    # Use the DB component to select all the databases
    $results = DB::select('SHOW DATABASES;');

    # If the "Pre" package is not installed, you should output using print_r instead
    return Pre::render($results);

});
