<x-layouts.app title="Transaksi Saya">
    <div class="mx-auto max-w-4xl space-y-6">
        <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <h1 class="text-2xl font-bold text-slate-900">Riwayat Transaksi</h1>
            <p class="mt-1 text-sm text-slate-500">Daftar semua transaksi pembelian tiket Anda.</p>
        </div>

        <div class="space-y-4">
            @forelse ($transactions as $trx)
                <div class="group relative overflow-hidden rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200 transition hover:shadow-md">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div class="space-y-1">
                            <div class="flex items-center gap-3">
                                <h3 class="font-bold text-slate-900">{{ $trx->destination->name }}</h3>
                                @if($trx->status === 'paid')
                                    <span class="rounded-full bg-emerald-100 px-2.5 py-0.5 text-[10px] font-bold uppercase text-emerald-700">Lunas</span>
                                @elseif($trx->status === 'pending')
                                    <span class="rounded-full bg-amber-100 px-2.5 py-0.5 text-[10px] font-bold uppercase text-amber-700">Menunggu</span>
                                @else
                                    <span class="rounded-full bg-red-100 px-2.5 py-0.5 text-[10px] font-bold uppercase text-red-600">Gagal</span>
                                @endif
                            </div>
                            <p class="text-xs font-mono text-slate-400">{{ $trx->order_id }}</p>
                        </div>
                        
                        <div class="flex items-center justify-between gap-6 sm:justify-end">
                            <div class="text-right">
                                <p class="text-xs text-slate-400">Total Bayar</p>
                                <p class="font-bold text-slate-900 uppercase">Rp{{ number_format($trx->gross_amount, 0, ',', '.') }}</p>
                            </div>
                            @if($trx->status === 'paid')
                                <a href="{{ route('buyer.tickets.show', $trx->tickets->first()) }}" class="rounded-2xl bg-blue-50 px-4 py-2 text-sm font-bold text-blue-700 hover:bg-blue-100 transition">
                                    Lihat Tiket
                                </a>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mt-4 flex items-center gap-4 border-t border-slate-100 pt-4 text-[10px] font-medium uppercase tracking-wider text-slate-400">
                        <div class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-3 w-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                            </svg>
                            Kunjungan: {{ $trx->visit_date->format('d M Y') }}
                        </div>
                        @if($trx->paid_at)
                            <div class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-3 w-3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                Lunas: {{ $trx->paid_at->format('d/m/y H:i') }}
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="rounded-3xl bg-white p-12 text-center shadow-sm ring-1 ring-slate-200">
                    <p class="text-sm text-slate-500">Belum ada riwayat transaksi.</p>
                </div>
            @endforelse
        </div>
        <div class="mt-6">{{ $transactions->links() }}</div>
    </div>
</x-layouts.app>
