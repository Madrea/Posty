<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use File;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['store', 'destroy']);
    }

    public function editPost(Post $post)
    {
        return view('posts.update', [
            'post' => $post
        ]);
    }

    public function updatePost(Post $post, Request $request)
    {
        $this->authorize('update', $post);

        Post::find($post->id)->update([
            'body'=>$request->input('postBody'),
        ]);

        return redirect('/posts');

    }



}
