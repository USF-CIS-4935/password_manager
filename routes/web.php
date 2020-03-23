<?php
// Authentication Routes
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Auth::routes();

Route::middleware(['auth'])->group(function () {
  Route::get('/', function () {
      return view('pw-database');
  })->name('database');

  Route::get('account', function () {
      return view('acc-options')->with('user', Auth::user());
  })->name('acc-options');

  Route::post('update-account-options', 'UserController@update_account_options')
  ->name('update-account-options');

  Route::get('generate', function () {
      return view('pw-generate');
  })->name('generate');

  Route::get('reuse', function () {
      return view('pw-reuse');
  })->name('reuse');

  Route::get('help', function () {
      return view('help');
  })->name('help');
});
