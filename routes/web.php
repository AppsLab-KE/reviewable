<?php
Route::get('/', 'Reviewable\Http\Controllers\ReviewableController@reviews')->name('reviews.index');
Route::post('/roles', 'AppsLab\Acl\Http\Controllers\ReviewableController@storeRole')->name('roles.store');
Route::post('/permissions', 'AppsLab\Acl\Http\Controllers\ReviewableController@storePermission')->name('permissions.store');
Route::get('/roles/create', 'AppsLab\Acl\Http\Controllers\ReviewableController@createRole')->name('roles.create');
Route::get('/permissions/create', 'AppsLab\Acl\Http\Controllers\ReviewableController@createPermission')->name('permissions.create');
Route::get('/roles/{role}/edit', 'AppsLab\Acl\Http\Controllers\ReviewableController@editRole')->name('roles.edit');
Route::get('/permissions/{permission}/edit', 'AppsLab\Acl\Http\Controllers\ReviewableController@editPermission')->name('permissions.edit');
Route::put('/roles/{role}/update', 'AppsLab\Acl\Http\Controllers\ReviewableController@updateRole')->name('roles.update');
Route::put('/permissions/{permission}/update', 'AppsLab\Acl\Http\Controllers\ReviewableController@updatePermission')->name('permissions.update');
Route::delete('/permissions/delete/{permission}', 'AppsLab\Acl\Http\Controllers\ReviewableController@deletePermission')->name('permissions.delete');
Route::delete('/roles/delete/{role}', 'AppsLab\Acl\Http\Controllers\ReviewableController@deleteRole')->name('roles.delete');
Route::get('/permissions', 'AppsLab\Acl\Http\Controllers\ReviewableController@permissions')->name('permissions.index');