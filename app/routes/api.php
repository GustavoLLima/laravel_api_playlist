<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PlaylistController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
	return $request->user();
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});

// Route::prefix('v1')->group(function(){

// 	Route::prefix('playlists.')->group(function(){
// 		// List playlist
// 		Route::get('/', [PlaylistController::class, 'index']);

// 		// List one playlist
// 		Route::get('/{id}', [PlaylistController::class, 'show']);

// 		// Create new playlist
// 		Route::post('/', [PlaylistController::class, 'store']);

// 		// Update playlist
// 		Route::put('/{id}', [PlaylistController::class, 'update']);

// 		// Delete playlist
// 		Route::delete('/{id}', [PlaylistController::class,'destroy']);
// 	});
// });

Route::prefix('v1')->group(function(){
	Route::apiResource('playlists', PlaylistController::class);
});


// // List playlist
// Route::get('playlists', [PlaylistController::class, 'index']);

// // List one playlist
// Route::get('playlist/{id}', [PlaylistController::class, 'show']);

// // Create new playlist
// Route::post('playlist', [PlaylistController::class, 'store']);

// // Update playlist
// Route::put('playlist/{id}', [PlaylistController::class, 'update']);

// // Delete playlist
// Route::delete('playlist/{id}', [PlaylistController::class,'destroy']);