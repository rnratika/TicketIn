<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - TicketIn</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-white">

    <div class="min-h-screen flex">
        
        <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24 bg-white">
            <div class="mx-auto w-full max-w-md lg:w-[450px]">

                <div class="-mt-4 mb-4">
                    <a href="/" class="text-5xl font-bold text-indigo-600 tracking-tighter">
                        TicketIn<span class="text-gray-800">.</span>
                    </a>
                </div>

                <div class="mb-8">
                    <h2 class="mt-1 text-2xl font-bold text-gray-900">Selamat Datang Kembali</h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Masuk untuk mengelola tiket Anda.
                    </p>
                </div>

                <div class="mt-8">
                    <form method="POST" action="{{ route('login') }}" class="space-y-5">
                        @csrf

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                            <div class="mt-1">
                                <input id="email" name="email" type="email" required autofocus
                                    class="appearance-none block w-full px-6 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-200"
                                    placeholder="nama@email.com">
                            </div>
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <div class="mt-1">
                                <input id="password" name="password" type="password" required autocomplete="current-password"
                                    class="appearance-none block w-full px-6 py-3 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm transition duration-200"
                                    placeholder="••••••••">
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <label for="remember_me" class="ml-2 block text-sm text-gray-900">Ingat Saya</label>
                            </div>

                            @if (Route::has('password.request'))
                                <div class="text-sm">
                                    <a href="{{ route('password.request') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                                        Lupa password?
                                    </a>
                                </div>
                            @endif
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 transform hover:scale-[1.02]">
                                Masuk Sekarang
                            </button>
                        </div>
                    </form>
                    
                    <div class="mt-3 text-center">
                        <p class="text-sm text-gray-600">
                            Belum punya akun? 
                            <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                                Daftar disini
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="aspect-square hidden lg:flex w-1/2 h-full relative ml-auto">
            <img src="{{'img/concert.jpeg'}}" 
                 alt="Concert Crowd" 
                 class="h-full w-full object-cover object-center"/>
            
            <div class="absolute inset-0 bg-purple-900 opacity-40 mix-blend-multiply"></div>
            
            <div class="absolute inset-0 flex flex-col justify-end p-12 text-white z-10">
                <h2 class="text-4xl font-bold mb-4">Rasakan Momennya.</h2>
                <p class="text-lg text-purple-100">Bergabunglah dengan ribuan orang lainnya untuk menemukan event terbaik di kotamu.</p>
            </div>
        </div>

    </div>
</body>
</html>