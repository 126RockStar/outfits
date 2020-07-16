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

Route::get('/','FrontendController@index')->name('index');
Route::post('/login/continue','Auth\LoginController@continueLogin')->name('login.continue');
Route::get('/contests','FrontendController@contests')->name('contests');
Route::get('/contest/{id}','FrontendController@viewContest')->name('contest.show');
Route::get('/contests/quickview','FrontendController@quickview')->name('contests.quickview');
Route::get('/contests/prizes','FrontendController@prizes')->name('contests.prizes');
Route::get('/games/wheel','FrontendController@wheel')->name('games.wheel');
Auth::routes(['verify'=>true]);
Route::get('/home', 'HomeController@index')->name('home')->middleware(['verified']);
Route::post('/fetch-sub_category', 'HomeController@fetchSubCategory')->middleware('cors');

//pages
Route::get('/faq','FrontendController@faq')->name('faq');
Route::get('/terms','FrontendController@terms')->name('terms');
Route::get('/contact','FrontendController@contact')->name('contact');
Route::post('/contact','FrontendController@submitContact')->name('contact');

Route::middleware(['checkUser','verified'])->prefix('user/')->name('user.')->group(function(){

    Route::get('/dashboard', 'HomeController@userDashboard')->name('dashboard');
    Route::get('/contests/joined', 'HomeController@joinedContests')->name('contests.joinded');
    route::resource('/contests','ContestController');
    route::post('/contest/participate','ContestController@participateContest')->name('contest.participate');
    route::get('/contest/unjoin/{id}','ContestController@unjoinContest')->name('contest.unjoin');
    Route::post('/contest/post/update', 'ContestController@updatePost')->name('contest.post.update');
    Route::get('/contest/post/delete/{id}', 'ContestController@deletePost')->name('contest.post.delete');






});
