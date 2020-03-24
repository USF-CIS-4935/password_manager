<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Password extends Model
{
  protected $table = 'passwords';

  protected $guarded = ['id'];

  public function user(){
    return $this->hasOne('App\User', 'user_id');
  }
}
