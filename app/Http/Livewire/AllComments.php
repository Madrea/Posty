<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;
use App\Models\Comment;

class AllComments extends Component
{
    public \App\Models\Post $post;
    public User $user;
    public Comment $actualComment;

    public function mount($post){
        $this->post = $post;
    }

    public function render()
    {
        $comments = \App\Models\Comment::latest()->where('post_id', $this->post->id)->paginate(10);
        return view('livewire.all-comments', [
            'post' => $this->post,
            'comments' => $comments,
        ])->extends('layouts.app');
    }


    public $rules = [
        'comment' => 'required',
    ];

    public function likePost()
    {
        $this->user = auth()->user();

        if (!$this->post->likedBy($this->user))
        {
            $this->post->likes()->create([
                'user_id' => $this->user['id'],
                'post_id' => $this->post['id']
            ]);
        }
        else
        {
            $this->post->likes->where('user_id', $this->user['id'])->first()->delete();
        }

        $this->post->refresh();
    }

    public function likeComment($commentId)
    {
        $this->user = auth()->user();

        $this->actualComment = $this->post->comments()->get()->where('id', $commentId)->first();

        if (!$this->actualComment->likedBy($this->user))
        {
            $this->actualComment->likes()->create([
                'user_id' => $this->user['id'],
                'comment_id' => $this->actualComment['id']
            ]);
        }
        else
        {
            $this->actualComment->likes->where('user_id', $this->user['id'])->first()->delete();
        }

        $this->post->refresh();
    }

    public function deleteComment($commentId)
    {
        $this->actualComment = $this->post->comments()->get()->where('id', $commentId)->first();
        $this->actualComment->delete();
        $this->post->refresh();

    }

    public function deletePost()
    {

        if($this->post->image_path)
        {
            $imagePath = 'storage/' . $this->post->image_path;
            unlink($imagePath);
        }

        if($this->post->comments())
        {
            $this->post->comments()->delete();
        }

        $this->post->delete();
        return redirect('/posts');

    }

}
