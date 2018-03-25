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

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', 'Auth\LoginController@showLoginForm');
    Route::post('login', 'Auth\LoginController@login')->name('admin.login');
    Route::post('logout', 'Auth\LoginController@logout')->name('admin.logout');
    Route::get('register', 'Auth\RegisterController@showRegistrationForm');
    Route::post('register', 'Auth\RegisterController@register')->name('admin.register');
    Route::get('home', 'HomeController@index');
});

Route::group(array("prefix"=>"employee","middleware"=>"auth"),function(){
	Route::resource('profile', 'User\ProfileController', ['only' => [
    	'index', 'edit', 'update'
	]]);

    Route::get('attendsion/statistical', 'User\AttendsionController@statistical')->name('attendsion.statistical');
    
    Route::resource('attendsion', 'User\AttendsionController',['only' =>[
        'index','store',
    ]]);

    Route::resource('report', 'User\ReportController',['except' => [
        'destroy'
    ]]);

    Route::get('overtime/statistical', 'User\OvertimeController@statistical')->name('overtime.statistical');

    Route::resource('overtime', 'User\OvertimeController');

    Route::resource('vacationfulltime', 'User\VacationFulltimeController',['except' =>['show']]
    );

    Route::resource('vacationparttime', 'User\VacationParttimeController', ['except' =>['show']]);
  
    Route::resource('employs','User\EmployeeController');
});