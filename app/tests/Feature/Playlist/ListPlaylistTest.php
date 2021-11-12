<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

use App\Models\Playlist;

class ListPlaylistTest extends TestCase
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

    public function test_playlists_list()
    {
        $response = $this->get('/api/v1/playlists');

        $response->assertStatus(200);
    }

    public function test_playlists_list_with_insertion()
    {
        $response = $this->post('/api/v1/playlists',[
            'title' => 'Test Title',
            'description' => 'Test Description',
            'author' => 'Test Author'
        ]);

        $playlists = Playlist::all();
        $this->assertCount(1, $playlists);
        
        $response = $this->get('/api/v1/playlists');

        $response->assertStatus(200);
    }

    public function test_playlists_list_if_exists()
    {
        $response = $this->get('/api/v1/playlists/');

        $response->assertJson(["data" => []]);

        // $response->assertJson([
        //     "data" => [],
        //     "links" => [
        //         "first" => "http://localhost/api/v1/playlists?page=1",
        //         "last" => "http://localhost/api/v1/playlists?page=1",
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
        //                 "url" => "http://localhost/api/v1/playlists?page=1",
        //                 "label" => "1",
        //                 "active" => true
        //             ],
        //             [
        //                 "url" => null,
        //                 "label" => "Next &raquo;",
        //                 "active" => false
        //             ]
        //         ],
        //         "path" => "http://localhost/api/v1/playlists",
        //         "per_page" => 10,
        //         "to" => null,
        //         "total" => 0
        //     ]]);
    }
}
