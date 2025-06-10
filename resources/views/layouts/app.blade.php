<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Registration App' }}</title>
    <link rel="stylesheet" href="{{ asset('assests/css/register.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    @include('layouts.header')
    <div class="main-container">
        @yield('content')
    </div>
    <script src="{{ asset('assests/js/client_v.js') }}" type="module"></script>
    <script src="{{ asset('assests/js/server_v.js') }}" type="module"></script>
    <script src="{{ asset('assests/js/all_v.js') }}" type="module"></script>
    <script src="{{ asset('assests/js/whatsapp_Validation.js') }}"></script>
    @include('layouts.footer')
</body>
</html>