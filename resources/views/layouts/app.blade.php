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
         <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <style>
        /* Animasi fade-up */
        .fade-up {
        opacity: 0;
        transform: translateY(20px);
        animation: fadeUp 0.8s ease-out forwards;
        }

        @keyframes fadeUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
        }

        /* Animasi fade-down */
        .fade-down {
        opacity: 0;
        transform: translateY(-20px);
        animation: fadeDown 0.8s ease-out forwards;
        }

        @keyframes fadeDown {
        to {
            opacity: 1;
            transform: translateY(0);
        }
        }

        /* Animasi fade-left */
        .fade-left {
        opacity: 0;
        transform: translateX(20px);
        animation: fadeLeft 0.8s ease-out forwards;
        }

        @keyframes fadeLeft {
        to {
            opacity: 1;
            transform: translateX(0);
        }
        }
    </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <livewire:layout.navigation />

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</html>
