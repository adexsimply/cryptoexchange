<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $table = 'transfers';
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo('App\User');
    }


}
