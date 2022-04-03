@extends('layouts.app')

@section('content')
    <div class="section-div-1">
        <div class="section-div-2">
            <a href="{{ route('users.posts', $post->user) }}" class="post-author">{{ $post->user->name }}</a> 
            <span class="post-date">{{ $post->created_at->diffForHumans() }}</span>
            
            <div class="mt-1">
               
                <form action="{{ route('posts.update', $post) }}" method="post" class="form-edit">
                    @csrf

                    <div>
                    <label for="postBody" class="register-label">Name</label>
                    <textarea class="textarea" contenteditable="true" name="postBody" id="postBody" value="{{ $post->body }}">{{ $post->body }}</textarea>
                    </div>
                    
                    <button type="submit" class="edit-button">Submit changes</button>
                </form>

            </div>
        </div>
    </div>
@endsection
