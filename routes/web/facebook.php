<?php

Route::get('facebook/redirect', 'FacebookController@redirect')->name('facebook.redirect');
Route::get('facebook/callback', 'FacebookController@callback')->name('facebook.callback');
