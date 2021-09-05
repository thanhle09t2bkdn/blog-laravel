<?php

Route::resource('categories', 'CategoryController')->except(['destroy']);
Route::delete('categories', 'CategoryController@delete')->name('categories.delete');
