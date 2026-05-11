<x-layouts.app title="Tambah Destinasi Wisata">
    <div class="mx-auto max-w-4xl">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-900">Tambah Destinasi Wisata</h1>
            <p class="mt-2 text-slate-600">Isi semua informasi tentang destinasi wisata Anda</p>
        </div>

        <form action="{{ route('operator.destinations.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- Judul & Foto -->
            <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="mb-4 text-xl font-semibold text-slate-900">Informasi Dasar</h2>
                
                <div class="mb-6">
                    <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">Nama/Judul Tempat Wisata *</label>
                    <input type="text" id="name" name="name" placeholder="Contoh: Pantai Bali Utama" class="w-full rounded-lg border border-slate-300 px-4 py-3 text-lg focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200 @error('name') border-red-500 @enderror" required value="{{ old('name') }}">
                    @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div class="mb-6">
                    <label for="image" class="block text-sm font-semibold text-slate-700 mb-2">Foto Utama</label>
                    <div class="relative">
                        <input type="file" id="image" name="image" accept="image/*" class="w-full rounded-lg border-2 border-dashed border-slate-300 px-4 py-6 file:mr-3 file:rounded file:border-0 file:bg-blue-600 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-blue-700 @error('image') border-red-500 @enderror">
                        <p class="mt-2 text-sm text-slate-500">Format: JPG, PNG, GIF, WebP. Maksimal 5MB</p>
                    </div>
                    @error('image')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <!-- Jam Operasional & Harga -->
            <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="mb-4 text-xl font-semibold text-slate-900">Jam Operasional & Harga</h2>
                
                <div class="grid gap-4 md:grid-cols-2 mb-6">
                    <div>
                        <label for="opening_time" class="block text-sm font-semibold text-slate-700 mb-2">Jam Buka *</label>
                        <input type="time" id="opening_time" name="opening_time" class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200 @error('opening_time') border-red-500 @enderror" required value="{{ old('opening_time') }}">
                        @error('opening_time')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="closing_time" class="block text-sm font-semibold text-slate-700 mb-2">Jam Tutup *</label>
                        <input type="time" id="closing_time" name="closing_time" class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200 @error('closing_time') border-red-500 @enderror" required value="{{ old('closing_time') }}">
                        @error('closing_time')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="mb-6">
                    <label for="opening_hours" class="block text-sm font-semibold text-slate-700 mb-2">Jadwal Lengkap (Hari & Catatan) *</label>
                    <input type="text" id="opening_hours" name="opening_hours" placeholder="Contoh: Senin-Minggu 08:00-16:00 WIB, Tutup hari libur nasional" class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200 @error('opening_hours') border-red-500 @enderror" required value="{{ old('opening_hours') }}">
                    @error('opening_hours')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="price" class="block text-sm font-semibold text-slate-700 mb-2">Harga Tiket Masuk (Rp) *</label>
                    <input type="number" id="price" name="price" placeholder="Contoh: 50000" class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200 @error('price') border-red-500 @enderror" required value="{{ old('price') }}" min="1000">
                    @error('price')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <!-- Kontak & Lokasi -->
            <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="mb-4 text-xl font-semibold text-slate-900">Kontak & Lokasi</h2>
                
                <div class="mb-6">
                    <label for="contact_phone" class="block text-sm font-semibold text-slate-700 mb-2">Nomor Telepon *</label>
                    <input type="tel" id="contact_phone" name="contact_phone" placeholder="Contoh: +62 812-3456-7890" class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200 @error('contact_phone') border-red-500 @enderror" required value="{{ old('contact_phone') }}">
                    @error('contact_phone')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="location_maps_url" class="block text-sm font-semibold text-slate-700 mb-2">Link Google Maps *</label>
                    <input type="url" id="location_maps_url" name="location_maps_url" placeholder="https://maps.google.com/?q=..." class="w-full rounded-lg border border-slate-300 px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200 @error('location_maps_url') border-red-500 @enderror" required value="{{ old('location_maps_url') }}">
                    @error('location_maps_url')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="mb-4 text-xl font-semibold text-slate-900">Deskripsi Destinasi</h2>
                
                <div>
                    <label for="description" class="block text-sm font-semibold text-slate-700 mb-2">Deskripsi Lengkap *</label>
                    <textarea id="description" name="description" placeholder="Jelaskan secara detail tentang destinasi wisata Anda, fasilitas, keunikan, dan informasi menarik lainnya..." class="w-full rounded-lg border border-slate-300 px-4 py-3 font-sans focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200 @error('description') border-red-500 @enderror" required rows="8" style="resize: vertical; min-height: 200px;">{{ old('description') }}</textarea>
                    @error('description')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <!-- Sosial Media -->
            <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="mb-4 text-xl font-semibold text-slate-900">Sosial Media (Opsional)</h2>
                <p class="mb-4 text-sm text-slate-600">Tambahkan profil sosial media untuk kemudahan pengunjung menghubungi Anda</p>
                
                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label for="social_instagram" class="block text-sm font-medium text-slate-700 mb-2">Instagram</label>
                        <input type="text" id="social_instagram" name="social_media[instagram]" placeholder="@username atau link profil" class="w-full rounded-lg border border-slate-300 px-4 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" value="{{ old('social_media.instagram') }}">
                    </div>
                    <div>
                        <label for="social_facebook" class="block text-sm font-medium text-slate-700 mb-2">Facebook</label>
                        <input type="text" id="social_facebook" name="social_media[facebook]" placeholder="Nama halaman atau link profil" class="w-full rounded-lg border border-slate-300 px-4 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" value="{{ old('social_media.facebook') }}">
                    </div>
                    <div>
                        <label for="social_twitter" class="block text-sm font-medium text-slate-700 mb-2">Twitter/X</label>
                        <input type="text" id="social_twitter" name="social_media[twitter]" placeholder="@username" class="w-full rounded-lg border border-slate-300 px-4 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" value="{{ old('social_media.twitter') }}">
                    </div>
                    <div>
                        <label for="social_tiktok" class="block text-sm font-medium text-slate-700 mb-2">TikTok</label>
                        <input type="text" id="social_tiktok" name="social_media[tiktok]" placeholder="@username" class="w-full rounded-lg border border-slate-300 px-4 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200" value="{{ old('social_media.tiktok') }}">
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex gap-3 rounded-lg bg-slate-50 p-6">
                <button type="submit" class="rounded-lg bg-blue-600 px-6 py-3 font-semibold text-white hover:bg-blue-700 transition">
                    Simpan Destinasi
                </button>
                <a href="{{ route('operator.destinations.index') }}" class="rounded-lg border border-slate-300 px-6 py-3 font-semibold text-slate-700 hover:bg-slate-100 transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-layouts.app>
