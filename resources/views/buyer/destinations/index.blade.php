<x-layouts.app title="Daftar Wisata">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <h1 class="text-2xl font-bold tracking-tight text-slate-900">Cari & Pesan Tiket Wisata</h1>
        <form action="{{ route('destinations.index') }}" method="GET" class="relative w-full max-w-sm">
            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Cari destinasi wisata..." class="w-full rounded-2xl border border-slate-200 bg-white py-2.5 pl-10 pr-4 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
            <svg class="absolute left-3 top-2.5 h-5 w-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
            @if(isset($search) && $search !== '')
                <a href="{{ route('destinations.index') }}" class="absolute right-3 top-2.5 text-slate-400 hover:text-slate-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </a>
            @endif
        </form>
    </div>
    <div class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
        @forelse ($destinations as $destination)
            <a href="{{ route('destinations.show', $destination) }}" class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                <img src="{{ $destination->image_url ?: 'https://images.unsplash.com/photo-1469474968028-56623f02e42e?q=80&w=1200&auto=format&fit=crop' }}" alt="{{ $destination->name }}" class="h-48 w-full object-cover">
                <div class="p-4">
                    <h3 class="font-semibold tracking-tight">{{ $destination->name }}</h3>
                    <p class="mt-1 text-sm text-slate-600">{{ $destination->opening_hours }}</p>
                    <p class="mt-2 text-sm font-semibold text-blue-700">Rp{{ number_format($destination->price, 0, ',', '.') }}</p>
                </div>
            </a>
        @empty
            <div class="col-span-full rounded-2xl border-2 border-dashed border-slate-200 p-12 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-auto h-12 w-12 text-slate-400">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
                <h3 class="mt-4 text-lg font-semibold text-slate-900">Tidak ada destinasi ditemukan</h3>
                <p class="mt-2 text-sm text-slate-500">Kami tidak dapat menemukan destinasi yang sesuai dengan pencarian Anda.</p>
            </div>
        @endforelse
    </div>
    <div class="mt-4">{{ $destinations->links() }}</div>
</x-layouts.app>
