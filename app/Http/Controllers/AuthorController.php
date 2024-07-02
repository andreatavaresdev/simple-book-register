<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Author::select('id','name')->get();
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
            'name'=>'required',
        ]);

        try{
            Author::create($request->post());
            return response()->json(['message'=>'Author created successfully']);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(['message'=>'Error!'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        return response()->json(['author'=>$author]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        $request->validate([
            'name'=>'required'
        ]);

        try{

            $author->fill($request->post())->update();
            $author->save();

        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(['message'=>'Error!'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        $request->validate([
            'name'=>'required'
        ]);

        try{

            $author->fill($request->post())->update();
            $author->save();

        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(['message'=>'Error!'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        try {
            $author->delete();

            return response()->json([
                'message'=>'Author deleted'
            ]);
            
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json([
                'message'=>'Error on author delete!'
            ]);
        }
    }
}
