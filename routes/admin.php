<?php
Route::middleware(['checkAdmin'])->prefix('admin/')->name('admin.')->group(function(){

    Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');
    Route::get('/users/list', 'AdminController@userLists')->name('users.list');
    Route::get('/users/block/{id}', 'AdminController@blockUser')->name('users.block');
    Route::get('/users/unblock/{id}', 'AdminController@unblockUser')->name('users.unblock');
    Route::get('/users/delete/{id}', 'AdminController@deleteUser')->name('users.delete');
    
});