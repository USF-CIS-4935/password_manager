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
    if ( $password = Password::find($request->password_id) ){
      //Check if the person modifying actually owns the password
      if ($password->user_id === Auth::user()->id){
        $validatedData = $request->validate([
          'password_name' => 'required|string|max:200',
          'username_email' => 'nullable|string|max:200',
          'salt_string' => 'nullable|required_with:encrypted_pass|string|max:100',
          'encrypted_pass' => 'nullable|required_with:salt_string|string',
          'notes' => 'nullable|string',
          'expiration_date' => 'nullable|date'
        ]);

        $password->update($validatedData);
      }
      else {
        return response('This user is not authorized to manage this password.', 401)
        ->header('Content-Type', 'text/plain');
      }
    }
    elseif ($request->password_id === 'new'){
      //Create new password if no entry exists
      $password = Password::create([
          'user_id' => Auth::user()->id,
          'password_name' => $request['password_name'],
          'username_email' => $request['username_email'],
          'encrypted_pass' => $request['encrypted_pass'],
          'salt_string' => 'abc123',
          'notes' => $request['notes'],
          'expiration_date' => \Carbon\Carbon::today()->addMonth()
      ]);
    }
    else{
      return response('No password was found matching the provided ID.', 404)
      ->header('Content-Type', 'text/plain');
    }

    return $password;
  }

  public function delete_password(Request $request){
    if ( $password = Password::find($request->password_id) ){
      if ($password->user_id === Auth::user()->id){
        $password->delete();
        return response('Password successfully deleted.', 200);
      }
      else {
        var_dump($password->user);
        die();
        return response('This user is not authorized to manage this password.', 401)
        ->header('Content-Type', 'text/plain');
      }
    }
    else{
      return response('No password was found matching the provided ID.', 404)
      ->header('Content-Type', 'text/plain');
    }
  }
}
