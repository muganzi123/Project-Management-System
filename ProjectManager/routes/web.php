<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
//Routes accesible after login
Route::middleware(['auth'])->group(function(){
	Route::get('projects/create/{company_id?}','ProjectsController@create');
	Route::resource('companies', 'CompaniesController');
	Route::resource('comments', 'CommentsController');
	Route::resource('projects', 'ProjectsController');
	Route::resource('roles', 'RolesController');
	Route::resource('tasks', 'TasksController');
	Route::resource('users', 'UsersController');
	Route::resource('users', 'CommentsController');
	Route::get('my-datatables', 'MyDatatablesController@index');
	Route::get('get-data-my-datatables', ['as'=>'get.data','uses'=>'MyDatatablesController@getData']);
	Route::get('my-datatables', 'MyDatatablesController@index');
	Route::get('get-data1-my-datatables', ['as'=>'get.data1','uses'=>'MyDatatablesController@getProject']);
	
});