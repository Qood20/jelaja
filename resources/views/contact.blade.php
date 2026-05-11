<x-layouts.app title="Kontak - Jelaja">
    <div class="mx-auto max-w-4xl space-y-8">
        <div class="text-center">
            <h1 class="text-3xl font-bold tracking-tight text-slate-900">Hubungi Kami</h1>
            <p class="mt-2 text-lg text-slate-600">Ada pertanyaan? Kami siap membantu!</p>
        </div>

        <div class="grid gap-8 md:grid-cols-2">
            <div class="space-y-6">
                <div>
                    <h2 class="text-xl font-semibold text-slate-900">Informasi Kontak</h2>
                    <div class="mt-4 space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100">
                                <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-slate-900">Email</p>
                                <p class="text-sm text-slate-600">support@jelaja.com</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100">
                                <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-slate-900">Telepon</p>
                                <p class="text-sm text-slate-600">+62 812-3456-7890</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-blue-100">
                                <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-slate-900">Alamat</p>
                                <p class="text-sm text-slate-600">Jl. Wisata Nusantara No. 123<br>Jakarta, Indonesia 12345</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="text-xl font-semibold text-slate-900">Jam Operasional</h2>
                    <div class="mt-4 space-y-2 text-sm text-slate-600">
                        <p>Senin - Jumat: 09:00 - 17:00 WIB</p>
                        <p>Sabtu: 09:00 - 15:00 WIB</p>
                        <p>Minggu: Tutup</p>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl bg-slate-50 p-6">
                <h2 class="text-xl font-semibold text-slate-900">Kirim Pesan</h2>
                <form class="mt-4 space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Nama</label>
                        <input type="text" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Email</label>
                        <input type="email" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Subjek</label>
                        <input type="text" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700">Pesan</label>
                        <textarea rows="4" class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"></textarea>
                    </div>
                    <button type="submit" class="w-full rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">Kirim Pesan</button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>