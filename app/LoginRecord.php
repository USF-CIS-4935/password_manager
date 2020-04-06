<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoginRecord extends Model
{
  protected $table = 'login_history';

  protected $guarded = ['id'];

  public function user(){
    return $this->belongsTo('App\User', 'user_id');
  }
}
