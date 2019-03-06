<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('shared.meta')
    <link href="{{ mix('/css/front.css') }}" rel="stylesheet">
</head>
<body class="{{ isset($bodyClass) ? $bodyClass : '' }}">
@include('shared.header')
<div id="app" class="container">
    <div class="columns">
        <div class="column is-one-quarter">@yield('leftsidebar')</div>
        <div class="column is-rest">
            @yield('content')
        </div>
        <div class="column is-300px is-paddingless">@yield('rightsidebar')</div>
    </div>
</div>
<script>
    window.default_locale = "{{ config('app.locale') }}";
    window.fallback_locale = "{{ config('app.fallback_locale') }}";
</script>
</body>
</html>