<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="container ui" id="userlist">
        <github-user-list/>
    </div>

</x-app-layout>
