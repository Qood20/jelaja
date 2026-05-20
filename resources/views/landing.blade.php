<x-layouts.app title="Jelaja - Marketplace Tiket Wisata Indonesia">
    <!-- Hero Section -->
    <section class="relative overflow-hidden rounded-[2.5rem] bg-gradient-to-br from-blue-700 via-blue-600 to-cyan-500 text-white shadow-xl">
        <!-- Abstract patterns -->
        <div class="absolute -right-20 -top-20 h-80 w-80 rounded-full bg-white/10 blur-3xl"></div>
        <div class="absolute -bottom-20 -left-20 h-80 w-80 rounded-full bg-white/10 blur-3xl"></div>

        <div class="relative z-10 grid grid-cols-1 items-center gap-12 px-6 py-12 md:grid-cols-2 md:px-12 md:py-20">
            <div class="space-y-6">
                <span class="inline-flex items-center gap-1.5 rounded-full bg-white/20 px-3.5 py-1 text-xs font-bold uppercase tracking-wider text-blue-50">
                    ✨ Marketplace Tiket Wisata Terpercaya
                </span>
                <h1 class="text-3xl font-extrabold leading-tight tracking-tight md:text-5xl">
                    Jelajahi Keindahan Nusantara dalam Satu Genggaman
                </h1>
                <p class="text-sm text-blue-50/90 md:text-base/relaxed max-w-lg">
                    Pesan tiket wisata favoritmu secara instan, dapatkan QR code digital, dan masuk ke lokasi tanpa perlu mengantre. Liburan jadi lebih maksimal, praktis, dan menyenangkan!
                </p>
                <div class="flex flex-wrap gap-4 pt-2">
                    <a href="{{ route('destinations.index') }}" class="inline-flex items-center gap-2 rounded-2xl bg-white px-6 py-3.5 text-sm font-black text-blue-700 shadow-md hover:bg-blue-50 transition active:scale-98">
                        Mulai Jelajah
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="h-4 w-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                    @guest
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 rounded-2xl border border-white/40 bg-white/10 px-6 py-3.5 text-sm font-bold backdrop-blur-sm hover:bg-white/20 transition">
                            Daftar Akun
                        </a>
                    @endguest
                </div>
            </div>
            
            <div class="relative hidden justify-center md:flex">
                <!-- Stacked Premium Visuals -->
                <div class="relative max-w-sm overflow-hidden rounded-[2rem] bg-white/10 p-4 shadow-2xl ring-1 ring-white/20 backdrop-blur-md">
                    <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=600&auto=format&fit=crop" alt="Hero Travel" class="rounded-2xl object-cover h-64 w-80">
                    <div class="absolute bottom-6 left-6 right-6 rounded-2xl bg-white/95 backdrop-blur-sm p-4 text-slate-900 shadow-lg">
                        <span class="inline-flex rounded-full bg-blue-50 px-2.5 py-0.5 text-[10px] font-black uppercase text-blue-700">Rekomendasi</span>
                        <h3 class="mt-1 font-extrabold text-sm truncate">Wisata Alam Indonesia</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Dapatkan tiket masuk resminya sekarang juga.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us / Features -->
    <section class="mt-16">
        <div class="text-center max-w-2xl mx-auto space-y-2">
            <span class="text-xs font-black uppercase tracking-wider text-blue-600">Keunggulan Jelaja</span>
            <h2 class="text-2xl font-extrabold tracking-tight text-slate-900 md:text-3xl">Mengapa Memilih Platform Kami?</h2>
            <p class="text-sm text-slate-500 leading-relaxed">Kami hadir untuk memberikan pengalaman liburan terbaik dengan teknologi pemesanan tiket termutakhir.</p>
        </div>

        <div class="mt-10 grid grid-cols-1 gap-6 md:grid-cols-3">
            <!-- Feature 1 -->
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm ring-1 ring-slate-100/50">
                <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-600 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
                    </svg>
                </span>
                <h3 class="font-extrabold text-slate-900 text-lg">Pemesanan Instan ⚡</h3>
                <p class="mt-2 text-sm text-slate-500 leading-relaxed">Tiket digital langsung terbit dan dikirim seketika sesaat setelah pembayaran Anda dikonfirmasi oleh sistem kami.</p>
            </div>

            <!-- Feature 2 -->
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm ring-1 ring-slate-100/50">
                <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 13.5V18m0 0v1.5m0-1.5h1.5m-1.5 0h-1.5" />
                    </svg>
                </span>
                <h3 class="font-extrabold text-slate-900 text-lg">Gate QR Code Masuk 🎫</h3>
                <p class="mt-2 text-sm text-slate-500 leading-relaxed">Cukup tunjukkan QR Code tiket digital Anda kepada petugas di lokasi gerbang masuk untuk di-scan secara cepat tanpa antre loket.</p>
            </div>

            <!-- Feature 3 -->
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm ring-1 ring-slate-100/50">
                <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-purple-50 text-purple-600 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                    </svg>
                </span>
                <h3 class="font-extrabold text-slate-900 text-lg">Pembayaran Otomatis & Aman 🛡️</h3>
                <p class="mt-2 text-sm text-slate-500 leading-relaxed">Terintegrasi secara resmi dengan payment gateway Midtrans yang mendukung transfer bank, e-wallet, dan QRIS.</p>
            </div>
        </div>
    </section>

    <!-- Featured Destination Showcase -->
    <section class="mt-16">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <span class="text-xs font-black uppercase tracking-wider text-blue-600">Unggulan</span>
                <h2 class="text-2xl font-extrabold tracking-tight text-slate-900 md:text-3xl">Destinasi Terpopuler Minggu Ini</h2>
            </div>
            <a href="{{ route('destinations.index') }}" class="text-xs font-bold text-blue-600 hover:text-blue-800 transition">Lihat Semua Destinasi →</a>
        </div>

        @forelse ($destinations->take(3) as $destination)
            <article class="mt-6 group overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm transition hover:shadow-md">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="relative overflow-hidden h-64 md:h-full min-h-[280px]">
                        <img src="{{ $destination->image_url ?: 'https://images.unsplash.com/photo-1469474968028-56623f02e42e?q=80&w=1400&auto=format&fit=crop' }}" alt="{{ $destination->name }}" class="absolute inset-0 h-full w-full object-cover group-hover:scale-102 transition-transform duration-500">
                    </div>
                    <div class="p-6 md:p-10 flex flex-col justify-center">
                        <h3 class="text-2xl font-black tracking-tight text-slate-900 group-hover:text-blue-600 transition-colors">{{ $destination->name }}</h3>
                        <p class="mt-3 text-sm leading-relaxed text-slate-500 line-clamp-3">{{ $destination->description }}</p>
                        
                        <div class="mt-6 grid grid-cols-2 gap-4 border-y border-slate-100 py-4 text-sm text-slate-700">
                            <div>
                                <span class="block text-[10px] font-bold text-slate-400 uppercase">Jam Buka</span>
                                <span class="font-bold text-slate-800">{{ $destination->opening_hours }}</span>
                            </div>
                            <div>
                                <span class="block text-[10px] font-bold text-slate-400 uppercase">Harga Tiket</span>
                                <span class="font-extrabold text-blue-700">Rp{{ number_format($destination->price, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="mt-6">
                            <a href="{{ route('destinations.show', $destination) }}" class="inline-flex items-center gap-2 rounded-2xl bg-slate-900 px-6 py-3 text-sm font-bold text-white shadow-sm hover:bg-blue-700 transition">
                                Pesan Tiket Detail
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-4 w-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </article>
        @empty
            <div class="mt-6 rounded-3xl border-2 border-dashed border-slate-200 bg-white p-12 text-center">
                <p class="text-sm text-slate-500">Belum ada destinasi unggulan tersedia.</p>
            </div>
        @endforelse
    </section>

    <!-- Contacts / FAQ Section -->
    <section id="kontak" class="mt-16 rounded-[2rem] bg-slate-100 p-6 md:p-12">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
            <div class="space-y-4">
                <span class="text-xs font-black uppercase tracking-wider text-blue-600">Hubungi Kami</span>
                <h2 class="text-2xl font-extrabold tracking-tight text-slate-900">Butuh Bantuan Perjalanan?</h2>
                <p class="text-sm text-slate-500 leading-relaxed max-w-sm">Tim dukungan pelanggan Jelaja siap melayani Anda 24/7 untuk memastikan liburan Anda berjalan lancar tanpa kendala.</p>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-200">
                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600 mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                        </svg>
                    </span>
                    <h3 class="font-extrabold text-slate-900 text-sm">Dukungan Email</h3>
                    <p class="mt-1 text-xs text-slate-500 font-medium">support@jelaja.com</p>
                </div>

                <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-200">
                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-pink-50 text-pink-600 mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                        </svg>
                    </span>
                    <h3 class="font-extrabold text-slate-900 text-sm">Media Sosial</h3>
                    <p class="mt-1 text-xs text-slate-500 font-medium">@jelaja_travel</p>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
