<?php

Route::resource('users', 'UserController')->except(['destroy']);
Route::delete('users', 'UserController@delete')->name('users.delete');
