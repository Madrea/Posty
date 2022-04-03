<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\User;
use Livewire\Component;

class UserPosts extends Component
{
    public User $user;
    public $likes;

    protected $listeners = ['postDeleted' => 'deletePost'];

    public function mount($user){
        $this->user = $user;
    }

    public function deletePost()
    {
        return view('livewire.user-posts',
            [
                'posts' => \App\Models\Post::latest()->where('user_id', $this->user->id)->paginate(10)
            ] )->extends('layouts.app');
    }

    public function render()
    {
        return view('livewire.user-posts',
            [
                'posts' => \App\Models\Post::latest()->where('user_id', $this->user->id)->paginate(10)
            ] )->extends('layouts.app');
    }
}
