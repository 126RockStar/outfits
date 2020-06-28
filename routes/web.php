<?php

use Illuminate\Support\Facades\Route;

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
    // dd(\Bigbluebutton::isConnect());
    return view('welcome');
});
Auth::routes(['verify'=>true]);
Route::get('/home', 'HomeController@index')->name('home')->middleware(['verified']);


Route::middleware(['checkUser','verified'])->prefix('user/')->name('user.')->group(function(){
    Route::get('/dashboard', 'HomeController@userDashboard')->name('dashboard');






});
