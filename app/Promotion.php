<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{

    public $timestamps = false;

    public function code()
    {
        return $this->belongsTo('App\Code');
    }
}
