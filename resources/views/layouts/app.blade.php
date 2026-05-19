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
        /* Spinner overlay */
        #spinner-overlay {
            position: fixed;
            inset: 0;
            background: rgba(255, 255, 255, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .spinner {
            border: 6px solid #f3f3f3;
            border-top: 6px solid #f97316; /* orange */
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Fade-out animasi */
        .fade-out {
            animation: fadeOut 0.5s ease forwards;
        }
        @keyframes fadeOut {
            to { opacity: 0; visibility: hidden; }
        }
    </style>
</head>
<body class="font-sans antialiased">
    <!-- Spinner -->
    <div id="spinner-overlay">
        <div class="spinner"></div>
    </div>

    <div class="min-h-screen bg-gray-100">
        <livewire:layout.navigation />

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        function hideSpinner() {
            const spinner = document.getElementById('spinner-overlay');
            if (spinner && !spinner.classList.contains('fade-out')) {
                spinner.classList.add('fade-out');
                setTimeout(() => spinner.style.display = 'none', 500); // hilang setelah animasi
            }
        }

        window.addEventListener('load', hideSpinner);

        setTimeout(hideSpinner, 500);
    </script>
    
</body>
</html>
