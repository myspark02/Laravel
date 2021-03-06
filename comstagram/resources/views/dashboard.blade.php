<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome to comstagram!') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <div class="grid grid-flow-col auto-cols-max">
            <div class="p-10">
                <img src="/img/yju_comp.jpeg" class="rounded-full h-40 w-40" alt="comstagram main image">
            </div>
            <div>
                <div class="py-5 grid grid-cols-2 flex items-baseline">
                    <div class="text-3xl flex">
                        <h1 class="mr-5">{{ $user->username }}</h1>
                    </div>
                    <div class="ml-5">
                        <a href="{{ route('post.create') }}" class="mr-10">Add new post</a>
                        <a href="{{ route('profile.edit', $user->id) }}">Edit Profile</a>
                    </div>
                </div>
                <div class="flex">
                    <div class="pr-5"><strong>{{ $user->posts->count() }}</strong> posts</div>
                    <div class="pr-5"><strong>{{$user->profile->followers->count()}}</strong> followers</div>
                    <div class="pr-5"><strong>{{$user->following->count()}}</strong> following</div>
                </div>
                <div>
                    <div class="mt-3 font-bold">{{ $user->profile->title ?? 'No title' }}</div>
                    <div class="max-w-sm md:max-w-lg">
                        {{ $user->profile->description ?? 'No description' }}
                    </div>
                    <div><a href="#">{{ $user->profile->url ?? 'No url' }}</a></div>
                </div>
            </div>
        </div>
        <div class="grid grid-flow-col auto-cols-max pt-5 mb-20">
            <div class="grid-cols-4 pr-2">
                <img src="/img/1.jpeg" class="w-32 md:w-auto">
            </div>
            <div class="grid-cols-4 pr-2">
                <img src="/img/2.jpeg" class="w-32 md:w-auto">
            </div>
            <div class="grid-cols-4 pr-2">
                <img src="/img/3.jpeg" class="w-32 md:w-auto">
            </div>
        </div>
    </div>
</x-app-layout>
