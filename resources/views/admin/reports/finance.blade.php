<x-layouts.app title="Laporan Keuangan">
    <div class="mx-auto max-w-7xl space-y-4">
        <div class="rounded-3xl bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-slate-900">Financial Monitoring</h1>
                    <p class="mt-2 text-sm text-slate-600">Ringkasan pendapatan harian dan bulanan.</p>
                </div>
                <div class="grid gap-3 sm:grid-cols-2">
                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-sm text-slate-500">Pendapatan Hari Ini</p>
                        <p class="mt-2 text-2xl font-semibold text-slate-900">Rp {{ number_format($dailyRevenue, 0, ',', '.') }}</p>
                    </div>
                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-sm text-slate-500">Pendapatan Bulan Ini</p>
                        <p class="mt-2 text-2xl font-semibold text-slate-900">Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="overflow-hidden rounded-3xl bg-white shadow-sm">
            <div class="border-b px-6 py-4 text-sm font-semibold text-slate-700">Transaksi Terbaru</div>
            <div class="divide-y divide-slate-200">
                @forelse ($transactions as $transaction)
                    <div class="px-6 py-4 sm:flex sm:items-center sm:justify-between">
                        <div class="space-y-1">
                            <p class="font-semibold text-slate-900">{{ $transaction->destination->name }}</p>
                            <p class="text-sm text-slate-600">{{ $transaction->buyer->name }} • {{ $transaction->visit_date->format('d M Y') }}</p>
                        </div>
                        <div class="mt-3 flex items-center gap-3 sm:mt-0">
                            <span class="rounded-full bg-slate-100 px-3 py-1 text-sm text-slate-700">{{ ucfirst($transaction->status) }}</span>
                            <span class="text-sm font-semibold text-slate-900">Rp {{ number_format($transaction->gross_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-8 text-center text-sm text-slate-500">Tidak ada transaksi terbaru.</div>
                @endforelse
            </div>
        </div>
    </div>
</x-layouts.app>
