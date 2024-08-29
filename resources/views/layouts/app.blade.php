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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#currency').mask('#.##0', {
                reverse: true
            });
        })
    </script>

    <script src="https://cdn.tiny.cloud/1/wnagm4p648v260nuc4f5cdbr3imw163kkcgvlpv4ls0mqnix/tinymce/7/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#description', // Replace this CSS selector to match the placeholder element for TinyMCE
            plugins: 'code table lists',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
        });
    </script>

</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.sidebar')

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
    @stack('scriptjs')
</body>

</html>
