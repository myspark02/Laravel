<div>
    <h1 class="text-3xl">User List</h1>

    @foreach ($users as $user)
        <div class="p-3 my-2 border rounded shadow  {{$active == $user->id ? 'bg-green-400':''}}">
            <div class="flex justify-between my-2">
                <div class="flex">
                    <p class="text-lg font-bold">{{ $user->name }}</p>
                    <p class="py-1 mx-3 text-xs font-semibold text-gray-500">
                        {{ $user->created_at->diffForHumans() }}
                    </p>
                </div>
                <i wire:click="$emit('userSelected', {{ $user->id }})"
                    class="text-red-200 cursor-pointer fa fa-info-circle hover:text-red-600" aria-hidden="true"></i>

            </div>
            {{-- @if ($user->image)
                <img src="{{ $user->image }}" />
            @endif --}}
        </div>
    @endforeach

    {{ $users->links() }}
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

    window.addEventListener('livewire-upload-error', ()=>{
        alert('Failed to upload file. Unsupported file type?');
    })
</script>
