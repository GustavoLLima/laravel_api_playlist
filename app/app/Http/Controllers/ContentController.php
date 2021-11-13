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

    /**
    * @OA\Get(

    *  path="/contents",

    *  tags={"Contents"},

    *  operationId="accountValidate",

    *  summary="Content List",

    *  @OA\Response(response="200",

    *    description="List of Contents",

    *  )

    * )

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
    * @OA\Post(

    *  path="/contents",

    *  tags={"Contents"},

    *  operationId="accountValidate",

    *  summary="Contents Creation",

    *  @OA\Parameter(name="title",

    *    in="query",

    *    required=true,

    *    @OA\Schema(type="string")

    *  ),

    *  @OA\Parameter(name="url",

    *    in="query",

    *    required=true,

    *    @OA\Schema(type="string")

    *  ),

    *  @OA\Parameter(name="author",

    *    in="query",

    *    required=false,

    *    @OA\Schema(type="string")

    *  ),

    *  @OA\Parameter(name="playlist_id",

    *    in="query",

    *    required=true,

    *    @OA\Schema(type="integer")

    *  ),

    *  @OA\Response(response="201",

    *    description="Content created",

    *  )

    * )

    */

    public function store(Request $request)
    {
        //
        $request->validate([
            'playlist_id' => 'required',
            'title' => 'required|max:150',
            'url' => 'required|max:255',
            'author' => 'max:150'
        ]);

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

    /**
    * @OA\Put(

    *  path="/contents/{content}",

    *  tags={"Contents"},

    *  operationId="content_id",

    *  summary="Content Update",

    *  @OA\Parameter(name="title",

    *    in="query",

    *    required=true,

    *    @OA\Schema(type="string")

    *  ),

    *  @OA\Parameter(name="url",

    *    in="query",

    *    required=true,

    *    @OA\Schema(type="string")

    *  ),

    *  @OA\Parameter(name="author",

    *    in="query",

    *    required=false,

    *    @OA\Schema(type="string")

    *  ),

    *  @OA\Parameter(name="content",

    *    in="path",

    *    required=true,

    *    @OA\Schema(type="integer")

    *  ),

    *  @OA\Parameter(name="playlist_id",

    *    in="query",

    *    required=true,

    *    @OA\Schema(type="integer")

    *  ),

    *  @OA\Response(response="201",

    *    description="Content Updated",

    *  ),

    *  @OA\Response(response="404",

    *    description="Content not found",

    *  )

    * )

    */

    public function update(Request $request, $content_id)
    {
        //
        $request->validate([
            'playlist_id' => 'required',
            'title' => 'required|max:150',
            'url' => 'required|max:255',
            'author' => 'max:150'
        ]);

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

    /**
    * @OA\delete(

    *  path="/contents/{content}",

    *  tags={"Contents"},

    *  operationId="content_id",

    *  summary="Content Delete",

    *  @OA\Parameter(name="content",

    *    in="path",

    *    required=true,

    *    @OA\Schema(type="integer")

    *  ),

    *  @OA\Response(response="200",

    *    description="Content Deleted",

    *  ),

    *  @OA\Response(response="404",

    *    description="Content not found",

    *  )

    * )

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
