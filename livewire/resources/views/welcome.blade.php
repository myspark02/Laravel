<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Livewire</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @livewireStyles
    @livewireScripts
</head>

<body class="flex justify-center">
    <div class="flex w-10/12 my-10">
        {{-- @livewire('counter') --}}

        <div class="w-5/12 border rounded">
            @livewire('tickets')
        </div>

        <div class="w-7/12 p-2 mx-2 border rounded">
            @livewire('comments')
        </div>

    </div>

</body>

</html>
