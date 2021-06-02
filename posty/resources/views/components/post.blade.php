<div>
    <!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->
    <div class="mb-4">
        <a href="{{ route('users.posts', $post->user) }}" class="font-bold">{{ $post->user->name }}</a>
        <span class="text-gray-600 text-sm">
            {{ $post->created_at->diffForHumans() }}
        </span>
        <p>{{ $post->body }}</p>

        {{-- @if ($post->ownedBy(@auth->user())) --}}
        @can('delete', $post)
            <div>
                <form action="{{ route('posts.delete', $post) }}" method="post">
                    @csrf
                    @method('delete')
                    <button class="text-blue-500">Delete</button>
                </form>
            </div>
        @endcan
        {{-- @endif --}}
        <div class="flex items-center">
            @auth
                @if (!$post->likedBy(auth()->user()))
                    <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1">
                        @csrf
                        <button type="submit" class="text-blue-500">
                            Like
                        </button>
                    </form>
                @else
                    <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1">
                        @method('delete')
                        @csrf
                        <button type="submit" class="text-blue-500">
                            Unlike
                        </button>
                    </form>
                @endif
            @endauth
            <span>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }} </span>
        </div>
    </div>
</div>
