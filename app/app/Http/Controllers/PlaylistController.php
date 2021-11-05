<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Http\Resources\PlaylistResource;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$playlists = Playlist::paginate(10);
        $playlists = Playlist::with('contents')->paginate(10);
        return PlaylistResource::collection($playlists);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $playlist = new Playlist;
        $playlist->title = $request->title;
        $playlist->description = $request->description;
        $playlist->author = $request->author;

        if( $playlist->save() ){
            return new PlaylistResource( $playlist );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Playlist  $playlist
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $playlist = Playlist::findOrFail( $id );
        return new PlaylistResource( $playlist );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Playlist  $playlist
     * @return \Illuminate\Http\Response
     */
    public function edit(Playlist $playlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Playlist  $playlist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $playlist_id)
    {
        //
        $playlist = Playlist::findOrFail( $playlist_id );
        $playlist->title = $request->title;
        $playlist->description = $request->description;
        $playlist->author = $request->author;

        //dd($request->id);

        if( $playlist->save() ){
            // dd($playlist);
            return new PlaylistResource( $playlist );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Playlist  $playlist
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $playlist = Playlist::findOrFail( $id );
        if( $playlist->delete() ){
          return new PlaylistResource( $playlist );
        }
    }
}
