<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Transaction;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {
    $startDate = $faker->date;
    $endDate = date("Y-m-d" , strtotime($startDate."+ " . rand(1,3) ." months"));
    return [
        'customer_id'   => $faker->numberBetween(1,25),
        'book_id'       => $faker->numberBetween(1,16),
        'date_borrowed' => $startDate,
        'due_date'      => $endDate,
        'amount'        => rand(200, 2000),
    ];
});
