<x-layouts.app :title="$destination->name">
    <div class="mx-auto max-w-7xl">
        <!-- 2-Column Responsive Layout -->
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-[1.8fr_1.2fr]">
            
            <!-- Left Column: Media, Details, Gallery -->
            <div class="space-y-6">
                <!-- Main Destination Card -->
                <div class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm">
                    <div class="relative overflow-hidden h-[340px] md:h-[400px]">
                        <img src="{{ $destination->image_url ?: 'https://images.unsplash.com/photo-1469474968028-56623f02e42e?q=80&w=1400&auto=format&fit=crop' }}" alt="{{ $destination->name }}" class="h-full w-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/40 via-transparent to-transparent"></div>
                        <div class="absolute bottom-6 left-6 right-6 text-white">
                            <span class="inline-flex rounded-full bg-blue-600 px-3 py-1 text-xs font-black uppercase tracking-wider">Destinasi</span>
                            <h1 class="mt-2 text-2xl font-black md:text-4xl tracking-tight">{{ $destination->name }}</h1>
                        </div>
                    </div>
                    
                    <div class="p-6 md:p-8">
                        <h2 class="text-lg font-black text-slate-900 tracking-tight mb-3">Tentang Wisata</h2>
                        <p class="whitespace-pre-line leading-relaxed text-slate-600 text-sm md:text-base">{{ $destination->description }}</p>
                    </div>
                </div>

                <!-- Galeri Foto -->
                @if ($destination->galleries->count() > 0)
                    <div class="rounded-[2rem] border border-slate-200 bg-white p-6 md:p-8 shadow-sm">
                        <h2 class="text-lg font-black text-slate-900 tracking-tight mb-4">Galeri Foto Keindahan</h2>
                        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3">
                            @foreach ($destination->galleries as $gallery)
                                <div class="overflow-hidden rounded-2xl border border-slate-100 shadow-sm transition hover:shadow-md">
                                    <img src="{{ $gallery->image_url }}" alt="Galeri {{ $destination->name }}" class="h-32 w-full object-cover hover:scale-105 transition-transform duration-300">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Sosial Media -->
                @if ($destination->social_media && count($destination->social_media) > 0)
                    <div class="rounded-[2rem] border border-slate-200 bg-white p-6 md:p-8 shadow-sm">
                        <h2 class="text-lg font-black text-slate-900 tracking-tight mb-4">Ikuti Kami di Media Sosial</h2>
                        <div class="flex flex-wrap gap-3">
                            @if (!empty($destination->social_media['instagram']))
                                <a href="https://instagram.com/{{ ltrim($destination->social_media['instagram'], '@') }}" target="_blank" class="inline-flex items-center gap-1.5 rounded-2xl bg-gradient-to-r from-purple-500 to-pink-600 px-4 py-2.5 text-xs font-bold text-white shadow-sm hover:-translate-y-0.5 transition duration-200">
                                    📷 Instagram
                                </a>
                            @endif
                            @if (!empty($destination->social_media['facebook']))
                                <a href="https://facebook.com/{{ $destination->social_media['facebook'] }}" target="_blank" class="inline-flex items-center gap-1.5 rounded-2xl bg-blue-600 px-4 py-2.5 text-xs font-bold text-white shadow-sm hover:-translate-y-0.5 transition duration-200">
                                    f Facebook
                                </a>
                            @endif
                            @if (!empty($destination->social_media['twitter']))
                                <a href="https://twitter.com/{{ ltrim($destination->social_media['twitter'], '@') }}" target="_blank" class="inline-flex items-center gap-1.5 rounded-2xl bg-sky-400 px-4 py-2.5 text-xs font-bold text-white shadow-sm hover:-translate-y-0.5 transition duration-200">
                                    𝕏 Twitter
                                </a>
                            @endif
                            @if (!empty($destination->social_media['tiktok']))
                                <a href="https://tiktok.com/@{{ ltrim($destination->social_media['tiktok'], '@') }}" target="_blank" class="inline-flex items-center gap-1.5 rounded-2xl bg-black px-4 py-2.5 text-xs font-bold text-white shadow-sm hover:-translate-y-0.5 transition duration-200">
                                    🎵 TikTok
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <!-- Right Column: Maps, Operasional & Booking Form (Sticky) -->
            <div class="space-y-6">
                <!-- Info Operasional & Lokasi -->
                <div class="rounded-[2rem] border border-slate-200 bg-white p-6 md:p-8 shadow-sm">
                    <h2 class="text-lg font-black text-slate-900 tracking-tight mb-4">Detail Operasional</h2>
                    
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                                📅
                            </span>
                            <div>
                                <span class="block text-[10px] font-bold text-slate-400 uppercase">Jadwal Operasional</span>
                                <span class="text-sm font-bold text-slate-800">{{ $destination->opening_hours }}</span>
                            </div>
                        </div>

                        @if ($destination->opening_time && $destination->closing_time)
                            <div class="flex items-start gap-3 border-t border-slate-100 pt-3">
                                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                                    ⏰
                                </span>
                                <div class="flex gap-6">
                                    <div>
                                        <span class="block text-[10px] font-bold text-slate-400 uppercase">Jam Buka</span>
                                        <span class="text-sm font-extrabold text-slate-800">{{ $destination->opening_time }}</span>
                                    </div>
                                    <div>
                                        <span class="block text-[10px] font-bold text-slate-400 uppercase">Jam Tutup</span>
                                        <span class="text-sm font-extrabold text-slate-800">{{ $destination->closing_time }}</span>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="flex items-start gap-3 border-t border-slate-100 pt-3">
                            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                                📞
                            </span>
                            <div>
                                <span class="block text-[10px] font-bold text-slate-400 uppercase">Nomor Kontak</span>
                                <span class="text-sm font-bold text-slate-800">{{ $destination->contact_phone }}</span>
                            </div>
                        </div>

                        <div class="border-t border-slate-100 pt-4">
                            <a href="{{ $destination->location_maps_url }}" target="_blank" class="flex w-full items-center justify-center gap-2 rounded-2xl bg-blue-50 py-3 text-sm font-black text-blue-700 hover:bg-blue-100 transition duration-200">
                                📍 Buka Google Maps
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Booking Voucher Box (Sticky) -->
                <div class="sticky top-24 rounded-[2rem] border border-slate-200 bg-white p-6 md:p-8 shadow-sm">
                    <span class="block text-[10px] font-bold text-slate-400 uppercase">Harga Tiket Masuk</span>
                    <div class="flex items-baseline gap-1 mt-1">
                        <span class="text-3xl font-black text-blue-700">Rp{{ number_format($destination->price, 0, ',', '.') }}</span>
                        <span class="text-xs text-slate-500 font-bold">/ Orang</span>
                    </div>

                    @auth
                        @if (auth()->user()->role === 'buyer')
                            <form action="{{ route('buyer.checkout', $destination) }}" method="POST" class="mt-6 space-y-4">
                                @csrf
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Pilih Tanggal Kunjungan</label>
                                    <input type="date" name="visit_date" value="{{ old('visit_date', now()->addDay()->format('Y-m-d')) }}" min="{{ now()->addDay()->format('Y-m-d') }}" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500" required>
                                    @error('visit_date')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </div>
                                
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1.5">Jumlah Pengunjung</label>
                                    <input type="number" id="quantity-input" name="quantity" value="{{ old('quantity', 1) }}" min="1" max="20" class="w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500" required>
                                    @error('quantity')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                                </div>

                                <div class="rounded-2xl bg-blue-50 p-4 border border-blue-100/50">
                                    <span class="block text-[10px] font-bold text-slate-400 uppercase">Total Pembayaran</span>
                                    <p id="total-price-display" class="text-2xl font-black text-blue-700 mt-1">Rp{{ number_format($destination->price * (old('quantity', 1)), 0, ',', '.') }}</p>
                                </div>

                                <button type="submit" class="w-full rounded-2xl bg-blue-700 py-4 font-black text-white shadow-sm hover:bg-blue-800 transition active:scale-98">
                                    Pesan Tiket Sekarang
                                </button>
                            </form>
                        @else
                            <div class="mt-6 rounded-2xl bg-slate-50 p-4 text-center border border-slate-200">
                                <p class="text-xs text-slate-500">Hanya akun Pembeli (User) yang dapat memesan tiket.</p>
                            </div>
                        @endif
                    @endauth

                    @guest
                        <div class="mt-6 rounded-2xl bg-amber-50 p-4 text-center border border-amber-200">
                            <p class="text-sm text-amber-800">
                                <a href="{{ route('login') }}" class="font-black text-amber-950 hover:underline">Silakan Login</a> terlebih dahulu untuk melakukan pemesanan tiket wisata.
                            </p>
                        </div>
                    @endguest
                </div>
            </div>

        </div>
    </div>

    <!-- Live Price Calculator Script -->
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
