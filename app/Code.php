<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    public $timestamps = false;

    public function promotions()
    {
        return $this->hasMany('App\Promotion');
    }
}
