<x-layouts.app title="Dashboard Operator">
    <div class="mx-auto max-w-4xl">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">Dashboard Operator</h1>
            <div class="flex items-center gap-2">
                @if(auth()->user()->status === 'approved')
                    <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700 uppercase">Terverifikasi</span>
                @elseif(auth()->user()->status === 'pending')
                    <span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-bold text-amber-700 uppercase">Menunggu Verifikasi</span>
                @else
                    <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-700 uppercase">Ditolak</span>
                @endif
            </div>
        </div>

        @if(auth()->user()->status === 'pending')
            <div class="mt-6 rounded-3xl border border-amber-200 bg-amber-50 p-6 shadow-sm">
                <div class="flex gap-4">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-amber-100 text-amber-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-amber-900">Pendaftaran Anda Sedang Diproses</h3>
                        <p class="mt-1 text-sm text-amber-700">Akun Anda sedang ditinjau oleh Admin. Anda akan dapat mengelola destinasi dan menggunakan scanner QR setelah akun Anda disetujui.</p>
                    </div>
                </div>
            </div>
        @elseif(auth()->user()->status === 'rejected')
            <div class="mt-6 rounded-3xl border border-red-200 bg-red-50 p-6 shadow-sm">
                <div class="flex gap-4">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-red-100 text-red-700">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-red-900">Pendaftaran Ditolak</h3>
                        <p class="mt-1 text-sm text-red-700">Maaf, pendaftaran Anda sebagai operator wisata tidak disetujui oleh admin. Silakan hubungi dukungan kami untuk informasi lebih lanjut.</p>
                    </div>
                </div>
            </div>
        @else
            <div class="mt-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:shadow-md">
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Tiket Terjual</p>
                    <p class="mt-2 text-3xl font-black text-slate-900">{{ $soldTickets }}</p>
                    <div class="mt-4 flex items-center gap-1.5 text-xs font-medium text-slate-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-4 w-4 text-blue-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
                        </svg>
                        Lunas dibayar
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:shadow-md">
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Terverifikasi</p>
                    <p class="mt-2 text-3xl font-black text-emerald-600">{{ $usedTickets }}</p>
                    <div class="mt-4 flex items-center gap-1.5 text-xs font-medium text-slate-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-4 w-4 text-emerald-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Telah di-scan
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:shadow-md">
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Total Pendapatan</p>
                    <p class="mt-2 text-2xl font-black text-blue-700">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</p>
                    <div class="mt-4 flex items-center gap-1.5 text-xs font-medium text-slate-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-4 w-4 text-blue-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Transaksi sukses
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:shadow-md">
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Destinasi</p>
                    <p class="mt-2 text-3xl font-black text-slate-900">{{ count($destinations) }}</p>
                    <div class="mt-4 flex items-center gap-1.5 text-xs font-medium text-slate-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-4 w-4 text-slate-600">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                        Aktif di platform
                    </div>
                </div>
            </div>

            <div class="mt-8">
                <h2 class="text-lg font-bold text-slate-900">Menu Cepat</h2>
                <div class="mt-4 flex flex-wrap gap-3">
                    <a href="{{ route('operator.destinations.index') }}" class="inline-flex items-center gap-2 rounded-2xl bg-blue-600 px-6 py-4 font-bold text-white shadow-sm transition hover:bg-blue-700 hover:shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Kelola Destinasi
                    </a>
                    <a href="{{ route('operator.scanner.index') }}" class="inline-flex items-center gap-2 rounded-2xl bg-emerald-600 px-6 py-4 font-bold text-white shadow-sm transition hover:bg-emerald-700 hover:shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z" />
                        </svg>
                        Scanner QR
                    </a>
                </div>
            </div>

            <!-- Rincian Pendapatan & Penjualan -->
            <div class="mt-8 grid gap-6 md:grid-cols-2">
                <!-- Kiri: Pendapatan per Destinasi -->
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="text-lg font-bold text-slate-900 mb-4">Pendapatan per Destinasi</h2>
                    <div class="space-y-4">
                        @forelse($revenueShare as $share)
                            <div class="flex items-center justify-between border-b border-slate-100 pb-3 last:border-0 last:pb-0">
                                <div class="truncate pr-2">
                                    <p class="font-semibold text-slate-800 text-sm truncate" title="{{ $share->name }}">{{ $share->name }}</p>
                                    <p class="text-xs text-slate-500">{{ $share->tickets_sold }} Tiket terjual</p>
                                </div>
                                <div class="text-right shrink-0">
                                    <p class="font-bold text-blue-700 text-sm">Rp{{ number_format($share->revenue, 0, ',', '.') }}</p>
                                    <p class="text-[10px] text-slate-400">Harga: Rp{{ number_format($share->price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-6">
                                <p class="text-sm text-slate-500">Belum ada data destinasi.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Kanan: Transaksi Terbaru -->
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="text-lg font-bold text-slate-900 mb-4">Transaksi Sukses Terbaru</h2>
                    <div class="space-y-4">
                        @forelse($recentTransactions as $trx)
                            <div class="flex items-center justify-between border-b border-slate-100 pb-3 last:border-0 last:pb-0">
                                <div class="flex items-center gap-3 truncate pr-2">
                                    @if($trx->buyer->profile_photo_url)
                                        <img src="{{ $trx->buyer->getProfilePhotoUrl() }}" class="h-8 w-8 rounded-full object-cover shrink-0">
                                    @else
                                        <div class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-100 text-[10px] font-bold text-blue-700 uppercase shrink-0">
                                            {{ strtoupper(substr($trx->buyer->name, 0, 1)) }}
                                        </div>
                                    @endif
                                    <div class="truncate">
                                        <p class="font-semibold text-slate-800 text-xs truncate">{{ $trx->buyer->name }}</p>
                                        <p class="text-[10px] text-slate-500 font-mono truncate">{{ $trx->order_id }}</p>
                                    </div>
                                </div>
                                <div class="text-right shrink-0">
                                    <p class="font-bold text-slate-950 text-xs">Rp{{ number_format($trx->gross_amount, 0, ',', '.') }}</p>
                                    <p class="text-[10px] text-slate-400">{{ $trx->quantity }} Tiket</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-6">
                                <p class="text-sm text-slate-500">Belum ada transaksi lunas.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Bagian Pengunjung Harian -->
            <div class="mt-8">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-bold text-slate-900">Pengunjung Hari Ini</h2>
                    <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-700">{{ $todayVisitors->count() }} Orang</span>
                </div>
                <div class="mt-4 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
                    @if($todayVisitors->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm">
                                <thead class="bg-slate-50 text-xs uppercase text-slate-500">
                                    <tr>
                                        <th class="px-6 py-4 font-semibold">Nama Pengunjung</th>
                                        <th class="px-6 py-4 font-semibold">Destinasi</th>
                                        <th class="px-6 py-4 font-semibold">ID Tiket</th>
                                        <th class="px-6 py-4 font-semibold text-right">Waktu Scan</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @foreach($todayVisitors as $visitor)
                                        <tr class="transition hover:bg-slate-50">
                                            <td class="px-6 py-4 font-medium text-slate-900">
                                                <div class="flex items-center gap-3">
                                                    @if($visitor->buyer->profile_photo_url)
                                                        <img src="{{ $visitor->buyer->getProfilePhotoUrl() }}" class="h-8 w-8 rounded-full object-cover">
                                                    @else
                                                        <div class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-100 text-xs font-bold text-blue-700">
                                                            {{ strtoupper(substr($visitor->buyer->name, 0, 1)) }}
                                                        </div>
                                                    @endif
                                                    {{ $visitor->buyer->name }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-slate-600">{{ $visitor->destination->name }}</td>
                                            <td class="px-6 py-4 font-mono text-xs text-slate-500">{{ substr($visitor->qr_code_payload, -8) }}</td>
                                            <td class="px-6 py-4 text-right text-slate-600">{{ $visitor->used_at->format('H:i') }} WIB</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center p-12 text-center">
                            <div class="flex h-16 w-16 items-center justify-center rounded-full bg-slate-50 text-slate-400 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                </svg>
                            </div>
                            <p class="text-sm font-medium text-slate-900">Belum ada pengunjung hari ini</p>
                            <p class="mt-1 text-xs text-slate-500">Scan tiket pengunjung di pintu masuk untuk mencatat kehadiran.</p>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</x-layouts.app>
