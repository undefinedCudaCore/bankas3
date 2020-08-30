<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public function accountClient()
    {
        return $this->belongsTo('App\Client', 'client_id', 'id');
    }
    
}
