<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{

     use SoftDeletes;
    protected $guarded = [];
    protected $table = "currencies";


    public function cryptowallet()
    {
        return $this->hasMany('App\Cryptowallet','id','coin_id');
    }
    public function trx()
    {
        return $this->hasMany('App\Trx','id');
    }
}
