<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Konfirmasi Password - TicketIn</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-[#FAFAFA] text-black antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4 relative">
        
        <!-- Dekorasi Sudut -->
        <div class="absolute top-0 left-0 w-40 h-40 bg-gradient-to-br from-[#E73812]/10 to-transparent"></div>
        <div class="absolute bottom-0 right-0 w-40 h-40 bg-gradient-to-tl from-[#F5CB49]/10 to-transparent"></div>

        <div class="mb-8 text-center relative z-10">
            <a href="/" class="text-5xl font-extrabold tracking-tighter">
                <span class="text-[#E73812]">Ticket</span><span class="text-black">In</span><span class="text-black">.</span>
            </a>
        </div>

        <div class="w-full sm:max-w-md px-8 py-10 bg-white shadow-2xl shadow-[#B8948C]/10 overflow-hidden sm:rounded-3xl border border-[#B8948C]/20 relative z-10">
            
            <div class="mb-8 text-center">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-black text-white mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <h2 class="text-xl font-bold text-black">Konfirmasi Akses</h2>
                <p class="mt-2 text-sm text-[#B8948C]">
                    Ini adalah area aman. Mohon konfirmasi password Anda sebelum melanjutkan.
                </p>
            </div>

            <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="password" class="block text-sm font-bold text-black mb-2">Password</label>
                    <input id="password" name="password" type="password" required autocomplete="current-password"
                        class="appearance-none block w-full px-5 py-3 border border-[#B8948C]/30 rounded-xl shadow-sm placeholder-[#B8948C]/50 focus:outline-none focus:ring-2 focus:ring-[#E73812] focus:border-transparent transition bg-[#FAFAFA] focus:bg-white"
                        placeholder="Masukkan password anda">
                    @error('password')
                        <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg shadow-orange-100 text-sm font-bold text-white bg-black hover:bg-[#E73812] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#E73812] transition duration-300 transform hover:-translate-y-0.5">
                        Konfirmasi
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>