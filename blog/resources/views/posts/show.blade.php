<x-guest-layout>
    <div class="m-20 justify-items-center">
        <a href="{{ route('posts.index') }}"> Go Back</a>
        <img src="/storage/cover_images/{{ $post->cover_image() }}" style="width:40%">
        <div>{{ $post->title }}</div>
        <div>
            {!! $post->body !!}
        </div>
        <hr>
        <div>Written by {{ $post->user->name }} on {{ $post->created_at }}</div>
        <hr>
        <div class="flex mt-5 flex-row">
            @auth
                @can('update', $post)
                    <a  class="rounded-lg p-2  flex bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50"
                        href="{{ route('posts.edit', ['post'=>$post->id]) }}">Edit</a>

                    <form action="{{ route('posts.update', ['post'=>$post->id]) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="ml-5  rounded-lg p-2 flex bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-opacity-50">
                            Delete
                        </button>
                    </form>
                @endcan
            @endauth
        </div>


    </div>
</x-guest-layout>
