<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @csrf
    @livewireStyles
</head>
<body>
   
    {{-- <form> --}}
        {{-- @csrf --}}
        <livewire:counter />
    {{-- </form>  --}}

    @livewireScripts
</body>
</html>