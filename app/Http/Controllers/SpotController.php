<?php

namespace App\Http\Controllers;

use Spotify;
use App\Models\Spot;
use Illuminate\Http\Request;

class SpotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function search(Request $request)
    {
        // Provide some validation
        $this->validate(request(), [
            'song_name' => 'required',
        ]);
        $query = $request->input('song_name');
        $tracks = Spotify::searchTracks($query)->limit(12)->get();
        // dd($tracks);
        // foreach ($tracks as $track) {
        //     if(!empty($track['items'])){
        //         foreach ($track['items'] as $item) {
        //             dd($item);
        //             if(!empty($item['album'])){
        //                 foreach ($item['album']['images'] as $album) {
        //                     // dd($album['url']);
        //                     dd($album);
        //                 }
        //             }
        //         }
        //     }
        // }
        return view('home', compact('tracks', 'query'));
        // return view('results')
        //     ->with('song_name', $song_name);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Spot  $spot
     * @return \Illuminate\Http\Response
     */
    public function show(Spot $spot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Spot  $spot
     * @return \Illuminate\Http\Response
     */
    public function edit(Spot $spot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Spot  $spot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spot $spot)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spot  $spot
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spot $spot)
    {
        //
    }
}
