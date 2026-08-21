<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-error', function () {
    throw new Exception('Bugsink test error');
});