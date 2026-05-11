<x-layouts.app title="Persetujuan Operator">
    <div class="mx-auto max-w-6xl space-y-4">
        <div class="rounded-3xl bg-white p-6 shadow-sm">
            <h1 class="text-2xl font-semibold text-slate-900">Operator Pending</h1>
            <p class="mt-2 text-sm text-slate-600">Verifikasi pendaftar operator sebelum memberi akses.</p>
        </div>

        <div class="overflow-hidden rounded-3xl bg-white shadow-sm">
            <div class="grid grid-cols-5 gap-4 border-b px-6 py-4 text-sm font-semibold text-slate-700 sm:grid-cols-6">
                <span>Nama</span>
                <span class="hidden sm:inline">Email</span>
                <span class="hidden md:inline">Tanggal Daftar</span>
                <span>Status</span>
                <span class="col-span-2 text-right">Aksi</span>
            </div>
            @forelse ($operators as $operator)
                <div class="grid grid-cols-5 gap-4 border-t px-6 py-4 text-sm text-slate-700 sm:grid-cols-6">
                    <span>{{ $operator->name }}</span>
                    <span class="hidden sm:inline">{{ $operator->email }}</span>
                    <span class="hidden md:inline">{{ $operator->created_at->format('d M Y') }}</span>
                    <span class="text-blue-700">{{ ucfirst($operator->status) }}</span>
                    <span class="col-span-2 text-right space-x-2">
                        <form action="{{ route('admin.operators.approve', $operator) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="rounded-full bg-emerald-600 px-4 py-2 text-xs font-semibold text-white hover:bg-emerald-700">Setujui</button>
                        </form>
                        <form action="{{ route('admin.operators.reject', $operator) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="rounded-full bg-red-600 px-4 py-2 text-xs font-semibold text-white hover:bg-red-700">Tolak</button>
                        </form>
                    </span>
                </div>
            @empty
                <div class="px-6 py-8 text-center text-sm text-slate-600">Tidak ada operator pending saat ini.</div>
            @endforelse
        </div>

        <div class="px-6 py-4">
            {{ $operators->links() }}
        </div>
    </div>
</x-layouts.app>
