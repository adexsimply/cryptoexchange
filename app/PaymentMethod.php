<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $guarded = ['id'];

    public function currency()
    {
        return $this->belongsTo('App\Currency','currency_id','id');
    }

 public function trx()
    {
        return $this->belongsTo('App\Trx', 'trx');
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
