<x-layouts.app title="Dashboard Pembeli">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <h1 class="text-2xl font-semibold tracking-tight">Beranda Pembeli</h1>
        <div class="flex gap-2">
            <a href="{{ route('buyer.transactions.index') }}" class="inline-flex items-center gap-2 rounded-xl bg-white px-4 py-2.5 text-sm font-medium text-slate-700 shadow-sm ring-1 ring-inset ring-slate-300 hover:bg-slate-50 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                Riwayat Pembelian
            </a>
            <a href="{{ route('buyer.tickets.index') }}" class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm hover:bg-blue-700 transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
                </svg>
                Tiket Saya
            </a>
        </div>
    </div>

    <section class="mt-6">
        <h2 class="font-semibold">Rekomendasi Wisata (Most Booked)</h2>
        <div class="mt-3 grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($recommended as $item)
                <a href="{{ route('buyer.destinations.show', $item) }}" class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                    <img src="{{ $item->image_url ?: 'https://images.unsplash.com/photo-1469474968028-56623f02e42e?q=80&w=1200&auto=format&fit=crop' }}" alt="{{ $item->name }}" class="h-40 w-full object-cover">
                    <div class="p-4">
                    <p class="font-semibold tracking-tight">{{ $item->name }}</p>
                    <p class="mt-1 text-sm text-slate-600">Rp{{ number_format($item->price, 0, ',', '.') }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <section class="mt-6">
        <h2 class="font-semibold">Tiket Aktif Saya</h2>
        @if ($tickets->isNotEmpty())
            <div class="mt-3 grid grid-cols-1 gap-4 md:grid-cols-2">
                @foreach ($tickets as $ticket)
                    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-semibold">{{ $ticket->destination->name }}</p>
                                <p class="text-sm text-slate-600">{{ optional($ticket->transaction)->visit_date ? optional($ticket->transaction->visit_date)->format('d M Y') : '-' }}</p>
                            </div>
                            <span class="rounded-full bg-green-100 px-2 py-1 text-xs font-medium text-green-700">Aktif</span>
                        </div>
                        <div class="mt-3 text-xs text-slate-500">
                            QR: {{ substr($ticket->qr_code_payload, 0, 8) }}...
                        </div>
                    </div>
                @endforeach
            </div>
            <a href="{{ route('buyer.tickets.index') }}" class="mt-3 inline-block text-sm text-blue-600 hover:text-blue-800">Lihat semua tiket →</a>
        @else
            <p class="mt-3 text-sm text-slate-600">Belum ada tiket aktif. <a href="{{ route('buyer.destinations.index') }}" class="text-blue-600 hover:text-blue-800">Beli sekarang</a></p>
        @endif
    </section>
</x-layouts.app>
