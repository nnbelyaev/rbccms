<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manage Area</title>
    <script src="{{ asset('js/manage.js') }}" defer></script>
    <link href="{{ mix('/css/manage.css') }}" rel="stylesheet">
</head>
<body>
    <div id="manage">
        <div class="container">
            @include('manage._shared.navigation')
            @yield('content')
        </div>
    </div>
</body>
</html>
