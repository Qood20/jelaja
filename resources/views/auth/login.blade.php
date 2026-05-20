<x-layouts.app title="Masuk Akun - Jelaja">
    <div class="mx-auto max-w-md rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
        <div class="text-center">
            <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-600 mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
            </span>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">Selamat Datang Kembali</h1>
            <p class="mt-1.5 text-sm text-slate-500">Masuk untuk melanjutkan petualangan serumu.</p>
        </div>

        <form action="{{ route('login.attempt') }}" method="POST" class="mt-6 space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Alamat Email</label>
                <input type="email" name="email" placeholder="Contoh: user@email.com" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500" required>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Password</label>
                <input type="password" name="password" placeholder="Masukkan password Anda" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500" required>
            </div>

            <button class="w-full rounded-2xl bg-blue-700 py-3 font-bold text-white shadow-sm hover:bg-blue-800 transition">Masuk Sekarang</button>
        </form>

        <div class="mt-6 text-center text-sm text-slate-500">
            Belum punya akun? <a href="{{ route('register') }}" class="font-bold text-blue-700 hover:text-blue-800 transition">Register di sini</a>
        </div>
    </div>
</x-layouts.app>
