<div class="m-2">
    {{-- The whole world belongs to you. --}}
    <!-- component -->
    <div class="flex items-center justify-center h-auto p-4 antialiased bg-gray-200">
        <div class="flex flex-col w-11/12 max-w-2xl mx-auto border border-gray-300 rounded-lg shadow-xl sm:w-5/6 lg:w-1/2">

            <div class="flex flex-col px-6 py-5 bg-gray-50">
                <p class="mb-2 font-semibold text-gray-700">Comment</p>
                <textarea wire:model='newComment'
                    type="text"
                    name=""
                    placeholder="Type message..."
                    class="p-5 mb-5 bg-white border border-gray-200 rounded shadow-sm h-36"
                    id=""></textarea>
                    {{ $newComment }}
                <hr />
                <div class="flex flex-row items-center justify-between p-5 bg-white border border-gray-200 rounded shadow-sm">
                    <div class="flex flex-row items-center">
                        @if ($image)
                            <img class="w-10 h-10 mr-3 rounded-full" src={{ $image->temporaryUrl() }} />
                        @elseif ($orgComment->image)
                            <img class="w-10 h-10 mr-3 rounded-full" src="{{ $orgComment->image_path }}" />
                        @endif
                    {{-- <input type="file" id="image" wire:change="$emit('fileChosen')"> --}}
                        <input type="file" wire:model="image" wire:loading.attr="disabled">
                        <div wire:loading wire:target="image">Uploading...</div>
                        @error('image')
                            <div class="text-red-700">
                                <span class="text-red-700">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="flex flex-row items-center justify-between p-5 bg-white border-t border-gray-200 rounded-bl-lg rounded-br-lg">
                <button wire:click="$emit('closeModal')">No, do not update</button>
                {{-- <button wire:click='$emit("closeMyMoal")' class="font-semibold text-gray-600 rounded">Cancel</button> --}}
                {{-- <button onclick="Livewire.emit('closeMoal')"  class="font-semibold text-gray-600 rounded">Cancel</button> --}}
                <button wire:click='$emit("update")' class="px-4 py-2 font-semibold text-white bg-blue-500 rounded">Update</button>
            </div>
        </div>
    </div>
</div>

