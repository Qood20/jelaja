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
            <div class="mt-6 grid gap-6 md:grid-cols-2">
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:shadow-md">
                    <p class="text-sm font-medium text-slate-500 uppercase tracking-wider">Total Tiket Terverifikasi</p>
                    <p class="mt-2 text-4xl font-black text-blue-700">{{ $usedTickets }}</p>
                    <div class="mt-4 flex items-center gap-2 text-sm text-slate-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-4 w-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Selesai dikunjungi
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:shadow-md">
                    <p class="text-sm font-medium text-slate-500 uppercase tracking-wider">Total Destinasi</p>
                    <p class="mt-2 text-4xl font-black text-slate-900">{{ count($destinations) }}</p>
                    <div class="mt-4 flex items-center gap-2 text-sm text-slate-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-4 w-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
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
        @endif
    </div>
</x-layouts.app>
