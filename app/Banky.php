<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banky extends Model
{
    protected $table = "localbanks";
    protected $guarded =[];

   public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
