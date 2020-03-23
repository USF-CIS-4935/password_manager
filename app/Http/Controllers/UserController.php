<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function update_account_options(Request $request){

      if (Auth::check()) {
        $acc_options = Auth::user()->account_options;

        $validatedData = $request->validate([
            'password_age_notification' => 'required|boolean',
            'failure_lockout_timer' => 'required|boolean',
            'current_password' => ['nullable', 'string', 'required_with:new_password'],
            'new_password' => ['nullable', 'string', 'min:8', 'max:16', 'required_with:current_password', 'different:current_password', 'confirmed'],
        ]);

        //Password Reset
        if ($request['current_password'] && $request['new_password']) {
          if (Hash::check($request['current_password'], Auth::user()->password)) {
            Auth::user()->update(array( 'password' => Hash::make($request['new_password']) ));
          }
        }

        $acc_options->update($validatedData);
        return $acc_options;
      }
      else {
        return response(401);
      }
    }
}
