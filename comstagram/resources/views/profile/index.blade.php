<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome to comstagram!') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <div class="grid grid-flow-col auto-cols-max">
            <div class="p-10">
                <img src="/storage/{{ $user->profile->image }}" class="rounded-full h-40 w-40"
                    alt="comstagram main image">
            </div>
            <div>
                <div class="py-5 grid grid-cols-2 flex items-baseline">
                    <div class="text-3xl">
                        <h1>{{ $user->username }}</h1>
                    </div>
                    <div class="ml-5">
                        @can('update', $user->profile)
                            <a href="{{ route('post.create') }}" class="mr-10">Add new post</a>
                        @endcan
                        @can('update', $user->profile)
                            <a href="{{ route('profile.edit', $user->id) }}">Edit Profile</a>
                        @endcan
                    </div>
                </div>
                <div class="flex">
                    <div class="pr-5"><strong>{{ $user->posts->count() }}</strong> posts</div>
                    <div class="pr-5"><strong>23k</strong> followers</div>
                    <div class="pr-5"><strong>212</strong> following</div>
                </div>
                <div>
                    <div class="mt-3 font-bold">{{ $user->profile->title }}</div>
                    <div class="max-w-sm md:max-w-lg">
                        {{ $user->profile->description }}
                    </div>
                    <div><a href="#">{{ $user->profile->url }}</a></div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-3 auto-cols-max">
            @foreach ($user->posts as $post)
                <div class="mt-5 mr-5 pr-5 pt-5">
                    <a href="{{ route('post.show', $post->id) }}">
                        <img src="/storage/{{ $post->image }}" class="w-48 md:w-auto">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
