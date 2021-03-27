<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    protected $fillable = ['customer_id', 'book_id', 'date_borrowed', 'due_date', 'amount'];

    public function customer() {
        return $this->belongsTo('App\Customer');
    }

    public function book() {
        return $this->belongsTo('App\Book');
    }
}
