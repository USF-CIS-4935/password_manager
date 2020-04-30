<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Password extends Model
{
  protected $table = 'passwords';

  protected $guarded = ['id'];
  protected $dates = ['expiration_date'];
  protected $appends = array('DaysUntilExpiration', 'ExpirationColor', 'LengthCorrectedName');

  public function user(){
    return $this->belongsTo('App\User', 'user_id');
  }

  public function getDaysUntilExpirationAttribute(){
    if ($this->expiration_date){
      $days = \Carbon\Carbon::today()->diffInDays($this->expiration_date, false);
      if ($days < 0){
        return 0;
      }
      return $days;
    }
    else{
      return "X";
    }
  }

  public function getExpirationColorAttribute(){
    if ( !is_numeric($this->DaysUntilExpiration) ){
      return 'black';
    }
    if ($this->DaysUntilExpiration < 2){
      return '#c11515'; //dark-red
    }
    elseif ($this->DaysUntilExpiration <= 5){
      return '#e08f2a'; //orange
    }
    elseif ($this->DaysUntilExpiration <= 10){
      return '#f1dc27'; //yellow
    }
    else{
      return 'black';
    }
  }

  public function getLengthCorrectedNameAttribute(){
    if (strlen($this->password_name) >= 17){
      return substr($this->password_name, 0, 17) . "...";
    }
    else{
      return $this->password_name;
    }
  }
}
