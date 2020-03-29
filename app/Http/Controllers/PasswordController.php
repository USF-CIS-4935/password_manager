<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Password;
use Auth;

class PasswordController extends Controller
{
  public function get_password($password_id = 0){
    $password = Password::findOrFail($password_id);

    if (Auth::user()->id !== $password->user_id){
      return response('This user is not authorized to view this password.', 401)
        ->header('Content-Type', 'text/plain');
    }
    return $password;
  }

  public function update_password(Request $request){
    $password = Password::findOrFail($request->password_id);

    var_dump($password->user);
    die();

    if ($password->user === Auth::user()){ //Check if the person modifying actually owns the password

      $validatedData = $request->validate([
        'password_name' => 'required|string|max:100',
        'encrypted_pass' => 'nullable|string',
        'notes' => 'nullable|string',
      ]);

      $password->update($validatedData);
      return $password;
    }
    else {
      return response('This user is not authorized to manage this password.', 401)
      ->header('Content-Type', 'text/plain');
    }
  }
}
