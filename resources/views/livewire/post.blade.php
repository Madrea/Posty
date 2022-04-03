<div class="mb-4">
    <div class="card">
        <div class="card-header">
            <a href="{{ route('users.posts', $post->user) }}" class="post-author">{{ $post->user->name }}</a>
            <span class="post-date pl-2">{{ $post->created_at->diffForHumans() }}</span>

            @can('delete', $post)
                <div class="dropdown" style="float:right">
                    <button class="dropdown-toggle" type="button" data-toggle="dropdown" >
                        <i class="fa-solid fa-ellipsis"></i>
                    </button>
                    <div class="dropdown-menu">
                        @can('delete', $post)
                            <button type="submit" wire:click="deletePost" style="margin: auto" class="like-unlike-button pl-4"><i class="fa-solid fa-trash pr-1"></i>Delete</button>
                        @endcan

                        @can('update', $post)
                            <form action="{{ route('posts.edit', $post) }}" method="get" class="mr-1">
                                @csrf
                                <button type="submit" class="like-unlike-button pl-4"><i class="fa-solid fa-pen-to-square pr-1"></i>Edit</button>
                            </form>
                        @endcan
                    </div>
                </div>
            @endcan

        </div>
        <div class="card-body">
            <p class="post-body">{{ $post->body }}</p>

            <div class="image-div">

                @if ($post->image_path)
                    <img src="{{ asset('storage/' . $post->image_path) }}" alt=" " class="image">
                @endif

            </div>

        </div>
        <div class="card-footer">
            <div class="row">
                <span class=" like col" style="float:left"><i class="fa-solid fa-thumbs-up pr-2" style="color:rgb(59 130 246)"></i>{{ $post->likes->count() }}</span>
                <a style="float:right ;text-align:right" href="{{ route('comments.show', $post) }}" class="col">{{ $post->comments->count() }} {{ Str::plural('comment', $post->likes->count()) }}</a>

            </div>

            @auth
                <div class="row" style="margin-top: 10px; border-top: 0.2px solid black;border-bottom: 0.2px solid black; height: 40px">
                    <div class="col">
                        @if (!$post->likedBy(auth()->user()))
                             <button type="submit" wire:click="like" style="width:100%" class="like-unlike-button btn btn-light"><i class="fa-solid fa-thumbs-up pr-1"></i>Like</button>
                        @else
                            <button type="submit" wire:click="like" style="width:100%" class="like-unlike-button btn btn-light"><i class="fa-solid fa-thumbs-down pr-1"></i>Unlike</button>
                        @endif
                    <!-- {{ route('comments.show', $post) }} -->

                    </div>
                    <div class="col">
                        <button type="button" style="width:100%" id="{{ $post->id }}" wire:click="
                        @if($show == false)
                            showBox
                        @else
                            hideBox
                        @endif
                            " class="like-unlike-button btn btn-light btn-outline-none comment-button"><i class="fa-solid fa-message pr-1"></i>Comment</button>
                    </div>
                </div>
            @endauth

            @if($post->comments()->get()->last())
                <div class="row pt-2 pl-4 pr-1" style="width:100%">

                    <div class="comment-div pt-2 pl-3 " style="width:100%">
                        <div class="comment-top">
                            <p class="comment-name">{{ $post->comments()->get()->last()->user()->get()->last()->name }}</p>
                            <p class="pl-3 comment-date">  {{ $post->comments()->get()->last()->created_at->diffForHumans() }}</p>
                        </div>

                        <p class="pb-2 pt-1">{{ $post->comments()->get()->last()->comment }}</p>
                    </div>

                </div>
            @endif

            @if($show)
            <div class=" pt-3" id="{{ 'comment-div' . $post->id }}">
                <div class="make-comment mb-3">
                    <form wire:submit.prevent="add_comment" style="width:100%">
                        <textarea wire:model.defer="comment" name="comment" id="comment" cols="30" rows="4" class="comment-body" placeholder="Write a comment"></textarea>
                        <button type="submit" class="post-comment" wire:click="hideBox"><i class="fa-solid fa-paper-plane"></i></button>
                    </form>

                </div>
            </div>
            @endif
        </div>
    </div>


</div>



