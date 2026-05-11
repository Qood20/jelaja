<x-layouts.app title="Edit Profil">
    <div class="mx-auto max-w-3xl space-y-6">
        <!-- Profile Information -->
        <div class="rounded-3xl bg-white p-8 shadow-sm border border-slate-100">
            <h1 class="text-2xl font-bold text-slate-900">Pengaturan Profil</h1>
            <p class="mt-2 text-slate-500">Perbarui informasi dasar dan foto profil Anda.</p>

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="mt-8 space-y-6">
                @csrf
                @method('PUT')

                <!-- Photo Upload Section -->
                <div class="flex flex-col items-center gap-6 sm:flex-row">
                    <div class="relative group">
                        <div class="h-24 w-24 overflow-hidden rounded-3xl border-4 border-slate-50 shadow-sm ring-1 ring-slate-200">
                            @if ($user->profile_photo_url)
                                <img id="photo-preview" src="{{ $user->getProfilePhotoUrl() }}" alt="Foto Profil" class="h-full w-full object-cover">
                            @else
                                <div id="photo-placeholder" class="flex h-full w-full items-center justify-center bg-blue-600 text-2xl font-bold text-white">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <img id="photo-preview" src="" alt="Preview" class="hidden h-full w-full object-cover">
                            @endif
                        </div>
                        <label for="profile_photo" class="absolute -bottom-2 -right-2 flex h-10 w-10 cursor-pointer items-center justify-center rounded-2xl bg-white text-slate-600 shadow-lg border border-slate-100 transition hover:bg-slate-50 hover:text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/>
                            </svg>
                            <input type="file" id="profile_photo" name="profile_photo" class="hidden" accept="image/*" onchange="previewImage(this)">
                        </label>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-sm font-semibold text-slate-900">Foto Profil</h3>
                        <p class="text-xs text-slate-500 mt-1">Format JPG, JPEG, atau PNG. Maksimal 2MB.</p>
                        @error('profile_photo')<p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-blue-600 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-50 transition-all" required>
                        @error('name')<p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-blue-600 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-50 transition-all" required>
                        @error('email')<p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="rounded-full bg-blue-700 px-8 py-3 text-sm font-bold text-white shadow-lg shadow-blue-200 transition hover:bg-blue-800 hover:shadow-blue-300 active:scale-95">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <!-- Security Section -->
        <div x-data="{ showPasswordForm: false }" class="rounded-3xl bg-white p-8 shadow-sm border border-slate-100">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-slate-900">Keamanan</h2>
                    <p class="mt-1 text-sm text-slate-500">Kelola kata sandi akun Anda.</p>
                </div>
                <button type="button" @click="showPasswordForm = !showPasswordForm" 
                    class="rounded-full border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 active:bg-slate-100">
                    <span x-text="showPasswordForm ? 'Batalkan' : 'Ubah Kata Sandi'"></span>
                </button>
            </div>

            <div x-show="showPasswordForm" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="mt-8">
                <form action="{{ route('profile.password.update') }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-semibold text-slate-700">Kata Sandi Saat Ini</label>
                        <input type="password" name="current_password" class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-blue-600 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-50 transition-all" required>
                        @error('current_password')<p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>@enderror
                    </div>

                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700">Kata Sandi Baru</label>
                            <input type="password" name="password" class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-blue-600 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-50 transition-all" required>
                            @error('password')<p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700">Konfirmasi Kata Sandi Baru</label>
                            <input type="password" name="password_confirmation" class="mt-2 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm focus:border-blue-600 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-50 transition-all" required>
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="rounded-full bg-slate-900 px-8 py-3 text-sm font-bold text-white shadow-lg transition hover:bg-slate-800 active:scale-95">
                            Perbarui Kata Sandi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('photo-preview');
            const placeholder = document.getElementById('photo-placeholder');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    if (placeholder) placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-layouts.app>
