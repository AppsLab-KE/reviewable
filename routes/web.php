<?php
Route::get('/', 'Reviewable\Http\Controllers\ReviewableController@reviews')->name('reviews.index');
Route::get('/monitors', 'Reviewable\Http\Controllers\ReviewableController@monitors')->name('monitors.monitors');
Route::post('/monitors', 'Reviewable\Http\Controllers\ReviewableController@storeMonitor')->name('monitors.store');
Route::get('/occurrences', 'Reviewable\Http\Controllers\ReviewableController@occurrences')->name('occurrences.index');
Route::get('/monitors/create', 'Reviewable\Http\Controllers\ReviewableController@createMonitor')->name('monitors.create');
Route::get('/monitors/{monitor}/edit', 'Reviewable\Http\Controllers\ReviewableController@editMonitor')->name('monitors.edit');
Route::put('/monitors/{monitor}/update', 'Reviewable\Http\Controllers\ReviewableController@updateMonitor')->name('monitors.update');
Route::delete('/monitors/delete/{monitor}', 'Reviewable\Http\Controllers\ReviewableController@deleteMonitor')->name('monitors.delete');
Route::delete('/reviews/delete/{review}', 'Reviewable\Http\Controllers\ReviewableController@deleteReview')->name('reviews.delete');
Route::get('/reviews/{review}/show', 'Reviewable\Http\Controllers\ReviewableController@showReview')->name('reviews.show');