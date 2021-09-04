<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth
require 'web/auth.php';
// Social networks
require 'web/facebook.php';
require 'web/google.php';
Route::middleware(['auth', 'web'])->group(function () {

    require 'web/home.php';
    require 'web/profile.php';
    require 'web/users.php';

    // Library
    require 'web/file-upload.php';
    require 'web/log.php';
});
