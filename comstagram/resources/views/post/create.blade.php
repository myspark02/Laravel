<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Post!') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- caption -->
            <div class="mt-4">
                <x-label for="caption" :value="__('Post Caption')" />

                <x-input id="caption" class="block mt-1 w-full" type="text" name="caption" :value="old('caption')"
                    autofocus />
            </div>


            <!-- Image -->
            <div class="mt-4">
                <x-label for="image" :value="__('Post Image')" />

                <x-input id="image" class="block mt-1 w-full" type="file" name="image" :value="old('image')"
                    autofocus />
            </div>
            <div class="mt-4">
                <x-button>
                    {{ __('Add New Post') }}
                </x-button>
            </div>
        </form>
    </div>
</x-app-layout>
