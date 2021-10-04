<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{

    protected  $guarded = [];
    protected  $table = "testimonials";

       public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
