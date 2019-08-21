<?php
namespace App\Http\Controllers;
use App\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class AlbumController extends Controller
{
    // return all albums from the database
    public function getAlbums()
    {
        $albums = Album::all();
        return response()->json([
            'albums' => $albums
        ], 200);
    }
    // return a single album
    public function getAlbum($albumId)
    {
        $album = Album::find($albumId);
        if (!$album) {
            return response()->json([
                'message' => "Album not found"
            ], 404);
        }
        return response()->json([
            'album' => $album
        ], 200);
    }
    // send album to database
    public function postAlbum(Request $request)
    {
        // validate if the request sent contains this parameters
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'subtitle' => 'required',
            'is_hot' => 'required',
            'details' => 'required',
            'author_id' => 'required'
        ]);
        // validator fails
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'status' => false
            ], 404);
        }
            
            $author = Author::find($author_id);
            if(!$author){
                return response()->json(['error'=>"Author not found"],404);
            }
        
        $album = new Album();
        $album->title = $request->input('title');
        $album->subtitle = $request->input('subtitle');
        $album->is_hot = $request->input('is_hot');
        $album->details = $request->input('details');
        $album->author_id = $request->input('author_id');
        $album->cover = $request->input('cover');
        $author->albums()->save($album);
        return response()->json([
            'album' => $album
        ], 201);
    }
    // edit album in database
    public function putAlbum(Request $request, $albumId)
    {
        // validate if the request sent contains this parameters
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'subtitle' => 'required',
            'is_hot' => 'required',
            'details' => 'required',
            'author_id' => 'required'
        ]);
        // validator fails
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'status' => false
            ], 404);
        }
        $album = Album::find($albumId);
        if (!$album) {
            return response()->json([
                'message' => "Album not found"
            ], 404);
        }
        $album->update([
            'title' => $request->input('title'),
            'subtitle' => $request->input('subtitle'),
            'is_hot' => $request->input('is_hot'),
            'details' => $request->input('details'),
            'author_id' => $request->input('author_id'),
            'cover' => $request->input('cover'),
        ]);
        return response()->json([
            'album' => $album
        ], 206);
    }
    // delete album from database
    public function deleteAlbum($albumId)
    {
        $album = Album::find($albumId);
        if (!$album) {
            return response()->json([
                'message' => 'Album not exists'
            ], 204);
        }
        $album->delete();
        return response()->json([
            'message' => 'Album deleted successfully'
        ], 200);
    }
}