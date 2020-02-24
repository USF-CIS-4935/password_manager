<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function update_account_options(Request $request){
      //TODO: Add user auth
      $acc_options = User::findOrFail(1)->account_options;

      $validatedData = $request->validate([
          'password_age_notification' => 'required|boolean',
          'failure_lockout_timer' => 'required|boolean',
      ]);

      $acc_options->update($validatedData);
      return $acc_options;
    }
}
