<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verifikasi Email - TicketIn</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-[#FAFAFA] text-black antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4">
        
        <div class="mb-8 text-center">
            <a href="/" class="text-5xl font-extrabold tracking-tighter">
                <span class="text-[#E73812]">Ticket</span><span class="text-black">In</span><span class="text-black">.</span>
            </a>
        </div>

        <div class="w-full sm:max-w-md px-8 py-10 bg-white shadow-2xl shadow-[#B8948C]/10 overflow-hidden sm:rounded-3xl border border-[#B8948C]/20">
            
            <div class="mb-8 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-[#F5CB49]/20 mb-4 text-[#E08B36] animate-bounce">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <h2 class="text-2xl font-bold text-black">Verifikasi Email</h2>
                <div class="mt-4 text-sm text-[#B8948C] space-y-3 leading-relaxed">
                    <p>Terima kasih telah mendaftar! Mohon verifikasi alamat email Anda dengan mengklik link yang kami kirimkan.</p>
                    <p class="font-medium text-black">Jika Anda tidak menerimanya, kami dapat mengirim ulang.</p>
                </div>
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-8 font-medium text-sm text-green-700 bg-green-50 p-4 rounded-xl border border-green-200 text-center">
                    Link verifikasi baru telah dikirim ke email Anda.
                </div>
            @endif

            <div class="mt-6 space-y-4">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg shadow-orange-100 text-sm font-bold text-white bg-[#E73812] hover:bg-black focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#E73812] transition duration-300 transform hover:-translate-y-0.5">
                        Kirim Ulang Email Verifikasi
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex justify-center py-3.5 px-4 border border-[#B8948C]/30 rounded-xl text-sm font-bold text-[#B8948C] bg-white hover:bg-gray-50 hover:text-black focus:outline-none transition duration-300">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>