<x-layouts.app title="Jelaja - Marketplace Tiket Wisata">
    <section class="rounded-3xl bg-gradient-to-br from-blue-700 via-blue-600 to-cyan-500 p-6 text-white shadow-lg md:p-10">
        <p class="inline-flex rounded-full bg-white/20 px-3 py-1 text-xs font-semibold tracking-wide">Marketplace Tiket Wisata</p>
        <h1 class="mt-4 text-2xl font-bold leading-tight md:text-4xl">Jelajahi Keindahan Nusantara dalam Satu Genggaman</h1>
<p class="mt-3 max-w-3xl text-sm/6 md:text-base">Pesan tiket dalam hitungan detik, masuk lokasi tanpa perlu antre. Liburan jadi lebih maksimal tanpa ribet urusan administrasi.</p>
        <div class="mt-6 flex flex-wrap gap-3">
            <a href="{{ route('buyer.destinations.index') }}" class="rounded-xl bg-white px-4 py-2 text-sm font-semibold text-blue-700">Lihat Destinasi</a>
            <a href="{{ route('register') }}" class="rounded-xl border border-white/60 px-4 py-2 text-sm font-semibold">Mulai Sekarang</a>
        </div>
    </section>

    <section class="mt-8">
        <div class="flex items-end justify-between gap-3">
            <h2 class="text-xl font-semibold tracking-tight">Destinasi Unggulan</h2>
            <span class="text-xs font-medium text-slate-500">Pilihan utama minggu ini</span>
        </div>
        @forelse ($destinations->take(1) as $destination)
            <article class="mt-4 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-md">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <img src="{{ $destination->image_url ?: 'https://images.unsplash.com/photo-1469474968028-56623f02e42e?q=80&w=1400&auto=format&fit=crop' }}" alt="{{ $destination->name }}" class="h-64 w-full object-cover md:h-full">
                    <div class="p-6 md:p-8">
                        <h3 class="text-2xl font-bold tracking-tight">{{ $destination->name }}</h3>
                        <p class="mt-3 text-sm leading-6 text-slate-600">{{ $destination->description }}</p>
                        <div class="mt-4 space-y-2 text-sm">
                            <p><span class="font-semibold">Jam buka:</span> {{ $destination->opening_hours }}</p>
                            <p><span class="font-semibold">Harga:</span> Rp{{ number_format($destination->price, 0, ',', '.') }}</p>
                        </div>
                        <a href="{{ route('buyer.destinations.show', $destination) }}" class="mt-5 inline-block rounded-xl bg-blue-700 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-800">Lihat Detail TRMS Serulingmas</a>
                    </div>
                </div>
            </article>
        @empty
            <p class="mt-4 text-sm text-slate-600">Belum ada destinasi tersedia.</p>
        @endforelse
    </section>

    <section id="kontak" class="mt-8 rounded-3xl bg-slate-50 p-6 md:p-10">
        <h2 class="text-xl font-semibold tracking-tight">Kontak Kami</h2>
        <p class="mt-2 text-sm text-slate-600">Hubungi kami untuk informasi lebih lanjut atau dukungan.</p>
        <div class="mt-6 grid gap-6 md:grid-cols-2">
            <div>
                <h3 class="font-semibold text-slate-900">Email</h3>
                <p class="mt-1 text-sm text-slate-600">support@jelaja.com</p>
            </div>
            <div>
                <h3 class="font-semibold text-slate-900">Sosial Media</h3>
                <div class="mt-1 flex gap-3">
                    <a href="#" class="text-blue-600 hover:text-blue-800">Facebook</a>
                    <a href="#" class="text-blue-400 hover:text-blue-600">Twitter</a>
                    <a href="#" class="text-pink-600 hover:text-pink-800">Instagram</a>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
