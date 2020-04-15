<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Password extends Model
{
  protected $table = 'passwords';

  protected $guarded = ['id'];
  protected $dates = ['expiration_date'];
  protected $appends = array('DaysUntilExpiration');

  public function user(){
    return $this->belongsTo('App\User', 'user_id');
  }

  public function getDaysUntilExpirationAttribute(){
    if ($this->expiration_date){
      return $this->expiration_date->diffInDays(\Carbon\Carbon::today());
    }
    else{
      return "X";
    }
  }
}
