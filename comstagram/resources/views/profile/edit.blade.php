<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Profile') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <div class="container mx-auto px-4">
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data">
                @method('PATCH')
                @csrf

                <!-- title -->
                <div class="mt-4">
                    <x-label for="title" :value="__('Title')" />

                    <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')"
                        autofocus />
                </div>


                <!-- description -->
                <div class="mt-4">
                    <x-label for="description" :value="__('Description')" />

                    <x-input id="description" class="block mt-1 w-full" type="text" name="description"
                        :value="old('description')" autofocus />
                </div>

                <!-- url -->
                <div class="mt-4">
                    <x-label for="url" :value="__('url')" />

                    <x-input id="url" class="block mt-1 w-full" type="text" name="url" :value="old('url')" autofocus />
                </div>
                <div class="mt-4">

                    <!-- Profile image -->
                    <div class="mt-4">
                        <x-label for="image" :value="__('Profile image')" />

                        <x-input id="image" class="block mt-1 w-full" type="file" name="image" :value="old('image')"
                            autofocus />
                    </div>
                    <div class="mt-4">

                        <x-button>
                            {{ __('Save Profilez') }}
                        </x-button>
                    </div>
            </form>
        </div>
    </div>
</x-app-layout>
