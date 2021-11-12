<?php

namespace Tests\Feature\Playlist;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

use App\Models\Playlist;

class EditPlaylistTest extends TestCase
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

    public function test_playlist_update()
    {
        $response = $this->post('/api/v1/playlists',[
            'title' => 'Test Title',
            'description' => 'Test Description',
            'author' => 'Test Author'
        ]);

        // $playlists = Playlist::all();
        // $this->assertCount(1, $playlists);

        $playlists = Playlist::first();

        $response = $this->put('/api/v1/playlists/'. $playlists->id, [
            'title' => 'New Title',
            'description' => 'New Description',
            'author' => 'New Author'
        ]);

        $response->assertStatus(200);
    }

    public function test_playlist_exists_before_updating()
    {
        $response = $this->put('/api/v1/playlists/300',[
            'title' => 'New Title',
            'description' => 'New Description',
            'author' => 'New Author'
        ]);

        $response->assertNotFound();
    }

    public function test_title_required()
    {
        $response = $this->post('/api/v1/playlists',[
            'title' => 'Test Title',
            'description' => 'Test Description',
            'author' => 'Test Author'
        ]);

        // $playlists = Playlist::all();
        // $this->assertCount(1, $playlists);

        $playlists = Playlist::first();

        $response = $this->put('/api/v1/playlists/'. $playlists->id, [
            'title' => '',
            'description' => 'New Description',
            'author' => 'New Author'
        ]);

        $response->assertSessionHasErrors(['title']);
    }

    public function test_title_shorter_than_100_characters()
    {
        $response = $this->post('/api/v1/playlists',[
            'title' => 'Test Title',
            'description' => 'Test Description',
            'author' => 'Test Author'
        ]);

        // $playlists = Playlist::all();
        // $this->assertCount(1, $playlists);

        $playlists = Playlist::first();

        $response = $this->put('/api/v1/playlists/'. $playlists->id, [
            'title' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean ma',
            'description' => 'New Description',
            'author' => 'New Author'
        ]);

        $response->assertSessionHasErrors(['title']);
    }

    public function test_author_required()
    {
        $response = $this->post('/api/v1/playlists',[
            'title' => 'Test Title',
            'description' => 'Test Description',
            'author' => 'Test Author'
        ]);

        // $playlists = Playlist::all();
        // $this->assertCount(1, $playlists);

        $playlists = Playlist::first();

        $response = $this->put('/api/v1/playlists/'. $playlists->id, [
            'title' => 'New title',
            'description' => 'Description',
            'author' => ''
        ]);

        $response->assertSessionHasErrors(['author']);
    }

    public function test_author_shorter_than_150_characters()
    {
        $response = $this->post('/api/v1/playlists',[
            'title' => 'Test Title',
            'description' => 'Test Description',
            'author' => 'Test Author'
        ]);

        // $playlists = Playlist::all();
        // $this->assertCount(1, $playlists);

        $playlists = Playlist::first();

        $response = $this->put('/api/v1/playlists/'. $playlists->id, [
            'title' => 'New title',
            'description' => 'Description',
            'author' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis pa'
        ]);

        $response->assertSessionHasErrors(['author']);
    }

    public function test_description_shorter_than_200_characters()
    {
        $response = $this->post('/api/v1/playlists',[
            'title' => 'Test Title',
            'description' => 'Test Description',
            'author' => 'Test Author'
        ]);

        // $playlists = Playlist::all();
        // $this->assertCount(1, $playlists);

        $playlists = Playlist::first();

        $response = $this->put('/api/v1/playlists/'. $playlists->id, [
            'title' => 'New title',
            'description' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec qua',
            'author' => 'New Author'
        ]);

        $response->assertSessionHasErrors(['description']);
    }
}
