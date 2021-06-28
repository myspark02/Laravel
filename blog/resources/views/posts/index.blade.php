<x-guest-layout>
    <div class="justify-items-center max-width-md">
        @if(session('success'))
            <div class="m-10">
                <span class="text-red-500">
                    {{ session('success') }}
                </span>
            </div>
        @endif

        @if (count($posts) > 0)
            @foreach ($posts as $post)
                <div class=" border-gray-400 my-4 px-10">
                    <a href="{{ route('posts.show', [$post->id]) }}">
                        <span class="text-2xl"> {{ $post->title }} </span>
                    </a>
                    <span class="block text-sm"> Written on {{ $post->created_at }}</span>
                </div>
            @endforeach
            <div>
                {{ $posts->links() }}
            </div>
        @else
            <p> No posts found </p>
        @endif
    </div>
</x-guest-layout>
