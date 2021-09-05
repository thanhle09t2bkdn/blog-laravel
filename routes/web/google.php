<?php

Route::get('google/redirect', 'GoogleController@redirect')->name('google.redirect');
Route::get('google/callback', 'GoogleController@callback')->name('google.callback');
