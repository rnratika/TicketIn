<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lupa Password - TicketIn</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-[#FAFAFA] text-black antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4 relative overflow-hidden">
        
        <!-- Dekorasi Background -->
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-[#E73812]/5 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 -right-24 w-64 h-64 bg-[#F5CB49]/10 rounded-full blur-3xl"></div>

        <!-- Logo -->
        <div class="mb-8 text-center relative z-10">
            <a href="/" class="text-5xl font-extrabold tracking-tighter">
                <span class="text-[#E73812]">Ticket</span><span class="text-black">In</span><span class="text-black">.</span>
            </a>
        </div>

        <!-- Card Container -->
        <div class="w-full sm:max-w-md px-8 py-10 bg-white shadow-2xl shadow-[#B8948C]/10 overflow-hidden sm:rounded-3xl border border-[#B8948C]/20 relative z-10">
            
            <div class="mb-8 text-center">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-[#fff5f2] mb-4 text-[#E73812]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                </div>
                <h2 class="text-2xl font-bold text-black">Lupa Password?</h2>
                <p class="mt-3 text-sm text-[#B8948C] leading-relaxed">
                    Jangan khawatir. Masukkan email Anda dan kami akan mengirimkan link untuk mereset password.
                </p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-6 font-medium text-sm text-green-700 bg-green-50 p-4 rounded-xl border border-green-200 text-center shadow-sm">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-bold text-black mb-2">Email Address</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                        class="appearance-none block w-full px-5 py-3 border border-[#B8948C]/30 rounded-xl shadow-sm placeholder-[#B8948C]/50 focus:outline-none focus:ring-2 focus:ring-[#E73812] focus:border-transparent transition bg-[#FAFAFA] focus:bg-white"
                        placeholder="nama@email.com">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg shadow-orange-100 text-sm font-bold text-white bg-black hover:bg-[#E73812] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#E73812] transition duration-300 transform hover:-translate-y-0.5">
                        Kirim Link Reset
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center border-t border-[#B8948C]/20 pt-6">
                <a href="{{ route('login') }}" class="text-sm font-bold text-[#B8948C] hover:text-black flex items-center justify-center transition group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 group-hover:-translate-x-1 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Login
                </a>
            </div>
        </div>
    </div>
</body>
</html>