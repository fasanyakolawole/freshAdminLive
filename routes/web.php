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
Route::get('/clients', 'backend@getClients')->name('clients');
Route::get('/cleaners', 'backend@getCleaners')->name('cleaners');
Route::get('/completedJobs', 'backend@completedJobs')->name('completedJobs');
Route::get('/getName', 'backend@getName')->name('getName');
Route::get('/activeJobs', 'backend@activeJobs')->name('activeJobs');
Route::get('/cancledJobs', 'backend@cancledJobs')->name('cancledJobs');
Route::get('/awaitingJobs', 'backend@awaitingJobs')->name('awaitingJobs');
Route::get('/activateCleaners', 'backend@activateCleaners')->name('activateCleaners');
Route::get('/inactiveCleaners', 'backend@inactiveCleaners')->name('inactiveCleaners');
Route::get('/home', 'HomeController@index')->name('home');
