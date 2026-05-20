<x-layouts.app title="Dashboard Pembeli">
    <!-- Welcome Banner -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-blue-700 via-blue-600 to-cyan-500 p-6 text-white shadow-md md:p-8">
        <div class="relative z-10">
            <span class="inline-flex rounded-full bg-white/20 px-3 py-1 text-xs font-semibold tracking-wide uppercase">Pembeli</span>
            <h1 class="mt-3 text-2xl font-extrabold tracking-tight md:text-3xl">Halo, {{ auth()->user()->name }}! 👋</h1>
            <p class="mt-2 max-w-xl text-sm text-blue-50/90 leading-relaxed">Mau liburan ke mana hari ini? Cari destinasi favoritmu dan pesan tiket dengan mudah tanpa antre.</p>
        </div>
        <!-- Decorative background circles -->
        <div class="absolute -right-10 -top-10 h-40 w-40 rounded-full bg-white/10 blur-xl"></div>
        <div class="absolute -bottom-10 right-20 h-28 w-28 rounded-full bg-white/10 blur-lg"></div>
    </div>

    <!-- Quick Stats / Navigation Links -->
    <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-3">
        <!-- Cari Wisata -->
        <a href="{{ route('destinations.index') }}" class="flex items-center gap-4 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </div>
            <div>
                <p class="font-bold text-slate-900 text-sm">Cari Wisata</p>
                <p class="text-xs text-slate-500">Temukan destinasi indah</p>
            </div>
        </a>

        <!-- Tiket Saya -->
        <a href="{{ route('buyer.tickets.index') }}" class="flex items-center gap-4 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
                </svg>
            </div>
            <div>
                <p class="font-bold text-slate-900 text-sm">Tiket Saya</p>
                <p class="text-xs text-slate-500">Lihat QR & masuk lokasi</p>
            </div>
        </a>

        <!-- Riwayat Pembelian -->
        <a href="{{ route('buyer.transactions.index') }}" class="flex items-center gap-4 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-purple-50 text-purple-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-6 w-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </div>
            <div>
                <p class="font-bold text-slate-900 text-sm">Riwayat Pembelian</p>
                <p class="text-xs text-slate-500">Lihat bukti pembayaran</p>
            </div>
        </a>
    </div>

    <!-- Rekomendasi Wisata -->
    <section class="mt-8">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-bold text-slate-900 tracking-tight">Rekomendasi Wisata</h2>
            <a href="{{ route('destinations.index') }}" class="text-xs font-bold text-blue-600 hover:text-blue-800 transition">Lihat semua →</a>
        </div>
        <div class="mt-4 grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($recommended as $item)
                <a href="{{ route('destinations.show', $item) }}" class="group overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    <div class="relative overflow-hidden">
                        <img src="{{ $item->image_url ?: 'https://images.unsplash.com/photo-1469474968028-56623f02e42e?q=80&w=1200&auto=format&fit=crop' }}" alt="{{ $item->name }}" class="h-44 w-full object-cover group-hover:scale-102 transition-transform duration-300">
                        <div class="absolute right-3 top-3 rounded-xl bg-white/95 backdrop-blur-sm px-2.5 py-1 text-xs font-black text-blue-700 shadow-sm">
                            Rp{{ number_format($item->price, 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-slate-900 group-hover:text-blue-600 transition-colors truncate">{{ $item->name }}</h3>
                        <p class="mt-1 text-xs text-slate-500 flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-3.5 w-3.5 text-slate-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            {{ $item->opening_hours }}
                        </p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <!-- Tiket Aktif Saya -->
    <section class="mt-8">
        <h2 class="text-lg font-bold text-slate-900 tracking-tight">Tiket Aktif Saya</h2>
        @if ($tickets->isNotEmpty())
            <div class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-2">
                @foreach ($tickets as $ticket)
                    <div class="relative overflow-hidden rounded-3xl border border-slate-200 bg-white p-5 shadow-sm transition hover:shadow-md">
                        <!-- Decorative ticket punch hole effects -->
                        <div class="absolute -left-3.5 top-1/2 h-7 w-7 -translate-y-1/2 rounded-full border border-slate-200 bg-slate-50"></div>
                        <div class="absolute -right-3.5 top-1/2 h-7 w-7 -translate-y-1/2 rounded-full border border-slate-200 bg-slate-50"></div>

                        <div class="flex items-center justify-between pl-4 pr-4">
                           <div class="truncate pr-2">
                               <p class="font-black text-slate-900 text-sm md:text-base truncate" title="{{ $ticket->destination->name }}">{{ $ticket->destination->name }}</p>
                               <p class="text-xs text-slate-500 mt-1 flex items-center gap-1">
                                   📅 {{ optional($ticket->transaction)->visit_date ? optional($ticket->transaction->visit_date)->format('d M Y') : '-' }}
                               </p>
                           </div>
                           <div class="text-right shrink-0">
                               <span class="inline-flex rounded-full bg-emerald-50 px-2.5 py-1 text-[10px] font-black uppercase tracking-wider text-emerald-700">Tersedia</span>
                               <p class="mt-2 font-mono text-[9px] text-slate-400">ID: {{ substr($ticket->qr_code_payload, -8) }}</p>
                           </div>
                        </div>

                        <div class="mt-4 border-t border-dashed border-slate-200 pt-4 flex items-center justify-between pl-4 pr-4">
                            <span class="text-[10px] text-slate-400">Silakan scan di pintu masuk</span>
                            <a href="{{ route('buyer.tickets.show', $ticket) }}" class="inline-flex items-center gap-1 rounded-xl bg-blue-600 px-3 py-1.5 text-xs font-bold text-white shadow-sm hover:bg-blue-700 transition">
                                Lihat QR 
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="h-3 w-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="mt-4 rounded-3xl border-2 border-dashed border-slate-200 bg-white p-8 text-center">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-slate-50 text-slate-400 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
                    </svg>
                </div>
                <p class="text-sm font-bold text-slate-800">Tidak ada tiket aktif</p>
                <p class="mt-1 text-xs text-slate-500">Semua tiket Anda telah kedaluwarsa atau terpakai.</p>
                <a href="{{ route('destinations.index') }}" class="mt-4 inline-flex items-center gap-1.5 rounded-xl bg-blue-600 px-4 py-2 text-xs font-bold text-white shadow-sm hover:bg-blue-700 transition">Beli Tiket Baru</a>
            </div>
        @endif
    </section>

    <!-- Script Notifikasi Global -->
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000,
                customClass: {
                    popup: 'rounded-3xl'
                }
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                customClass: {
                    popup: 'rounded-3xl'
                }
            });
        @endif
    </script>
</x-layouts.app>
