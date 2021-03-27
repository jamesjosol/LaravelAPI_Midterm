<?php

namespace App\Http\Controllers;

use App\Book;
use App\Customer;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Transaction::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id'       => 'required|numeric|exists:customers,id',
            'book_id'           => 'required|numeric|exists:books,id',
            'date_borrowed'     => 'required|date',
            'due_date'          => 'required|date',
            'amount'            => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()->all()], 400);
        }

        return Transaction::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return Transaction::with('customer', 'book')->where('id', $transaction->id)->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validator = Validator::make($request->all(), [
            'customer_id'       => 'numeric|exists:customers,id',
            'book_id'           => 'numeric|exists:books,id',
            'date_borrowed'     => 'date',
            'due_date'          => 'date',
            'amount'            => 'numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()->all()], 400);
        }

        $transaction->update($request->all());

        return $transaction;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        Transaction::destroy($transaction->id);
    }

    public function byDateBorrowed($date) {
        $from = $date . " 00:00";
        $to = $date . " 23:59";
        
        $t =  Transaction::whereBetween('date_borrowed', [$from, $to])->get();
        return count($t)==0 ? abort(404) : $t;
    }

    public function byDueDate($date) {
        $from = $date . " 00:00";
        $to = $date . " 23:59";

        $t = Transaction::whereBetween('due_date', [$from, $to])->get();
        return count($t)==0 ? abort(404) : $t;
    }

    public function byCustomerAndBook(Customer $customer, Book $book) {
        $t = Transaction::where('customer_id', $customer->id)
            ->Where('book_id', $book->id)
            ->get();
        return count($t)==0 ? abort(404) : $t;
    }

    public function deleteByCustomerAndBook(Customer $customer, Book $book) {
        Transaction::where('customer_id', $customer->id)
            ->Where('book_id', $book->id)
            ->delete();
        return null;
    }
    
}
