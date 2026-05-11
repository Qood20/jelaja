<x-layouts.app :title="$destination->name">
    <div class="mx-auto max-w-4xl">
        <!-- Header -->
        <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
            <img src="{{ $destination->image_url ?: 'https://images.unsplash.com/photo-1469474968028-56623f02e42e?q=80&w=1400&auto=format&fit=crop' }}" alt="{{ $destination->name }}" class="h-80 w-full object-cover">
            <div class="p-6">
                <h1 class="text-3xl font-bold text-slate-900">{{ $destination->name }}</h1>
                <p class="mt-4 text-lg font-semibold text-blue-600">Rp{{ number_format($destination->price, 0, ',', '.') }} / Orang</p>
            </div>
        </div>

        <!-- Informasi Dasar -->
        <div class="mt-6 grid gap-6 md:grid-cols-2">
            <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="mb-4 text-lg font-semibold text-slate-900">Jam Operasional</h2>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-slate-600">Jadwal:</p>
                        <p class="font-medium text-slate-900">{{ $destination->opening_hours }}</p>
                    </div>
                    @if ($destination->opening_time && $destination->closing_time)
                        <div class="flex gap-4 pt-2 border-t border-slate-200">
                            <div>
                                <p class="text-sm text-slate-600">Buka Jam:</p>
                                <p class="text-lg font-semibold text-slate-900">{{ $destination->opening_time }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-slate-600">Tutup Jam:</p>
                                <p class="text-lg font-semibold text-slate-900">{{ $destination->closing_time }}</p>
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
                    <a href="{{ $destination->location_maps_url }}" target="_blank" class="inline-block rounded-lg bg-blue-100 px-3 py-2 text-blue-700 hover:bg-blue-200 transition">
                        📍 Lihat di Google Maps
                    </a>
                </div>
            </div>
        </div>

        <!-- Deskripsi -->
        <div class="mt-6 rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="mb-4 text-lg font-semibold text-slate-900">Tentang Destinasi</h2>
            <p class="whitespace-pre-wrap leading-relaxed text-slate-700">{{ $destination->description }}</p>
        </div>

        <!-- Sosial Media -->
        @if ($destination->social_media && count($destination->social_media) > 0)
            <div class="mt-6 rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="mb-4 text-lg font-semibold text-slate-900">Ikuti Kami di Media Sosial</h2>
                <div class="flex flex-wrap gap-3">
                    @if (!empty($destination->social_media['instagram']))
                        <a href="https://instagram.com/{{ ltrim($destination->social_media['instagram'], '@') }}" target="_blank" class="inline-block rounded-full bg-gradient-to-r from-purple-400 to-pink-600 px-4 py-2 text-sm text-white hover:shadow-lg transition">
                            📷 Instagram
                        </a>
                    @endif
                    @if (!empty($destination->social_media['facebook']))
                        <a href="https://facebook.com/{{ $destination->social_media['facebook'] }}" target="_blank" class="inline-block rounded-full bg-blue-600 px-4 py-2 text-sm text-white hover:shadow-lg transition">
                            f Facebook
                        </a>
                    @endif
                    @if (!empty($destination->social_media['twitter']))
                        <a href="https://twitter.com/{{ ltrim($destination->social_media['twitter'], '@') }}" target="_blank" class="inline-block rounded-full bg-sky-400 px-4 py-2 text-sm text-white hover:shadow-lg transition">
                            𝕏 Twitter
                        </a>
                    @endif
                    @if (!empty($destination->social_media['tiktok']))
                        <a href="https://tiktok.com/@{{ ltrim($destination->social_media['tiktok'], '@') }}" target="_blank" class="inline-block rounded-full bg-black px-4 py-2 text-sm text-white hover:shadow-lg transition">
                            🎵 TikTok
                        </a>
                    @endif
                </div>
            </div>
        @endif

        <!-- Galeri Foto -->
        @if ($destination->galleries->count() > 0)
            <div class="mt-6 rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="mb-4 text-lg font-semibold text-slate-900">Galeri Foto</h2>
                <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
                    @foreach ($destination->galleries as $gallery)
                        <div class="overflow-hidden rounded-lg border border-slate-200 shadow-sm hover:shadow-md transition">
                            <img src="{{ $gallery->image_url }}" alt="Gallery" class="h-40 w-full object-cover hover:scale-105 transition-transform">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Pembelian Tiket -->
        @auth
            @if (auth()->user()->role === 'buyer')
                <div class="mt-6 rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="mb-4 text-lg font-semibold text-slate-900">Pesan Tiket Anda</h2>
                    <form action="{{ route('buyer.checkout', $destination) }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Tanggal Kunjungan</label>
                            <input type="date" name="visit_date" value="{{ old('visit_date', now()->addDay()->format('Y-m-d')) }}" min="{{ now()->addDay()->format('Y-m-d') }}" class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-100" required>
                            @error('visit_date')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Jumlah Tiket</label>
                            <input type="number" id="quantity-input" name="quantity" value="{{ old('quantity', 1) }}" min="1" max="10" class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-100" required>
                            @error('quantity')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div class="rounded-lg bg-blue-50 p-4">
                            <p class="text-sm text-slate-600">Total Harga:</p>
                            <p id="total-price-display" class="text-2xl font-bold text-blue-700">Rp{{ number_format($destination->price * (old('quantity', 1)), 0, ',', '.') }}</p>
                        </div>
                        <button type="submit" class="w-full rounded-lg bg-blue-700 px-5 py-3 font-semibold text-white transition hover:bg-blue-800">
                            Beli Tiket Sekarang
                        </button>
                    </form>
                </div>
            @endif
        @endauth

        @guest
            <div class="mt-6 rounded-lg border border-yellow-200 bg-yellow-50 p-6">
                <p class="text-center text-yellow-800">
                    <a href="{{ route('login') }}" class="font-semibold text-yellow-900 hover:underline">Silakan login</a> untuk membeli tiket
                </p>
            </div>
        @endguest
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pricePerPerson = {{ $destination->price }};
            const quantityInput = document.getElementById('quantity-input');
            const totalDisplay = document.getElementById('total-price-display');

            if (quantityInput && totalDisplay) {
                const formatRupiah = (number) => {
                    return 'Rp' + new Intl.NumberFormat('id-ID').format(number);
                };

                const updatePrice = () => {
                    const quantity = parseInt(quantityInput.value) || 0;
                    const total = quantity * pricePerPerson;
                    totalDisplay.innerText = formatRupiah(total);
                };

                quantityInput.addEventListener('input', updatePrice);
                quantityInput.addEventListener('change', updatePrice);
            }
        });
    </script>
</x-layouts.app>
