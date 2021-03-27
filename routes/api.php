<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResource('customers', 'CustomerController');
Route::get('/customers/{customer}/transactions', 'CustomerController@transactionsByCustomer');

Route::apiResource('books', 'BookController');
Route::get('/books/genre/{genre}', 'BookController@byGenre');
Route::get('/books/{book}/transactions', 'BookController@transactionsByBook');

Route::apiResource('transactions', 'TransactionController');
Route::get('/transactions/date_borrowed/{date}', 'TransactionController@byDateBorrowed');
Route::get('/transactions/due_date/{date}', 'TransactionController@byDueDate');
Route::get('/transactions/customer/{customer}/book/{book}', 'TransactionController@byCustomerAndBook');
Route::delete('/transactions/customer/{customer}/book/{book}', 'TransactionController@deleteByCustomerAndBook');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
