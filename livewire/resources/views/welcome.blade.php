<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div wire:offline.class='bg-red-300'>
                    You are now offline.
                </div>
                {{-- @livewire('counter') --}}
                <div class="flex my-10 w-12/12">
                    <div class="w-3/12 px-2 ml-2 border rounded">
                        @livewire('user-list')
                    </div>

                    <div class="w-4/12 px-2 border rounded">
                        @livewire('tickets')
                    </div>

                    <div class="w-5/12 p-2 mx-2 border rounded">
                        @livewire('comments')
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
