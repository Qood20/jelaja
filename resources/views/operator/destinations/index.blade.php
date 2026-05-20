<x-layouts.app title="Kelola Destinasi">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold tracking-tight text-slate-900">
            @if(auth()->user()->role === 'admin')
                Kelola Semua Destinasi (Panel Admin)
            @else
                Kelola Destinasi Saya (Panel Operator)
            @endif
        </h1>
        @if(auth()->user()->role === 'operator')
            <a href="{{ route('operator.destinations.create') }}" class="rounded-xl bg-blue-700 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-blue-800 transition">Tambah Destinasi</a>
        @endif
    </div>
    <div class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-3">
        @foreach ($destinations as $destination)
            <div class="overflow-hidden rounded-xl border bg-white">
                <img src="{{ $destination->image_url ?: 'https://images.unsplash.com/photo-1469474968028-56623f02e42e?q=80&w=1200&auto=format&fit=crop' }}" alt="{{ $destination->name }}" class="h-40 w-full object-cover">
                <div class="p-4">
                <h3 class="font-semibold">{{ $destination->name }}</h3>
                <p class="text-sm text-slate-600">Rp{{ number_format($destination->price, 0, ',', '.') }}</p>
                <div class="mt-3 flex flex-col gap-2">
                    <a href="{{ route('operator.destinations.show', $destination) }}" class="rounded bg-blue-500 px-3 py-1 text-center text-sm text-white hover:bg-blue-600">Lihat</a>

                    <a href="{{ route('operator.destinations.edit', $destination) }}" class="rounded bg-amber-500 px-3 py-1 text-center text-sm text-white hover:bg-amber-600">Edit</a>
                    <form action="{{ route('operator.destinations.destroy', $destination) }}" method="POST">
                        @csrf @method('DELETE')
                        <button class="w-full rounded bg-red-600 px-3 py-1 text-sm text-white hover:bg-red-700">Hapus</button>
                    </form>
                </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-4">{{ $destinations->links() }}</div>
</x-layouts.app>
