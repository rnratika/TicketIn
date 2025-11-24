<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar - TicketIn</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-white h-screen overflow-hidden">
    <div class="w-full h-full flex">
        
        <!-- KIRI: Form -->
        <div class="w-full lg:w-1/2 h-full flex items-center justify-center bg-white px-8 overflow-y-auto">
            <div class="w-full max-w-md py-10">
                <a href="/" class="inline-block mb-4">
                    <span class="text-5xl font-extrabold tracking-tighter">
                        <span class="text-[#E73812]">Ticket</span><span class="text-black">In</span><span class="text-black">.</span>
                    </span>
                </a>

                <!-- Bagian Header Teks Dihapus Sesuai Permintaan -->

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf
                    
                    <!-- Nama -->
                    <div>
                        <label for="name" class="block text-sm font-bold text-black mb-2">Nama Lengkap</label>
                        <input id="name" name="name" type="text" required autofocus class="w-full px-5 py-3 rounded-xl bg-gray-50 border border-[#B8948C]/30 text-black focus:outline-none focus:ring-2 focus:ring-[#E73812] focus:bg-white transition" placeholder="Nama Anda">
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-bold text-black mb-2">Email Address</label>
                        <input id="email" name="email" type="email" required class="w-full px-5 py-3 rounded-xl bg-gray-50 border border-[#B8948C]/30 text-black focus:outline-none focus:ring-2 focus:ring-[#E73812] focus:bg-white transition" placeholder="nama@email.com">
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-bold text-black mb-2">Password</label>
                        <input id="password" name="password" type="password" required autocomplete="new-password" class="w-full px-5 py-3 rounded-xl bg-gray-50 border border-[#B8948C]/30 text-black focus:outline-none focus:ring-2 focus:ring-[#E73812] focus:bg-white transition" placeholder="••••••••">
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-bold text-black mb-2">Konfirmasi Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required class="w-full px-5 py-3 rounded-xl bg-gray-50 border border-[#B8948C]/30 text-black focus:outline-none focus:ring-2 focus:ring-[#E73812] focus:bg-white transition" placeholder="••••••••">
                    </div>

                    <button type="submit" class="w-full py-3.5 rounded-xl bg-black text-white font-bold text-lg hover:bg-[#E73812] hover:shadow-lg hover:shadow-orange-200 transition duration-300 transform hover:-translate-y-0.5 mt-4">
                        Daftar Sekarang
                    </button>
                </form>

                <p class="mt-8 text-center text-[#B8948C]">
                    Sudah punya akun? <a href="{{ route('login') }}" class="text-[#E73812] font-bold hover:underline">Login disini</a>
                </p>
            </div>
        </div>

        <!-- KANAN: Image Visual -->
        <div class="hidden lg:block w-1/2 h-full relative">
            <img src="/img/c6.jpeg" class="w-full h-full object-cover" alt="Festival Crowd">
            <div class="absolute inset-0 bg-gradient-to-bl from-black/90 via-[#E73812]/50 to-[#F5CB49]/30 mix-blend-multiply"></div>
            <div class="absolute bottom-0 right-0 p-16 text-white text-right">
                <h2 class="text-5xl font-extrabold mb-4 leading-tight">Join the <br><span class="text-[#F5CB49]">Euphoria.</span></h2>
                <p class="text-[#B8948C] text-lg opacity-90 bg-black/30 p-2 rounded inline-block">Jangan lewatkan momen terbaik hidupmu.</p>
            </div>
        </div>

    </div>
</body>
</html>