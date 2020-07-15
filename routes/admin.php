<?php

    URL::forceScheme('https');


Route::middleware(['checkAdmin'])->prefix('admin/')->name('admin.')->group(function(){

    Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');
    Route::resource('/users', 'UserController');
    Route::get('/users/block/{id}', 'UserController@blockUser')->name('users.block');
    Route::get('/users/unblock/{id}', 'UserController@unblockUser')->name('users.unblock');
    Route::get('/users/delete/{id}', 'UserController@deleteUser')->name('users.delete');

    route::resource('/categories','CategoryController');   
    Route::post('/sub-category/update/{id}','CategoryController@updateSubCategory')->name('sub-category.update');
    Route::get('/sub-category/edit/{id}','CategoryController@editSubCategory')->name('sub-category.edit');
    Route::get('/sub-category/delete/{id}','CategoryController@deleteSubCategory')->name('sub-category.delete');
    Route::post('/sub-category/add','CategoryController@addSubCategory')->name('sub-category.add');
    
    Route::get('/contests', 'ContestController@list')->name('contests');
    Route::get('/contest/edit/{id}', 'ContestController@edit')->name('contest.edit');
    Route::get('/contest/delete/{id}', 'ContestController@delete')->name('contest.delete');
    Route::post('/contest/update', 'ContestController@update')->name('contest.update');
    Route::get('/contest/{id}', 'ContestController@show')->name('contest.show');
    Route::post('/contest/entry/update', 'ContestController@updateEntry')->name('contest.entry.update');
    Route::get('/contest/entry/delete/{id}', 'ContestController@deleteEntry')->name('contest.entry.delete');
    Route::post('/contest/feature', 'ContestController@feature')->name('contest.feature');


    //contact messages
    Route::get('/messages', 'UserController@messages')->name('messages');
    Route::get('/message/seen/{id}', 'UserController@seenMessage')->name('message.seen');
    Route::get('/message/unseen/{id}', 'UserController@unseenMessage')->name('message.unseen');
    Route::get('/message/delete/{id}', 'UserController@deleteMessage')->name('message.delete');

    //static page maanagement
    route::resource('/pages','PageController');
    
});