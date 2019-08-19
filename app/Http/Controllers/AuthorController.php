<?php
namespace App\Http\Controllers;
use App\Author;
use Illuminate\Http\Request;
class AuthorController extends Controller
{
    // return all authors from the database
    public function getAuthors()
    {
        $authors = Author::all();
        return response()->json([
            'authors' => $authors
        ], 200);
    }
    public function getAuthor($authorId)
    {
        $author = Author::find($authorId);
        if (!$author) {
            return response()->json([
                'message' => "author not found"
            ], 404);
        }
        return response()->json([
            'author' => $author
        ], 200);
    }
     // send album to database
     public function postAuthor(Request $request)
     {
         // validate if the request sent contains this parameters
         $validator = Validator::make($request->all(), [
             'name' => 'required'
         ]);
         // validator fails
         if ($validator->fails()) {
             return response()->json([
                 'error' => $validator->errors(),
                 'status' => false
             ], 404);
         }
         $author = new Author();
         $author->name = $request->input('name');
         $author->avatar = $request->input('avatar');
         $author->save();
         return response()->json([
             'album' => $author
         ], 201);
     }
     // edit album in database
    public function putAuthor(Request $request, $authorId)
    {
        // validate if the request sent contains this parameters
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);
        // validator fails
        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'status' => false
            ], 404);
        }
        $author = Author::find($authorId);
        if (!$author) {
            return response()->json([
                'message' => "Author not found"
            ], 404);
        }
        $author->update([
            'name' => $request->input('name')
        ]);
        return response()->json([
            'author' => $author
        ], 206);
    }
    // delete album from database
    public function deleteAuthor($authorId)
    {
        $author = Album::find($authorId);
        if (!$author) {
            return response()->json([
                'message' => 'Author not exists'
            ], 204);
        }
        $author->delete();
        return response()->json([
            'message' => 'Author deleted successfully'
        ], 200);
    }
}
