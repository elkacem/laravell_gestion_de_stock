<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class news extends Model
{
    public function category(){
        $this->belongsTo('App\Category');
    }
}
