<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'TicketIn') }}</title>
        <!-- Alpine.js -->
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            body { font-family: 'Poppins', sans-serif; }
        </style>
    </head>
    <body class="bg-[#FAFAFA] text-black antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4 relative overflow-hidden">
            
            <!-- Dekorasi Background Abstrak -->
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-[#E73812]/5 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute top-1/2 -right-24 w-64 h-64 bg-[#F5CB49]/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute bottom-0 left-1/2 w-80 h-80 bg-[#B8948C]/10 rounded-full blur-3xl pointer-events-none"></div>

            <!-- Logo -->
            <div class="mb-8 text-center relative z-10">
                <a href="/" class="text-5xl font-extrabold tracking-tighter transition hover:scale-105 inline-block">
                    <span class="text-[#E73812]">Ticket</span><span class="text-black">In</span><span class="text-black">.</span>
                </a>
            </div>

            <!-- Card Container -->
            <div class="w-full sm:max-w-md px-8 py-10 bg-white shadow-2xl shadow-[#B8948C]/10 overflow-hidden sm:rounded-3xl border border-[#B8948C]/20 relative z-10">
                {{ $slot }}
            </div>
            
            <!-- Footer Kecil -->
            <div class="mt-8 text-center text-xs text-[#B8948C] relative z-10">
                &copy; {{ date('Y') }} TicketIn. All rights reserved.
            </div>
        </div>
    </body>
</html>