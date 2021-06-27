<x-guest-layout>
    <div class="justify-items-center">
        <a href="{{ route('posts.index') }}"> Go Back</a>
        <div>{{ $post->title }}</div>
        <div>
            {{ $post->body }}
        </div>
        <hr>
        <div>Written on {{ $post->created_at }}</div>
</x-guest-layout>
