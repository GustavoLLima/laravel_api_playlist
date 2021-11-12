<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

use App\Models\Content;
use App\Models\Playlist;

class ListContentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function test_example()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }
    use DatabaseTransactions;

    public function test_contents_list()
    {
        $response = $this->get('/api/v1/contents');

        $response->assertStatus(200);
    }

    public function test_contents_list_with_insertion()
    {
        $response = $this->post('/api/v1/playlists',[
            'title' => 'Test Title',
            'description' => 'Test Description',
            'author' => 'Test Author'
        ]);

        $playlists = Playlist::first();

        $response = $this->post('/api/v1/contents',[
            'title' => 'Test Title',
            'url' => 'Test Url',
            'author' => 'Test Author',
            'playlist_id' => $playlists->id
        ]);

        // $contents = Content::all();
        // $this->assertCount(1, $contents);

        $contents = Content::first();
        
        $response = $this->get('/api/v1/contents');

        $response->assertStatus(200);
    }

    public function test_contents_list_if_exists()
    {
        $response = $this->get('/api/v1/contents/');

        $response->assertJson(["data" => []]);

        // $response->assertJson([
        //     "data" => [],
        //     "links" => [
        //         "first" => "http://localhost/api/v1/contents?page=1",
        //         "last" => "http://localhost/api/v1/contents?page=1",
        //         "prev" => null,
        //         "next" => null
        //     ],
        //     "meta" => [
        //         "current_page" => 1,
        //         "from" => null,
        //         "last_page" => 1,
        //         "links" => [
        //             [
        //                 "url" => null,
        //                 "label" => "&laquo; Previous",
        //                 "active" => false
        //             ],
        //             [
        //                 "url" => "http://localhost/api/v1/contents?page=1",
        //                 "label" => "1",
        //                 "active" => true
        //             ],
        //             [
        //                 "url" => null,
        //                 "label" => "Next &raquo;",
        //                 "active" => false
        //             ]
        //         ],
        //         "path" => "http://localhost/api/v1/contents",
        //         "per_page" => 10,
        //         "to" => null,
        //         "total" => 0
        //     ]]);
    }

    public function test_contents_pagination()
    {
        $response = $this->post('/api/v1/playlists',[
            'title' => 'Test Title',
            'description' => 'Test Description',
            'author' => 'Test Author'
        ]);

        $playlists = Playlist::first();

        for ($i=1; $i < 15 ; $i++) { 
            $response = $this->post('/api/v1/contents',[
                'title' => 'Test Title',
                'url' => 'Test Url',
                'author' => 'Test Author',
                'playlist_id' => $playlists->id
            ]);

            $contents = Content::all();
            $this->assertCount($i, $contents);
        }
        
        $response = $this->get('/api/v1/contents');

        //dd($response);

        $this->assertCount(10, $response['data']);

        $response = $this->get('/api/v1/contents?page=2');

        $this->assertCount(4, $response['data']);
    }
}
