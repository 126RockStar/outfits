<?php
Route::middleware(['checkAdmin'])->prefix('admin/')->name('admin.')->group(function(){

    Route::get('/dashboard', 'HomeController@adminDashboard')->name('cashboard');
    
});