<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lupa Password - TicketIn</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-gray-50 text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4">
        
        <div class="mb-6 text-center">
            <a href="/" class="text-4xl font-bold text-indigo-600 tracking-tighter">
                TicketIn<span class="text-gray-800">.</span>
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-2 px-8 py-10 bg-white shadow-lg shadow-gray-200 overflow-hidden sm:rounded-xl border border-gray-100">
            
            <div class="mb-6 text-center">
                <h2 class="text-xl font-bold text-gray-800">Lupa Password?</h2>
                <p class="mt-2 text-sm text-gray-500 leading-relaxed">
                    Masukkan email Anda dan kami akan mengirimkan link untuk mereset password.
                </p>
            </div>

            @if (session('status'))
                <div class="mb-6 font-medium text-sm text-green-600 bg-green-50 p-4 rounded-lg border border-green-100 text-center">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                        class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-200"
                        placeholder="nama@email.com">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 transform hover:scale-[1.02]">
                        Kirim Link Reset
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center border-t border-gray-100 pt-6">
                <a href="{{ route('login') }}" class="text-sm font-medium text-gray-500 hover:text-indigo-600 flex items-center justify-center transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Login
                </a>
            </div>
        </div>
    </div>
</body>
</html>