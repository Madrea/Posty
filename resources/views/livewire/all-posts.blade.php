<div class="section-div-1">
    <div class="section-div-2">

        @auth
            <form wire:submit.prevent="add_post" class="mb-4" enctype="multipart/form-data">

                @csrf
                <div class="mb-4 txt-image-div">
                    <label for="body"></label>
                    <textarea wire:model.defer="post.body" name="body" id="body" cols="30" rows="4"
                              class="textarea @error('body') textarea-error @enderror"
                              placeholder="Post something!"></textarea>

                    @error('body')
                    <div class="error">
                        {{ $message }}
                    </div>
                    @enderror
                    <input wire:model="photo" type="file" name="image" id="image" class="file-input " hidden>
                    <label for="image" class="image-button mt-1"><i class="fa-solid fa-image"></i>Photo</label>

                </div>

                <div>
                    <button type="submit" class="submit-button">
                        Post
                    </button>
                </div>
            </form>
        @endauth

        @if ($posts->count())
            @foreach ($posts as $post)
                <livewire:post :post="$post" wire:key="{{rand()}}">
                    {{--                   <x-post :post="$post"/> --}}
            @endforeach

            {{ $posts->links('pagination::bootstrap-5') }}

            @else
                    <p  class="no-posts">There are no posts !</p>
        @endif
    </div>
</div>



