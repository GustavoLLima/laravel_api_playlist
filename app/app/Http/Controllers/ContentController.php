<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Http\Resources\ContentResource;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $contents = Content::paginate(10);
        //$contents = Content::with('playlist')->paginate(10);
        return ContentResource::collection($contents);
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
        $content = new Content;
        $content->playlist_id = $request->playlist_id;
        $content->title = $request->title;
        $content->url = $request->url;
        $content->author = $request->author;

        if( $content->save() ){
            return new ContentResource( $content );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $content = Content::findOrFail( $id );
        return new ContentResource( $content );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function edit(Content $content)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $content_id)
    {
        //
        $content = Content::findOrFail( $content_id );
        $content->playlist_id = $request->playlist_id;
        $content->title = $request->title;
        $content->url = $request->url;
        $content->author = $request->author;

        //dd($request->id);

        if( $content->save() ){
            // dd($content);
            return new ContentResource( $content );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $content = Content::findOrFail( $id );
        if( $content->delete() ){
          return new ContentResource( $content );
        }
    }
}
