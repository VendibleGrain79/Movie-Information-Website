<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

         $popularActor = Http::withToken('eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIyNWZhNDA3ZGRmMGNkMjA4OTBjYjUyNjIwZDI0NGUxNyIsIm5iZiI6MTc0NzMyNzg4OS4yMTgsInN1YiI6IjY4MjYxYjkxMjMyYTA2NmJiMTc2N2VjNSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.h4RV4RmCaWJa58PAlGgNiUnylDk0O7GsZOVHTTzDQb4')
            ->get('https://api.themoviedb.org/3/person/popular')
            ->json()['results'];

           
        return view('actor.index',['popularActor' => $popularActor]);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
           $actors= Http::withToken('eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiIyNWZhNDA3ZGRmMGNkMjA4OTBjYjUyNjIwZDI0NGUxNyIsIm5iZiI6MTc0NzMyNzg4OS4yMTgsInN1YiI6IjY4MjYxYjkxMjMyYTA2NmJiMTc2N2VjNSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.h4RV4RmCaWJa58PAlGgNiUnylDk0O7GsZOVHTTzDQb4')
            ->get('https://api.themoviedb.org/3/person/'.$id . '?append_to_response=combined_credits')
            ->json();
            


        return view('actor.show',['actors'=>$actors]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
