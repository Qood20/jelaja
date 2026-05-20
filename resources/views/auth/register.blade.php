<x-layouts.app title="Daftar Akun - Jelaja">
    <div class="mx-auto max-w-md rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
        <div class="text-center">
            <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-600 mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                </svg>
            </span>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">Daftar Akun Jelaja</h1>
            <p class="mt-1.5 text-sm text-slate-500">Mulai perjalanan liburan serumu bersama kami.</p>
        </div>

        <form action="{{ route('register.store') }}" method="POST" class="mt-6 space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Nama Lengkap</label>
                <input type="text" name="name" placeholder="Contoh: John Doe" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500" required>
            </div>
            
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Alamat Email</label>
                <input type="email" name="email" placeholder="Contoh: user@email.com" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500" required>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Nomor Handphone</label>
                <input type="tel" name="phone" placeholder="Contoh: 08123456789" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500" required>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Daftar Sebagai</label>
                <select name="role" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500" required>
                    <option value="buyer">Pembeli (User)</option>
                    <option value="operator">Operator Wisata</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Password</label>
                <input type="password" name="password" placeholder="Minimal 8 karakter" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500" required>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" placeholder="Ulangi password Anda" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-2.5 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500" required>
            </div>

            <button class="w-full rounded-2xl bg-blue-700 py-3 font-bold text-white shadow-sm hover:bg-blue-800 transition">Daftar Sekarang</button>
        </form>

        <div class="mt-6 text-center text-sm text-slate-500">
            Sudah punya akun? <a href="{{ route('login') }}" class="font-bold text-blue-700 hover:text-blue-800 transition">Login di sini</a>
        </div>
    </div>
</x-layouts.app>
