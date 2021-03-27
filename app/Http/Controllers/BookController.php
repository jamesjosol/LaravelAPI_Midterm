<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Book::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validator = $this->validate($request, [
        //     'title'             => 'required',
        //     'genre'             => 'required',
        //     'author'            => 'required',
        //     'pub_date'          => 'required|date',
        // ]);

        $validator = Validator::make($request->all(), [
            'title'             => 'required',
            'genre'             => 'required',
            'author'            => 'required',
            'pub_date'          => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()->all()], 400);
        }

        return Book::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return Book::find($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $this->validate($request, [
            'pub_date'          => 'date',
        ]);

        $book->update($request->all());
        
        return $book;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        return Book::destroy($book->id);
    }

    public function byGenre($genre) {
        return Book::where('genre', $genre)->get();
    }

    /**
     * get all transactions from a specific book
     */
    public function transactionsByBook(Book $book) {
        return Book::with('transactions')
            ->where('id', $book->id)
            ->get();
    }
}
