<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

use App\Models\Content;
use App\Models\Playlist;

class DeleteContentTest extends TestCase
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

    public function test_contents_delete()
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

        $response = $this->delete('/api/v1/contents/' . $contents->id);

        $response->assertStatus(200);
    }

    public function test_contents_exists_before_deleting()
    {
        $response = $this->delete('/api/v1/contents/300');

        $response->assertNotFound();
    }
}
