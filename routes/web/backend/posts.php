<?php

Route::resource('posts', 'PostController')->except(['destroy']);
Route::delete('posts', 'PostController@delete')->name('posts.delete');
