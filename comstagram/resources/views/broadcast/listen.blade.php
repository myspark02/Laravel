<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Post!') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

    </div>
    <div id="app">
        <channel-msg user-id="{{ Auth::user()->id }}"></channel-msg>
    </div>

</x-app-layout>
