<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-100">
        @if (Route::has('login'))
            <livewire:welcome.navigation />
        @endif
            <main class="min-h-screen">
                <div class="bg-gradient-to-b from-gray-200 to-orange-50">
                    @include('unlogin.hero')
                </div>
                @include('unlogin.feature')
                @include('unlogin.about')                
            </main>
            @include('unlogin.footer')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000, 
            once: true     
        });
    </script>
    </body>
</html>
