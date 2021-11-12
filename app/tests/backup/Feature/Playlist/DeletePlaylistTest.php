<?php

namespace Tests\Feature\Playlist;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

use App\Models\Playlist;

class DeletePlaylistTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use DatabaseTransactions;

    // public function test_example()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    public function test_playlists_delete()
    {
        $response = $this->post('/api/v1/playlists',[
            'title' => 'Test Title',
            'description' => 'Test Description',
            'author' => 'Test Author'
        ]);

        // $playlists = Playlist::all();
        // $this->assertCount(1, $playlists);

        $playlists = Playlist::first();

        $response = $this->delete('/api/v1/playlists/' . $playlists->id);

        $response->assertStatus(200);
    }

    public function test_playlists_exists_before_deleting()
    {
        $response = $this->delete('/api/v1/playlists/300');

        $response->assertNotFound();
    }
}
