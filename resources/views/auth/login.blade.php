<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - TicketIn</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-white h-screen overflow-hidden">
    <div class="w-full h-full flex">
        
        <div class="hidden lg:block w-1/2 h-full relative">
            <img src="/img/c4.jpeg" class="w-full h-full object-cover" alt="Concert">
            <div class="absolute inset-0 bg-gradient-to-tr from-black/80 via-[#E73812]/60 to-[#E08B36]/40 mix-blend-multiply"></div>
            <div class="absolute bottom-0 left-0 p-16 text-white">
                <h2 class="text-5xl font-extrabold mb-4 leading-tight">Feel the <br><span class="text-[#F5CB49]">Energy.</span></h2>
                <p class="text-[#B8948C] text-lg opacity-90 bg-black/30 p-2 rounded inline-block">Platform tiket event terpercaya Anda.</p>
            </div>
        </div>

        <div class="w-full lg:w-1/2 h-full flex items-center justify-center bg-white px-8">
            <div class="w-full max-w-md">
                <a href="/" class="inline-block mb-10">
                    <span class="text-5xl font-extrabold tracking-tighter">
                        <span class="text-[#E73812]">Ticket</span><span class="text-black">In</span><span class="text-black">.</span>
                    </span>
                </a>

                <div class="mb-10">
                    <h1 class="text-3xl font-bold text-black mb-2">Welcome Back!</h1>
                    <p class="text-[#B8948C]">Silakan login untuk melanjutkan akses.</p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-[#E73812] p-4 rounded-r-xl shadow-sm animate-pulse">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-[#E73812]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-bold text-red-800">Login Gagal</h3>
                                <div class="mt-1 text-xs text-red-700">
                                    <p>Akun tidak ditemukan atau password salah.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-bold text-black mb-2">Email Address</label>
                        <input type="email" name="email" required autofocus class="w-full px-5 py-3 rounded-xl bg-gray-50 border border-[#B8948C]/30 text-black focus:outline-none focus:ring-2 focus:ring-[#E73812] focus:bg-white transition" placeholder="nama@email.com">
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label class="block text-sm font-bold text-black">Password</label>
                            <a href="{{ route('password.request') }}" class="text-sm text-[#E73812] font-bold hover:underline">Lupa Password?</a>
                        </div>
                        <input type="password" name="password" required class="w-full px-5 py-3 rounded-xl bg-gray-50 border border-[#B8948C]/30 text-black focus:outline-none focus:ring-2 focus:ring-[#E73812] focus:bg-white transition" placeholder="••••••••">
                    </div>

                    <button type="submit" class="w-full py-3.5 rounded-xl bg-black text-white font-bold text-lg hover:bg-[#E73812] hover:shadow-lg hover:shadow-orange-200 transition duration-300 transform hover:-translate-y-0.5 border border-transparent">
                        Sign In
                    </button>
                </form>

                <p class="mt-8 text-center text-[#B8948C]">
                    Belum punya akun? <a href="{{ route('register') }}" class="text-[#E73812] font-bold hover:underline">Daftar Sekarang</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>