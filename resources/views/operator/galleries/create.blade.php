<x-layouts.app title="Tambah Foto Galeri - {{ $destination->name }}">
    <div class="space-y-6">
        <div>
            <h1 class="text-2xl font-semibold">Tambah Foto Galeri</h1>
            <p class="mt-1 text-sm text-slate-600">Destinasi: {{ $destination->name }}</p>
        </div>

        <div class="rounded-xl border bg-white p-6">
            <form action="{{ route('operator.galleries.store', $destination) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div>
                    <label for="photo" class="block text-sm font-medium text-slate-700">Pilih Foto</label>
                    <input 
                        type="file" 
                        id="photo"
                        name="photo" 
                        accept="image/*"
                        class="mt-1 block w-full rounded border border-slate-300 px-3 py-2 file:mr-3 file:rounded file:border-0 file:bg-blue-100 file:px-3 file:py-2 file:text-sm file:font-semibold file:text-blue-700 hover:file:bg-blue-200 @error('photo') border-red-500 @enderror" 
                        required
                    >
                    @error('photo')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-sm text-slate-500">Format yang didukung: JPG, PNG, GIF, WebP. Ukuran maksimal: 5MB</p>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="rounded bg-blue-700 px-6 py-2 text-white hover:bg-blue-800">
                        Unggah Foto
                    </button>
                    <a href="{{ route('operator.galleries.index', $destination) }}" class="rounded border border-slate-300 px-6 py-2 text-slate-700 hover:bg-slate-50">
                        Batal
                    </a>
                </div>
            </form>
        </div>

        <div class="rounded-lg border border-blue-200 bg-blue-50 p-4">
            <h3 class="font-semibold text-blue-900">💡 Tips</h3>
            <ul class="mt-2 list-inside list-disc space-y-1 text-sm text-blue-800">
                <li>Gunakan foto berkualitas tinggi untuk pengalaman pengguna terbaik</li>
                <li>Ukuran foto sebaiknya 16:9 atau square untuk tampilan optimal</li>
                <li>Pastikan foto jelas dan menarik untuk meningkatkan minat pembeli</li>
            </ul>
        </div>
    </div>
</x-layouts.app>
