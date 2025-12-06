<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'SIDeKa - Desa Cicangkang Hilir')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            primary: '#1e40af',
                            secondary: '#3b82f6',
                            accent: '#10b981',
                            dark: '#1f2937',
                            light: '#f8fafc'
                        },
                        fontFamily: {
                            'poppins': ['Poppins', 'sans-serif'],
                        }
                    }
                }
            }
        </script>

        <!-- Custom styles -->
        <style>
            body {
                font-family: 'Poppins', sans-serif;
                background: linear-gradient(135deg, #f8fafc 0%, #e0f2fe 100%);
                min-height: 100vh;
            }
            
            .auth-card {
                animation: slideUp 0.5s ease-out;
            }
            
            @keyframes slideUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        </style>
        
        @stack('styles')
    </head>
    <body class="font-poppins antialiased">
        @yield('content')
        
        @stack('scripts')
    </body>
</html>