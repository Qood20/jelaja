<x-layouts.app title="Galeri Foto - {{ $destination->name }}">
    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold">Galeri Foto: {{ $destination->name }}</h1>
                <p class="mt-1 text-sm text-slate-600">Kelola foto-foto wisata Anda</p>
            </div>
            <a href="{{ route('operator.galleries.create', $destination) }}" class="rounded bg-blue-700 px-4 py-2 text-white hover:bg-blue-800">
                Tambah Foto
            </a>
        </div>

        @if ($message = session('success'))
            <div class="rounded-lg border border-green-300 bg-green-50 p-4 text-green-700">
                {{ $message }}
            </div>
        @endif

        @if ($galleries->count() > 0)
            <div class="grid grid-cols-1 gap-4 md:grid-cols-3 lg:grid-cols-4">
                @forelse ($galleries as $gallery)
                    <div class="overflow-hidden rounded-lg border border-slate-200 shadow-sm">
                        <div class="aspect-square overflow-hidden bg-slate-100">
                            <img src="{{ $gallery->image_url }}" alt="Gallery" class="h-full w-full object-cover">
                        </div>
                        <div class="p-3">
                            <form action="{{ route('operator.galleries.destroy', [$destination, $gallery]) }}" method="POST" class="mt-2">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-full rounded bg-red-600 px-3 py-2 text-sm text-white hover:bg-red-700" onclick="return confirm('Yakin ingin menghapus foto ini?')">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full rounded-lg border-2 border-dashed border-slate-300 p-8 text-center">
                        <p class="text-slate-600">Belum ada foto. <a href="{{ route('operator.galleries.create', $destination) }}" class="font-semibold text-blue-600 hover:underline">Tambah foto sekarang</a></p>
                    </div>
                @endforelse
            </div>

            @if ($galleries->hasPages())
                <div class="mt-6">
                    {{ $galleries->links() }}
                </div>
            @endif
        @else
            <div class="rounded-lg border-2 border-dashed border-slate-300 p-8 text-center">
                <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <p class="mt-2 text-slate-600">Tidak ada foto di galeri</p>
                <a href="{{ route('operator.galleries.create', $destination) }}" class="mt-4 inline-block rounded bg-blue-700 px-4 py-2 text-white hover:bg-blue-800">
                    Tambah Foto Pertama
                </a>
            </div>
        @endif

        <div class="mt-6">
            <a href="{{ route('operator.destinations.index') }}" class="text-blue-600 hover:underline">← Kembali ke Destinasi</a>
        </div>
    </div>
</x-layouts.app>
