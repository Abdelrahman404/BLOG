<?php

namespace App\Http\Middleware;

use App\Post;
use Closure;

class CheckOwnedPost
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

     
        // return $id;
        
        // $userID = auth()->user()->id;

        // $postID = $request->post_id;

        // $post = Post::find($postID);

        // if($post->user_id == $userID){
        //     return $next($request);
        // }

        return response()->json('Unauthorized',401);
    }
}
