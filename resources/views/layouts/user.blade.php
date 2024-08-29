<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.sidebarUser')

        <!-- Page Heading -->
        @isset($header)
            <header class="px-2 bg-white shadow dark:bg-gray-800 sm:px-6 md:px-4 lg:ps-72">
                <div class="px-2 py-6 mx-auto max-w-7xl sm:px-8 lg:px-4">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{-- alert --}}
            @if (session('success'))
                <div class="p-4 mt-2 text-sm text-center text-white bg-teal-500 rounded-lg" role="alert"
                    tabindex="-1" aria-labelledby="hs-solid-color-success-label">
                    <span id="hs-solid-color-success-label" class="font-bold">Success</span> {{ session('success') }}
                </div>
            @endif
            {{-- end alert --}}
            {{ $slot }}
        </main>
    </div>
</body>

</html>
