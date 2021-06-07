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
            <h3>{{ $post->user->username }}</h3>
            <p>{{ $post->caption }}</p>
        </div>
    </div>
</x-app-layout>
