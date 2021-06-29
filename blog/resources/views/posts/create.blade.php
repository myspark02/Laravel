<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blog') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="m-10 flex justify-between">

                <div> Title : </div>
                <div class="w-5/12">
                    <input type="text" id="title" name="title" placeholder = "Title" class="form-input">
                </div>
                <div class="block">
                    @error('title')
                        <div class="text-red-400">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="ml-10 flex justify-between">
                <div>Content: </div>
                <div class="w-6/12">
                    <textarea type="text" id="body" name="body" class="ckeditor form-textarea"></textarea>
                </div>
                <div class="block">
                    @error('body')
                        <div class="text-red-400">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="ml-10 mt-10 flex justify-between">
                <div>Cover Image: </div>
                <div class="w-6/12">
                    <input type="file" name="cover_image" class="form-file">
                </div>
                <div class="block">
                    @error('body')
                        <div class="text-red-400">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="grid mt-20 justify-items-center">
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
