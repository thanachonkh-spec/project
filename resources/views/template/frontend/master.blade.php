<!DOCTYPE html>
<html lang="en">
<head>
   @include('template.frontend.css')
   @livewireStyles
</head>
<body>
    @include('template.frontend.header')
    <div class="py-30"></div>
@include('template.frontend.js')


@yield('content')
@include('template.frontend.footer')
<div class="py-40"></div>
@livewireScripts
</body>
</html>