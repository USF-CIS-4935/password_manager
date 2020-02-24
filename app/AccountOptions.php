<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountOptions extends Model
{
  protected $table = 'account_options';

  protected $fillable = ['password_age_notification', 'failure_lockout_timer'];
  protected $casts = [
    'password_age_notification' => 'boolean',
    'failure_lockout_timer' => 'boolean',
  ];
}
