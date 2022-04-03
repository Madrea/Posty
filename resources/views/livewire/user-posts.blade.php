<div class="section-div-1">
    <div class="user-posts-1">
        <div class="p-6 ml-4">
            <h1 class="posts-header">{{ $user->name }}</h1>
            <p>Posted {{ $posts->count() }} {{ Str::plural('post', $posts->count())}} and received {{ $user->receivedLikes->count() }} likes</p>
        </div>
        <div class="user-posts-2">
            @if ($posts->count())
                @foreach ($posts as $post)
                    <livewire:post :post="$post" wire:key="{{rand()}}">
                @endforeach

                {{ $posts->links('pagination::bootstrap-5') }}

                @else
                    <p>{{ $user->name }} does not have any posts</p>
            @endif
        </div>
    </div>
</div>
