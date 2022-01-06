<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contents')->insert([
            'title' => 'Rock music 1',
            'url' => 'https://www.youtube.com/watch?v=mh_1ET6OXR8',
            'author' => 'Rock lover',
            'playlist_id' => DB::table('playlists')->where('title', 'Rock Playlist')->first()->id,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('contents')->insert([
            'title' => 'Rock music 2',
            'url' => 'https://www.youtube.com/watch?v=26nsBfLXwSQ',
            'author' => 'Rock lover2',
            'playlist_id' => DB::table('playlists')->where('title', 'Rock Playlist')->first()->id,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('contents')->insert([
            'title' => 'Pop music 1',
            'url' => 'https://www.youtube.com/watch?v=mh_1ET6OXR8',
            'author' => 'Pop lover',
            'playlist_id' => DB::table('playlists')->where('title', 'Pop Playlist')->first()->id,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        DB::table('contents')->insert([
            'title' => 'Pop music 2',
            'url' => 'https://www.youtube.com/watch?v=26nsBfLXwSQ',
            'author' => 'Pop lover2',
            'playlist_id' => DB::table('playlists')->where('title', 'Pop Playlist')->first()->id,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
