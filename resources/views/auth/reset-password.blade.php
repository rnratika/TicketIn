<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password - TicketIn</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-[#FAFAFA] text-black antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4 relative overflow-hidden">

        <div class="absolute top-0 right-0 w-full h-1 bg-gradient-to-r from-[#E73812] via-[#E08B36] to-[#F5CB49]"></div>

        <div class="mb-8 text-center">
            <a href="/" class="text-5xl font-extrabold tracking-tighter">
                <span class="text-[#E73812]">Ticket</span><span class="text-black">In</span><span class="text-black">.</span>
            </a>
        </div>

        <div class="w-full sm:max-w-md px-8 py-10 bg-white shadow-2xl shadow-[#B8948C]/10 overflow-hidden sm:rounded-3xl border border-[#B8948C]/20">
            
            <div class="mb-8 text-center">
                <h2 class="text-2xl font-bold text-black">Buat Password Baru</h2>
                <p class="mt-2 text-sm text-[#B8948C]">Silakan atur ulang kata sandi Anda untuk keamanan.</p>
            </div>

            <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <div>
                    <label for="email" class="block text-sm font-bold text-black mb-2">Email Address</label>
                    <input id="email" name="email" type="email" value="{{ old('email', $request->email) }}" required autofocus
                        class="appearance-none block w-full px-5 py-3 border border-[#B8948C]/30 rounded-xl shadow-sm placeholder-[#B8948C]/50 focus:outline-none focus:ring-2 focus:ring-[#E73812] focus:border-transparent transition bg-[#FAFAFA] focus:bg-white"
                        placeholder="nama@email.com">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-bold text-black mb-2">Password Baru</label>
                    <input id="password" name="password" type="password" required autocomplete="new-password"
                        class="appearance-none block w-full px-5 py-3 border border-[#B8948C]/30 rounded-xl shadow-sm placeholder-[#B8948C]/50 focus:outline-none focus:ring-2 focus:ring-[#E73812] focus:border-transparent transition bg-[#FAFAFA] focus:bg-white"
                        placeholder="••••••••">
                    @error('password')
                        <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-bold text-black mb-2">Konfirmasi Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                        class="appearance-none block w-full px-5 py-3 border border-[#B8948C]/30 rounded-xl shadow-sm placeholder-[#B8948C]/50 focus:outline-none focus:ring-2 focus:ring-[#E73812] focus:border-transparent transition bg-[#FAFAFA] focus:bg-white"
                        placeholder="••••••••">
                    @error('password_confirmation')
                        <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg shadow-orange-100 text-sm font-bold text-white bg-black hover:bg-[#E73812] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#E73812] transition duration-300 transform hover:-translate-y-0.5">
                        Reset Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>