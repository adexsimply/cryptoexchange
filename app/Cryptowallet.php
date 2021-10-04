<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cryptowallet extends Model
{
   protected $table = 'cryptowallets';
   protected $fillable = array('name','coin_id', 'user_id', 'address','balance','status');

   public function user()
   {
      return $this->belongsTo('App\User');
   }

   public function currency()
   {
      return $this->belongsTo('App\Currency');
   }
}
