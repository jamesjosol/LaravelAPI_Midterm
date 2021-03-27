<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    $genres = ['Art', 'Anthologies', 'Biography', 'Comics', 'Fantasy', 'Fiction', 'History', 'Horror',
    'Music', 'Mystery', 'Romance', 'Science', 'Thriller'];
    return [
        'title'     => $faker->word,
        'genre'     => $genres[array_rand($genres)],
        'author'    => $faker->firstName . ' ' . $faker->lastName,
        'pub_date'   => $faker->date,
    ];
});
