<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'lname', 'fname', 'address', 'email', 'phone',
    ];

    public function transactions() {
        return $this->hasMany('App\Transaction');
    }
}
