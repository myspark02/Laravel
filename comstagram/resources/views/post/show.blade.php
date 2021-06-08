<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome to comstagram!') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 grid grid-cols-2 items-start">
        <div class="mt-5 mr-5">
            <img src="/storage/{{ $post->image }}" class="w-48 md:w-auto">
        </div>
        <div class="mt-5">
            <div class="flex items-center mb-4">
                <img src="/storage/{{ $post->user->profile->image }}" class=" w-24 rounded-full mr-4">
                <span class="font-bold">
                    <a href="{{ route('profile.index', $post->user->id) }}">
                        {{ $post->user->username }}
                    </a>
                </span>
            </div>
            <hr>
            <div class="mt-4">
                <p>
                    <span class="font-bold">
                        <a href="{{ route('profile.index', $post->user->id) }}"> {{ $post->user->username }} </a>
                    </span> {{ $post->caption }}
                </p>
            </div>
        </div>

    </div>
</x-app-layout>
