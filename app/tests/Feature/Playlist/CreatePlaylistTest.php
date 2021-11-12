<?php

namespace Tests\Feature\Playlist;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

use App\Models\Playlist;

class CreatePlaylistTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use DatabaseTransactions;

    // public function test_playlist_create()
    // {
    //     $response = $this->post('/api/v1/playlists',[
    //         'title' => 'Test Title',
    //         'description' => 'Test Description',
    //         'author' => 'Test Author'
    //     ]);

    //     $response->assertStatus(201);
    // }

    public function test_playlist_create()
    {
        $response = $this->post('/api/v1/playlists',[
            'title' => 'Test Title',
            'description' => 'Test Description',
            'author' => 'Test Author'
        ]);

        $playlists = Playlist::all();

        $response->assertStatus(201);

        $this->assertCount(1, $playlists);
    }

    public function test_title_required()
    {
        $response = $this->post('/api/v1/playlists',[
            'title' => '',
            'description' => 'Test Description',
            'author' => 'Test Author'
        ]);

        $response->assertSessionHasErrors(['title']);
    }

    public function test_title_shorter_than_100_characters()
    {
        $response = $this->post('/api/v1/playlists',[
            'title' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean ma',
            'description' => 'Test Description',
            'author' => 'Test Author'
        ]);

        $response->assertSessionHasErrors(['title']);
    }

    public function test_author_required()
    {
        $response = $this->post('/api/v1/playlists',[
            'title' => 'New title',
            'description' => 'Description',
            'author' => ''
        ]);

        $response->assertSessionHasErrors(['author']);
    }

    public function test_author_shorter_than_150_characters()
    {
        $response = $this->post('/api/v1/playlists',[
            'title' => 'New title',
            'description' => 'Description',
            'author' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis pa'
        ]);

        $response->assertSessionHasErrors(['author']);
    }

    public function test_description_shorter_than_200_characters()
    {
        $response = $this->post('/api/v1/playlists',[
            'title' => 'New title',
            'description' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec qua',
            'author' => 'Test Author'
        ]);

        $response->assertSessionHasErrors(['description']);
    }
}
