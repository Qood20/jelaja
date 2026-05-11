<x-layouts.app title="Daftar Wisata">
    <h1 class="text-2xl font-semibold tracking-tight">Halaman Wisata</h1>
    <div class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($destinations as $destination)
            <a href="{{ route('buyer.destinations.show', $destination) }}" class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                <img src="{{ $destination->image_url ?: 'https://images.unsplash.com/photo-1469474968028-56623f02e42e?q=80&w=1200&auto=format&fit=crop' }}" alt="{{ $destination->name }}" class="h-48 w-full object-cover">
                <div class="p-4">
                    <h3 class="font-semibold tracking-tight">{{ $destination->name }}</h3>
                    <p class="mt-1 text-sm text-slate-600">{{ $destination->opening_hours }}</p>
                    <p class="mt-2 text-sm font-semibold text-blue-700">Rp{{ number_format($destination->price, 0, ',', '.') }}</p>
                </div>
            </a>
        @endforeach
    </div>
    <div class="mt-4">{{ $destinations->links() }}</div>
</x-layouts.app>
