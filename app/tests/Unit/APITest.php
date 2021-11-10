<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class APITest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
  //   public function test_example()
  //   {
		// $response = $this->get('/api/v1/playlists');
		// $response->assertStatus(200);
  //   }

    // public function test_insert_API()
    // {
    // 	$response = $this->post('/api/v1/playlists',[
    // 		'title' => 'Título',
    // 		'description' => 'Descrição',
    // 		'author' => 'Alguém'
    // 	]);

    // 	$response->assertStatus(201);
    // }


    //playlists

    public function test_playlists_insert()
    {
    	$response = $this->post('/api/v1/playlists',[
    		'title' => 'Título',
    		'description' => 'Descrição',
    		'author' => 'Alguém'
    	]);

    	$response->assertStatus(201);
    }

    public function test_playlists_list()
    {
    	$response = $this->get('/api/v1/playlists');

    	$response->assertStatus(200);
    }

    public function test_playlists_edit()
    {
    	$response = $this->put('/api/v1/playlists/10',[ 
    		'title' => 'Título novo',
    		'description' => 'Descrição nova',
    		'author' => 'Alguém novo'
    	]);

    	$response->assertStatus(200);
    }

    public function test_playlists_delete()
    {
    	$response = $this->delete('/api/v1/playlists/10');

    	$response->assertStatus(200);
    }


    //contents

    public function test_contents_insert()
    {
    	$response = $this->post('/api/v1/contents',[
    		'title' => 'Título',
    		'url' => 'www.google.com.br',
    		'author' => 'Alguém',
    		'playlist_id' => 11
    	]);

    	$response->assertStatus(201);
    }

    public function test_contents_list()
    {
    	$response = $this->get('/api/v1/contents');

    	$response->assertStatus(200);
    }

    public function test_contents_edit()
    {
    	$response = $this->put('/api/v1/contents/5',[ 
    		'title' => 'Título novo',
    		'url' => 'www.youtube.com.br',
    		'author' => 'Alguém novo',
    		'playlist_id' => 12
    	]);

    	$response->assertStatus(200);
    }

    public function test_contents_delete()
    {
    	$response = $this->delete('/api/v1/contents/5');

    	$response->assertStatus(200);
    }
}
