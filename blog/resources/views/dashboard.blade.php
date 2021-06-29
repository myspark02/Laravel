<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (count($posts) > 0)
                        @foreach ($posts as $post)
                            <div class=" border-gray-400 my-10 px-10">
                                <img src="/storage/cover_images/{{ $post->cover_image() }}" style="width:20%">
                                <a href="{{ route('posts.show', [$post->id]) }}">
                                    <span class="text-2xl"> {{ $post->title }} </span>
                                </a>
                                <span class="block text-sm"> Written on {{ $post->created_at }}</span>
                            </div>
                        @endforeach
                @else
                    <p> No posts found </p>
                @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
