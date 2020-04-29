<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountOptions extends Model
{
  protected $table = 'account_options';

  protected $fillable = ['user_id', 'password_age_notification', 'track_login_history'];
  protected $casts = [
    'password_age_notification' => 'boolean',
    'track_login_history' => 'boolean',
  ];
}
