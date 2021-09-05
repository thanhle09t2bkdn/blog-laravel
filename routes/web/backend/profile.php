<?php

Route::get('profile', 'ProfileController@show')->name('profile.show');
Route::put('profile', 'ProfileController@update')->name('profile.update');
