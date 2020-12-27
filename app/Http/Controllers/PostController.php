<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('user')->latest()->paginate(10);

        return response()->json($posts , 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
       $userID = auth()->user()->id;
       
       $post = Post::create([
           'user_id' => $userID, 
           'title' => $request->title,
           'description' => $request->description
       ]);

       return response()->json($post , 200);
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::with('user')->find($id);

        if($post) return response()->json($post , 200); 

        return response()->json(['message' => 'Post notfound'] , 404);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {

        // Check for post
        $post = Post::find($id);

        if(!$post) return response()->json(['message' => 'Post not found!'], 404);

        // Check for user owns post
        $userID = auth()->user()->id;
        

        if($post->user_id == $userID){
            
            $post = Post::where('id' , $id)->update([
                'title' => $request->title,
                'description' => $request->description
            ]);
            return response()->json(['message' =>'Successfully updated'] , 200);
        }

        return response(['message' => 'Unauthorized!'],403);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        // Check for post
        $post = Post::find($id);
        
        if(!$post) return response()->json(['message' => 'Post not found!'], 404);

        // Check for user owns post
        $userID = auth()->user()->id;

        if($post->user_id == $userID){
            
            $post->delete();
            
            return response()->json(['message' =>'Successfully removed'] , 200);
        }

        return response(['message' => 'Unauthorized!'],403);
    }
}
