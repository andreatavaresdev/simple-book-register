<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Genre::select('id','description')->get();
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
            'description'=>'required',
        ]);

        try{
            Genre::create($request->post());
            return response()->json(['message'=>'Genre created successfully']);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(['message'=>'Error!'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Genre $genre)
    {
        return response()->json(['genre'=>$genre]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genre $genre)
    {
        $request->validate([
            'description'=>'required'
        ]);

        try{

            $genre->fill($request->post())->update();
            $genre->save();

        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(['message'=>'Error!'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Genre $genre)
    {
        $request->validate([
            'description'=>'required'
        ]);

        try{

            $genre->fill($request->post())->update();
            $genre->save();

        }catch(Exception $e){
            Log::error($e->getMessage());
            return response()->json(['message'=>'Error!'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
    {
        try {
            $gente->delete();

            return response()->json([
                'message'=>'Genre deleted'
            ]);
            
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json([
                'message'=>'Error on genre delete!'
            ]);
        }
    }
}
