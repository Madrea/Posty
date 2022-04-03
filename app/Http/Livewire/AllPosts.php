<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Illuminate\Http\File;


class AllPosts extends Component
{
    use WithPagination;
    use WithFileUploads;

    public \App\Models\Post $post;
    public User $user;
    public $photo;

    protected $listeners = ['postDeleted' => 'deletePost'];

    public function deletePost()
    {
        return view('livewire.all-posts',
            [
                'posts' => \App\Models\Post::latest()->paginate(10)
            ] )->extends('layouts.app');
    }


    public function render()
    {
        return view('livewire.all-posts',
        [
            'posts' => \App\Models\Post::latest()->paginate(10)
        ] )->extends('layouts.app');
    }

    public $rules = [
        'post.body' => 'required',
        'post.image_path'  => ''
    ];

    public function mount(){
        $this->post = new \App\Models\Post();
    }

    public function add_post()
    {
        $this->user = auth()->user();

        if($this->photo)
        {

            $imagePath = $this->photo->store('images', 'public');

            $this->user->posts()->create([
                'body' => $this->post->body,
                'image_path' => $imagePath,
            ]);
            $this->post->body = '';
            $this->post->image_path='';
            $this->photo = '';

        }
        else
        {


            $this->user->posts()->create([
                'body' => $this->post->body,
            ]);
            $this->post->body = '';
            $this->post->image_path='';
            $this->photo = '';
            //will automatically fill in the user id
        }

    }
}
