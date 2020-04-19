<?php
// Authentication Routes
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Auth::routes();

Route::middleware(['auth'])->group(function () {
  Route::get('/', function () {
      $passwords = \App\Password::where('user_id', Auth::user()->id)->get();
      return view('pw-database')->with('passwords', $passwords);
  })->name('database');

  Route::get('get-password/{password_id?}', 'PasswordController@get_password')
  ->name('get-password');
  Route::get('get-all-user-passwords', 'PasswordController@get_all_user_passwords')
  ->name('get-all-user-passwords');
  Route::post('update-password', 'PasswordController@update_password')
  ->name('update-password');
  Route::post('delete-password', 'PasswordController@delete_password')
  ->name('delete-password');

  Route::get('account', 'UserController@return_account_options')
  ->name('acc-options');

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
