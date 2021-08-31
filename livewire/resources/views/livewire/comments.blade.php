<div>
    <h1 class="text-3xl">Comments</h1>
    @error('newComment') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
    <div>
        @if (session()->has('message'))
            <div class="p-3 text-green-800 bg-green-300 rounded shadow-sm">
                {{ session('message') }}
            </div>
        @endif
    </div>

    <section>
        @if ($image)
            <img src={{ $image }} width="200" />
        @endif
        <input type="file" id="image" wire:change="$emit('fileChosen')">
    </section>

    <form class="flex my-4" wire:submit.prevent="addComment">
        <input wire:model.lazy="newComment" type="text" class="w-full p-2 my-2 mr-2 border rounded shadow"
            placeholder="What's in your mind.">
        <div class="py-2">
            <button class="w-20 p-2 text-white bg-blue-500 rounded shadow">Add</button>
        </div>
    </form>
    @foreach ($comments as $comment)
        <div class="p-3 my-2 border rounded shadow">
            <div class="flex justify-between my-2">
                <div class="flex">
                    <p class="text-lg font-bold">{{ $comment->writer->name }}</p>
                    <p class="py-1 mx-3 text-xs font-semibold text-gray-500">{{ $comment->created_at->diffForHumans() }}
                    </p>
                </div>
                {{-- <i  wire:click="remove({{ $comment->id }})" class="text-red-200 cursor-pointer fa fa-times hover:text-red-600" aria-hidden="true"></i> --}}
                <i  wire:click="$emit('deleteClicked', {{ $comment->id }})" class="text-red-200 cursor-pointer fa fa-times hover:text-red-600" aria-hidden="true"></i>
            </div>
            <p class="text-gray-800">{{ $comment->body }}</p>
            @if ($comment->image)
                <img src="{{ $comment->image_path }}" />
            @endif
        </div>
    @endforeach

    {{ $comments->links() }}
</div>

<script>
    window.livewire.on('fileChosen', () => {
        // alert('File selected')
        let inputField = document.getElementById('image')
        let file = inputField.files[0]
        let reader = new FileReader();
        reader.onloadend = () => {
            // console.log(reader.result)
            window.livewire.emit('fileUpload', reader.result)
        }
        reader.readAsDataURL(file);
    })

    window.livewire.on('deleteClicked', (id) => {
        if (confirm('Are you sure to delete')) {
            window.livewire.emit('delete', id)
        }
    })
</script>