<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title', 'genre', 'author', 'pub_date',
    ];

    public function transactions() {
        return $this->hasMany('App\Transaction');
    }
}
