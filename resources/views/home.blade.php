<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
</head>
<body>
    @include('components.nav')
    <!-- Main banner -->
    @include('components.mainpic')
    @include('components.category')
    <!-- Main Container -->
    @include('components.product')
    @include('components.footer')
    
</body>
</html>
