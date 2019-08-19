<?php
use App\Http\Controllers\AlbumController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('albums', ['uses' => 'AlbumController@getAlbums']);
Route::get('authors', ['uses' => 'AuthorController@getAuthors']);
Route::post('author', ['uses' => 'AuthorController@postAuthor']);
Route::post('album/{authorId}', ['uses' => 'AlbumController@postAlbum']);
Route::get('album/{albumId}', ['uses' => 'AlbumController@getAlbum']);
Route::put('album/{albumId}', ['uses' => 'AlbumController@putAlbum']);
Route::delete('album/{albumId}', ['uses' => 'AlbumController@deleteAlbum']);
Route::get('author/{authorId}', ['uses' => 'AuthorController@getAuthor']);
Route::put('author/{authorId}', ['uses' => 'AuthorController@putAuthor']);
Route::delete('author/{authorId}', ['uses' => 'AuthorController@deleteAuthor']);

