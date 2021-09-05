<?php

Route::group(['prefix' => 'file-upload'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
