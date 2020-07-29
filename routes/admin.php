<?php

    URL::forceScheme('https');


Route::middleware(['checkAdmin'])->prefix('admin/')->name('admin.')->group(function(){

    Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');
    Route::resource('/users', 'UserController');
    Route::get('/users/block/{id}', 'UserController@blockUser')->name('users.block');
    Route::get('/users/unblock/{id}', 'UserController@unblockUser')->name('users.unblock');
    Route::get('/users/delete/{id}', 'UserController@deleteUser')->name('users.delete');
    Route::post('/users/selected', 'UserController@selectedUsers')->name('users.selected');

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
    Route::post('/prize/feature', 'ContestController@featurePrize')->name('prize.feature');
    Route::post('/contests/selected', 'ContestController@selectedContests')->name('contests.selected');
    
    //messages
    route::resource('/outbox','MessageController');
    Route::get('/inbox/delete/{id}', 'MessageController@delete')->name('message.delete');
    Route::post('/inbox/selected', 'MessageController@selectedMessages')->name('messages.selected');

    //contact messages
    Route::get('/messages', 'UserController@messages')->name('messages');
    Route::get('/message/seen/{id}', 'UserController@seenMessage')->name('message.seen');
    Route::get('/message/unseen/{id}', 'UserController@unseenMessage')->name('message.unseen');
    Route::get('/message/delete/{id}', 'UserController@deleteMessage')->name('message.delete');
    Route::post('/messages/selected', 'UserController@selectedMessages')->name('messages.selected');

    //Reports
    Route::get('/reports', 'ReportController@reports')->name('reports');
    Route::get('/report/mail/{id}', 'ReportController@mailReport')->name('report.mail');
    Route::get('/report/seen/{id}', 'ReportController@seenReport')->name('report.seen');
    Route::get('/report/unseen/{id}', 'ReportController@unseenReport')->name('report.unseen');
    Route::get('/report/delete/{id}', 'ReportController@deleteReport')->name('report.delete');
    Route::post('/reports/selected', 'ReportController@selectedReports')->name('reports.selected');

    //static page maanagement
    route::resource('/pages','PageController');
    
});