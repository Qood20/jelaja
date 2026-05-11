<x-layouts.app title="Dashboard Admin">
    <h1 class="text-2xl font-semibold tracking-tight">Dashboard Admin Jelaja</h1>
    <div class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-3">
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Operator</p>
            <p class="mt-1 text-3xl font-bold">{{ $stats['operators'] }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Pembeli</p>
            <p class="mt-1 text-3xl font-bold">{{ $stats['buyers'] }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <p class="text-sm text-slate-500">Transaksi Paid</p>
            <p class="mt-1 text-3xl font-bold text-blue-700">{{ $stats['paid_transactions'] }}</p>
        </div>
    </div>
    <div class="mt-2">
Pesan tiket dalam hitungan detik, masuk lokasi tanpa perlu antre. Liburan jadi lebih maksimal tanpa ribet urusan administrasi.
    </div>

    <div class="mt-6 flex flex-wrap gap-3">
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center justify-center rounded-xl bg-blue-700 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-800">Manajemen User</a>
        <a href="{{ route('admin.destinations.index') }}" class="inline-flex items-center justify-center rounded-xl bg-emerald-700 px-4 py-2 text-sm font-semibold text-white transition hover:bg-emerald-800">Kelola Destinasi</a>
    </div>
</x-layouts.app>
