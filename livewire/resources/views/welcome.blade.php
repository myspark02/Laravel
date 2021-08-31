<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {{-- @livewire('counter') --}}
                <div class="flex w-10/12 my-10">
                    <div class="w-5/12 px-2 border rounded">
                        @livewire('tickets')
                    </div>

                    <div class="w-7/12 p-2 mx-2 border rounded">
                        @livewire('comments')
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
