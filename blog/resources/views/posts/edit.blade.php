<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blog') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <form action="{{ route('posts.update', ['post'=>$post->id]) }}" method="post">
        @csrf
        @method('PATCH')
            <div class="m-10 flex justify-between w-3/12">

                <div> Title : </div>
                <div>
                    <input type="text" id="title" name="title" value="{{ $post->title }}" placeholder = "Title" class="form-input">
                </div>
                <div class="block">
                    @error('title')
                        <div class="text-red-400">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="ml-10 flex justify-between w-3/12">
                <div>Content: </div>
                <div>
                    <textarea type="text" id="body" name="body" class="ckeditor form-textarea">{{ $post->body }}</textarea>
                </div>
                <div class="block">
                    @error('body')
                        <div class="text-red-400">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="ml-10">
                <button type="submit" class="bg-blue-500 p-4 rounded-lg text-white text-bold"> Submit</button>
            </div>
       </form>
    </div>


<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.ckeditor').ckeditor();
    });
</script>

</x-app-layout>
