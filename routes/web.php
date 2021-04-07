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

Route::group(['middleware' => ['auth', 'tester']], function(){
  Route::resource('tester', 'TesterController');
});

Route::group(['middleware' => ['auth', 'testCenterOfficer']], function(){
  Route::resource('testCenterOfficer', 'TestOfficerController');
});

Route::group(['middleware' => ['auth', 'patient']], function(){
  Route::resource('patient', 'PatientController');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
