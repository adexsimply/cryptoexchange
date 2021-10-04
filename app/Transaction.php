<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function gateway()
    {
        return $this->belongsTo('App\Gateway');
    }
    public function method()
    {
        return $this->belongsTo('App\PaymentMethod');
    }
    public function currency()
    {
        return $this->belongsTo('App\Currency', 'currency_id', 'id');
    }
}
