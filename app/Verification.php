<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{
    protected $table = "verifications";
    protected $guarded =[];
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

}
