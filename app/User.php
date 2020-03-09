<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
  protected $table = 'users';

  protected $guarded = ['id'];
  protected $hidden = ['password', 'remember_token',];
  protected $casts = ['email_verified_at' => 'datetime'];

  public function account_options(){
    return $this->hasOne('App\AccountOptions', 'user_id');
  }
}
