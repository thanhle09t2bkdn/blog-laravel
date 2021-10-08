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

/*
*
* Backend Routes
*
* --------------------------------------------------------------------
*/
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'backend.', 'middleware' => ['auth', 'web', 'auth.admin']], function () {

    require 'web/backend/sites.php';
    require 'web/backend/profile.php';
    require 'web/backend/users.php';
    require 'web/backend/categories.php';
    require 'web/backend/posts.php';

    // Library
    require 'web/backend/file-upload.php';
    require 'web/backend/log.php';
});


/*
*
* Frontend Routes
*
* --------------------------------------------------------------------
*/
Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {

    Route::group(['middleware' => ['auth']], function () {

    });
});
