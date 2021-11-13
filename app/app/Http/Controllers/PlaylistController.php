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

    /**
    * @OA\Get(

    *  path="/playlists",

    *  tags={"Playlists"},

    *  operationId="accountValidate",

    *  summary="Playlist List",

    *  @OA\Response(response="200",

    *    description="List of Playlists",

    *  )

    * )

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

    /**
    * @OA\Post(

    *  path="/playlists",

    *  tags={"Playlists"},

    *  operationId="accountValidate",

    *  summary="Playlist Creation",

    *  @OA\Parameter(name="title",

    *    in="query",

    *    required=true,

    *    @OA\Schema(type="string")

    *  ),

    *  @OA\Parameter(name="description",

    *    in="query",

    *    required=false,

    *    @OA\Schema(type="string")

    *  ),

    *  @OA\Parameter(name="author",

    *    in="query",

    *    required=true,

    *    @OA\Schema(type="string")

    *  ),

    *  @OA\Response(response="201",

    *    description="Playlist created",

    *  )

    * )

    */

    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required|max:100',
            'author' => 'required|max:150',
            'description' => 'max:200'
        ]);

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

    /**
    * @OA\Put(

    *  path="/playlists/{playlist}",

    *  tags={"Playlists"},

    *  operationId="playlist_id",

    *  summary="Playlist Update",

    *  @OA\Parameter(name="title",

    *    in="query",

    *    required=true,

    *    @OA\Schema(type="string")

    *  ),

    *  @OA\Parameter(name="description",

    *    in="query",

    *    required=false,

    *    @OA\Schema(type="string")

    *  ),

    *  @OA\Parameter(name="author",

    *    in="query",

    *    required=true,

    *    @OA\Schema(type="string")

    *  ),

    *  @OA\Parameter(name="playlist",

    *    in="path",

    *    required=true,

    *    @OA\Schema(type="integer")

    *  ),

    *  @OA\Response(response="201",

    *    description="Playlist Updated",

    *  ),

    *  @OA\Response(response="404",

    *    description="Playlist not found",

    *  )

    * )

    */

    public function update(Request $request, $playlist_id)
    {
        //
        $request->validate([
            'title' => 'required|max:100',
            'author' => 'required|max:150',
            'description' => 'max:200'
        ]);

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

    /**
    * @OA\delete(

    *  path="/playlists/{playlist}",

    *  tags={"Playlists"},

    *  operationId="playlist_id",

    *  summary="Playlist Delete",

    *  @OA\Parameter(name="playlist",

    *    in="path",

    *    required=true,

    *    @OA\Schema(type="integer")

    *  ),

    *  @OA\Response(response="200",

    *    description="Playlist Deleted",

    *  ),

    *  @OA\Response(response="404",

    *    description="Playlist not found",

    *  )

    * )

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
