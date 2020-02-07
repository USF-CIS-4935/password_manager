<?php

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

Route::get('/', function () {
    return view('pw-database');
})->name('database');

Route::get('account', function () {
    return view('acc-options');
})->name('acc-options');

Route::get('generate', function () {
    return view('pw-generate');
})->name('generate');

Route::get('reuse', function () {
    return view('pw-reuse');
})->name('reuse');

Route::get('help', function () {
    return view('help');
})->name('help');

Route::get('/login', function () {
    return view('auth/login');
})->name('login');

