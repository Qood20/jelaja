<x-layouts.app :title="$destination->name">
    <div class="mx-auto max-w-4xl space-y-6">
        <!-- Header dengan Foto -->
        <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
            <img src="{{ $destination->image_url ?: 'https://images.unsplash.com/photo-1469474968028-56623f02e42e?q=80&w=1400&auto=format&fit=crop' }}" alt="{{ $destination->name }}" class="h-80 w-full object-cover">
            <div class="p-6">
                <h1 class="text-3xl font-bold text-slate-900">{{ $destination->name }}</h1>
                <p class="mt-3 text-lg font-semibold text-blue-600">Rp{{ number_format($destination->price, 0, ',', '.') }}</p>
            </div>
        </div>

        <!-- Informasi Operasional -->
        <div class="grid gap-6 md:grid-cols-2">
            <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="mb-4 text-lg font-semibold text-slate-900">Jam Operasional</h2>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-slate-600">Jadwal:</p>
                        <p class="font-medium text-slate-900">{{ $destination->opening_hours }}</p>
                    </div>
                    @if ($destination->opening_time && $destination->closing_time)
                        <div class="flex gap-4">
                            <div>
                                <p class="text-sm text-slate-600">Buka:</p>
                                <p class="font-medium text-slate-900">{{ $destination->opening_time }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-slate-600">Tutup:</p>
                                <p class="font-medium text-slate-900">{{ $destination->closing_time }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="mb-4 text-lg font-semibold text-slate-900">Kontak & Lokasi</h2>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-slate-600">Telepon:</p>
                        <p class="font-medium text-slate-900">{{ $destination->contact_phone }}</p>
                    </div>
                    <a href="{{ $destination->location_maps_url }}" target="_blank" class="inline-block text-blue-600 hover:underline">📍 Lihat di Google Maps</a>
                </div>
            </div>
        </div>

        <!-- Deskripsi -->
        <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="mb-4 text-lg font-semibold text-slate-900">Deskripsi</h2>
            <div class="prose prose-sm max-w-none">
                <p class="text-slate-700 whitespace-pre-wrap leading-relaxed">{{ $destination->description }}</p>
            </div>
        </div>

        <!-- Sosial Media -->
        @if ($destination->social_media && count($destination->social_media) > 0)
            <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="mb-4 text-lg font-semibold text-slate-900">Ikuti Kami</h2>
                <div class="flex flex-wrap gap-3">
                    @if (!empty($destination->social_media['instagram']))
                        <a href="https://instagram.com/{{ ltrim($destination->social_media['instagram'], '@') }}" target="_blank" class="inline-block rounded-full bg-gradient-to-r from-purple-400 to-pink-600 px-4 py-2 text-white hover:shadow-lg transition">
                            📷 {{ $destination->social_media['instagram'] }}
                        </a>
                    @endif
                    @if (!empty($destination->social_media['facebook']))
                        <a href="https://facebook.com/{{ $destination->social_media['facebook'] }}" target="_blank" class="inline-block rounded-full bg-blue-600 px-4 py-2 text-white hover:shadow-lg transition">
                            f {{ $destination->social_media['facebook'] }}
                        </a>
                    @endif
                    @if (!empty($destination->social_media['twitter']))
                        <a href="https://twitter.com/{{ ltrim($destination->social_media['twitter'], '@') }}" target="_blank" class="inline-block rounded-full bg-sky-400 px-4 py-2 text-white hover:shadow-lg transition">
                            𝕏 {{ $destination->social_media['twitter'] }}
                        </a>
                    @endif
                    @if (!empty($destination->social_media['tiktok']))
                        <a href="https://tiktok.com/@{{ ltrim($destination->social_media['tiktok'], '@') }}" target="_blank" class="inline-block rounded-full bg-black px-4 py-2 text-white hover:shadow-lg transition">
                            🎵 {{ $destination->social_media['tiktok'] }}
                        </a>
                    @endif
                </div>
            </div>
        @endif



        <!-- Actions -->
        <div class="flex flex-wrap gap-3 rounded-lg bg-slate-50 p-6">
            <a href="{{ route('operator.destinations.edit', $destination) }}" class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700 transition">
                ✏️ Edit
            </a>
        </div>
    </div>
</x-layouts.app>
