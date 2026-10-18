<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('storage/images/home/formine-3.svg') }}"> {{-- favicon --}}

    <title>@yield('title')</title>

    @stack('meta') <!-- Menampilkan meta tag dari view child -->

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
    <x-navbar />

    <main>
        @yield('content')
    </main>

    <x-footer/>
    {{-- <x-footers.content /> --}}
    {{-- <x-footers.bottom /> --}}
</body>

</html>
