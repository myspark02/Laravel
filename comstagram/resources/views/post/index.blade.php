<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome to comstagram!') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-40 items-center">
        @foreach ($posts as $post)
            <div class="mt-5 py-4">
                <a href="{{ route('profile.index', $post->user->id) }}"> 
                    <img src="/storage/{{ $post->image }}" class="w-48 md:w-auto">
                </a>
                <p>
                    <span class="font-bold">
                        <a href="{{ route('profile.index', $post->user->id) }}"> {{ $post->user->username }} </a>
                    </span> {{ $post->caption }}
                </p>
            </div>
        @endforeach
        <div class="my-20 justify-center">
            <div> {{$posts->links()}}</div>
        </div>
    </div>
</x-app-layout>
