<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Like;
use App\Models\User;
use Livewire\Component;
use File;

class Post extends Component
{
    public \App\Models\Post $post;
    public User $user;
    public  $comment;
    public $show = false;

    public function render()
    {
        return view('livewire.post');
    }

    public function mount($post){
        $this->post = $post;
        $this->comment = '';
    }

    public $rules = [
        'comment' => 'required',
    ];

    public function like(){
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

        $this->emit('postDeleted');
        $this->post->refresh();
    }

    public function add_comment(){
        $this->user = auth()->user();

        Comment::create([
            'user_id' => $this->user['id'],
            'post_id' => $this->post['id'],
            'comment' => $this->comment
        ]);
        $this->comment = '';
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

        $this->emit('postDeleted');

    }

    public function showBox()
    {
        return $this->show = true;
    }

    public function hideBox()
    {
        return $this->show = false;
    }




}
