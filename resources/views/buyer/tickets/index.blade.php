<x-layouts.app title="Tiket Saya">
    <div class="mx-auto max-w-6xl space-y-4">
        <div class="rounded-3xl bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-semibold text-slate-900">Tiket Saya</h1>
                    <p class="mt-2 text-sm text-slate-600">Semua tiket digital Anda setelah pembayaran berhasil.</p>
                </div>
            </div>
        </div>

        <div class="grid gap-6">
            @forelse ($transactions as $trx)
                <div class="overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-slate-200">
                    <div class="flex flex-col md:flex-row">
                        <!-- Left: Info -->
                        <div class="flex-1 p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h2 class="text-xl font-bold text-slate-900">{{ $trx->destination->name }}</h2>
                                    <p class="text-sm text-slate-500">Order ID: <span class="font-mono text-xs">{{ $trx->order_id }}</span></p>
                                </div>
                                <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">
                                    {{ $trx->quantity }} Tiket
                                </span>
                            </div>

                            <div class="mt-6 grid grid-cols-2 gap-4 border-t border-slate-100 pt-4 text-sm">
                                <div>
                                    <p class="text-xs font-medium uppercase tracking-wider text-slate-400">Tanggal Kunjungan</p>
                                    <p class="mt-1 font-semibold text-slate-900">{{ optional($trx->visit_date)->format('d M Y') ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs font-medium uppercase tracking-wider text-slate-400">Dibayar Pada</p>
                                    <p class="mt-1 font-semibold text-slate-900">{{ optional($trx->paid_at)->format('d M Y H:i') ?? '-' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Right: Actions -->
                        <div class="flex flex-col gap-2 bg-slate-50 p-6 md:w-64">
                            <p class="text-xs font-medium uppercase tracking-wider text-slate-400">Aksi Tiket</p>
                            @php $firstTicket = $trx->tickets->first(); @endphp
                            @if($firstTicket)
                                <a href="{{ route('buyer.tickets.show', $firstTicket) }}" class="flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-4 py-3 text-sm font-bold text-white shadow-sm hover:bg-blue-700 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-4 w-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.644m17.642 0a1.012 1.012 0 0 1 0 .644M12 18.75a6.75 6.75 0 1 0 0-13.5 6.75 6.75 0 0 0 0 13.5ZM12 15a3 3 0 1 1 0-6 3 3 0 0 1 0 6Z" />
                                    </svg>
                                    Lihat {{ $trx->quantity > 1 ? 'Semua ' : '' }}Tiket
                                </a>
                                <a href="{{ route('buyer.tickets.download', $firstTicket) }}" class="flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-bold text-slate-700 hover:bg-slate-50 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-4 w-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M7.5 12 12 16.5m0 0L16.5 12M12 16.5V3" />
                                    </svg>
                                    Download PDF
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="rounded-3xl bg-white p-12 text-center shadow-sm ring-1 ring-slate-200">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
                        </svg>
                    </div>
                    <h3 class="mt-4 text-lg font-semibold text-slate-900">Belum ada tiket</h3>
                    <p class="mt-1 text-sm text-slate-500">Silakan beli tiket di halaman destinasi wisata.</p>
                </div>
            @endforelse
        </div>
        <div class="mt-6">{{ $transactions->links() }}</div>
    </div>
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
