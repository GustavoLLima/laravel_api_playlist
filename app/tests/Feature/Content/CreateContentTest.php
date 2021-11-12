<?php

namespace Tests\Feature\Content;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

use App\Models\Content;
use App\Models\Playlist;

class CreateContentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use DatabaseTransactions;

    public function test_content_create()
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

        $contents = Content::all();

        $response->assertStatus(201);

        $this->assertCount(1, $contents);
    }

    public function test_title_required()
    {
        $response = $this->post('/api/v1/playlists',[
            'title' => 'Test Title',
            'description' => 'Test Description',
            'author' => 'Test Author'
        ]);

        $playlists = Playlist::first();

        $response = $this->post('/api/v1/contents',[
            'title' => '',
            'url' => 'Test Url',
            'author' => 'Test Author',
            'playlist_id' => $playlists->id
        ]);

        $response->assertSessionHasErrors(['title']);
    }

    public function test_title_shorter_than_150_characters()
    {
        $response = $this->post('/api/v1/contents',[
            'title' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis pa',
            'url' => 'Test url',
            'author' => 'Test Author'
        ]);

        $response->assertSessionHasErrors(['title']);
    }

    public function test_url_required()
    {
        $response = $this->post('/api/v1/playlists',[
            'title' => 'Test Title',
            'description' => 'Test Description',
            'author' => 'Test Author'
        ]);

        $playlists = Playlist::first();

        $response = $this->post('/api/v1/contents',[
            'title' => 'Test Title',
            'url' => '',
            'author' => 'Test Author',
            'playlist_id' => $playlists->id
        ]);

        $response->assertSessionHasErrors(['url']);
    }

    public function test_url_shorter_than_255_characters()
    {
        $response = $this->post('/api/v1/contents',[
            'title' => 'Test Title',
            'url' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis,.',
            'author' => 'Test Author'
        ]);

        $response->assertSessionHasErrors(['url']);
    }

    public function test_playlist_id_required()
    {
        $response = $this->post('/api/v1/playlists',[
            'title' => 'Test Title',
            'description' => 'Test Description',
            'author' => 'Test Author'
        ]);

        $playlists = Playlist::first();

        $response = $this->post('/api/v1/contents',[
            'title' => 'Test Title',
            'url' => '',
            'author' => 'Test Author'
        ]);

        $response->assertSessionHasErrors(['playlist_id']);
    }

    public function test_playlist_id_not_null()
    {
        // $response = $this->post('/api/v1/playlists',[
        //     'title' => 'Test Title',
        //     'description' => 'Test Description',
        //     'author' => 'Test Author'
        // ]);

        // $playlists = Playlist::first();

        $response = $this->post('/api/v1/contents',[
            'title' => 'Test Title',
            'url' => '',
            'author' => 'Test Author',
            'playlist_id' => NULL
        ]);

        $response->assertSessionHasErrors(['playlist_id']);
    }

    public function test_author_shorter_than_150_characters()
    {
        $response = $this->post('/api/v1/playlists',[
            'title' => 'Test Title',
            'description' => 'Test Description',
            'author' => 'Test Author'
        ]);

        $playlists = Playlist::first();

        $response = $this->post('/api/v1/contents',[
            'title' => 'New title',
            'url' => 'url',
            'author' => 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis pa',
            'playlist_id' => $playlists->id
        ]);

        $response->assertSessionHasErrors(['author']);
    }
}
