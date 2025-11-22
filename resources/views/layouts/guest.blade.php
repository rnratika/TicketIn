<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'TicketIn') }}</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body { font-family: 'Poppins', sans-serif; }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-50">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-50 relative overflow-hidden">
            
            <div class="absolute top-0 left-0 w-full h-64 bg-indigo-900 transform -skew-y-3 origin-top-left -z-10"></div>
            
            <div class="mb-6">
                <a href="/" class="text-4xl font-bold text-white tracking-tighter drop-shadow-md">
                    TicketIn<span class="text-indigo-300">.</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-8 py-10 bg-white shadow-xl overflow-hidden sm:rounded-2xl border border-gray-100 relative z-10">
                {{ $slot }}
            </div>

            <div class="mt-8 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} TicketIn. All rights reserved.
            </div>
        </div>
    </body>
</html>