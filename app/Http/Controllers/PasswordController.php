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
    
  }
}
