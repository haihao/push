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
	return View::make('hello');
});

Route::get('/hi',function(){
	return "hi";
	
});
Route::get('/admin',function(){
	return Redirect::to("/admin/home");
	
});


Route::filter('login',function (){
	if(!Auth::check()){
		return Redirect::to(APP_ROOT."admin/login");
	}

});



//test
Route::get('test','UserController@Test');
Route::get('test2','UserController@test2');
Route::get('test3','UserController@test3');

//testend

Route::get('admin/login','UserController@lgoin');
Route::get('admin/logout','UserController@logout')->before('login');
Route::get('admin/home','AdController@Adlist')->before('login');

Route::get('admin/publish','AdappController@publishView')->before('login');
Route::post('admin/publish','AdappController@appPublish')->before('login');

Route::get('admin/config','ConfigController@Config')->before('login');

Route::get('admin/config/modify','ConfigController@Modify')->before('login');
Route::get('admin/config/appdel','AppController@Appdel')->before('login');
Route::post('admin/config/appadd','AppController@Appadd')->before('login');
Route::post('admin/logincheck','UserController@loginCheck');
Route::post('admin/config/set','ConfigController@setConfig')->before('login');


//
Route::get('getapplink','AdappController@getAppLink');
Route::get('getconfig','ConfigController@getConfigJson');



