<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verifikasi Email - TicketIn</title>
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
                <h2 class="text-xl font-bold text-gray-800">Verifikasi Email</h2>
                <div class="mt-4 text-sm text-gray-500 space-y-2">
                    <p>Terima kasih telah mendaftar! Mohon verifikasi alamat email Anda dengan mengklik link yang kami kirimkan.</p>
                    <p>Jika Anda tidak menerimanya, kami dapat mengirim ulang.</p>
                </div>
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-6 font-medium text-sm text-green-700 bg-green-50 p-4 rounded-lg border border-green-200 text-center">
                    Link verifikasi baru telah dikirim ke email Anda.
                </div>
            @endif

            <div class="mt-6 space-y-4">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300 transform hover:scale-[1.02]">
                        Kirim Ulang Email Verifikasi
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-600 bg-white hover:bg-gray-50 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>