<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Book::select('books.id','title', 'books.isbn', 'genres.description', 'authors.name')
                            ->join('genres', 'genres.id', '=', 'books.genre_id')
                            ->join('authors', 'authors.id', '=', 'books.author_id')                            
                            ->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
        ]);

        try{
            Book::create($request->post());
            return response()->json(['message'=>'Book created successfully']);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(['message'=>'Error!'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return response()->json(['book'=>$book]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {

        try{

            $book->fill($request->post())->update();
            $book->save();

        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(['message'=>'Error!'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title'=>'required'
        ]);

        try{

            $book->fill($request->post())->update();
            $book->save();

        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(['message'=>'Error!'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}
