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
  Route::get('tester', 'TesterController@index');
  Route::get('tester/patienthistory/{id}', 'TesterController@patienthistory');
  Route::post('tester/addnewtest', 'TesterController@addNewTest');
  Route::put('tester/updatetestrecord', 'TesterController@updateTestRecord');
  Route::put('tester/updatePatient', 'TesterController@updatePatient');
  Route::delete('tester/deleteTestRecord', 'TesterController@deleteTestRecord');
});

Route::group(['middleware' => ['auth', 'testCenterOfficer']], function(){
  Route::get('testCenterOfficer', 'TestOfficerController@index');
});

Route::group(['middleware' => ['auth', 'patient']], function(){
  Route::get('patient', 'PatientController@index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
