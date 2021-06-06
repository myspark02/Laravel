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
                <div class="py-5 flex justify-between items-baseline">
                    <div class="text-3xl">
                        <h1>{{ $user->username }}</h1>
                    </div>
                    <div>
                        <a href="{{ route('post.create') }}">Add new post</a>
                    </div>
                </div>
                <div class="flex">
                    <div class="pr-5"><strong>153</strong> posts</div>
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
        <div class="grid grid-flow-col auto-cols-max pt-5">
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
