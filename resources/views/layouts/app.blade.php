<!DOCTYPE html>
<html lang="cs">
<head>
 <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --main-color: {{ request()->getHost() === 'www.test.karstejn.cz' ? '#607D8B' : 'rgba(0, 0, 0, 0.9)' }};
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="images/icon.ico" >
    <title>@yield('title', 'Default Title')</title>
</head>
<body>

    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')
    @include('partials.scripts')
</body>
</html>