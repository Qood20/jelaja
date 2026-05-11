<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Jelaja' }}</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @endif
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">
    <div x-data="{ menuOpen: false, profileOpen: false }" class="min-h-screen">
        <header class="sticky top-0 z-40 border-b border-slate-200 bg-white/95 backdrop-blur-lg">
            <div class="mx-auto flex max-w-7xl flex-wrap items-center justify-between gap-3 px-4 py-3">
                <a href="{{ route('landing') }}" class="flex items-center gap-3">
                    <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-blue-700 text-white shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-6 w-6">
                            <path fill="currentColor" d="M4 18c.5 0 1-.2 1.4-.6l12.5-12.5 2.1 2.1L7.6 19.5c-.4.4-.9.5-1.4.5H4v-2zm15.3-12.6l-1.6 1.6 2.1 2.1 1.6-1.6a1 1 0 0 0 0-1.4l-1.5-1.5a1 1 0 0 0-1.4 0zm-2.9 5.3l-6 6L7 14.4l6-6 2.4 2.4z"/>
                        </svg>
                    </span>
                    <span class="text-xl font-bold tracking-tight text-slate-900">Jelaja</span>
                </a>

                <div class="hidden items-center gap-3 text-sm md:flex">
                    <a href="{{ route('landing') }}" class="rounded-full px-3 py-2 font-medium text-slate-700 transition hover:bg-slate-100">Beranda</a>
                    <a href="{{ route('contact') }}" class="rounded-full px-3 py-2 font-medium text-slate-700 transition hover:bg-slate-100">Kontak</a>
                    @auth
                        <a href="{{ route('dashboard.redirect') }}" class="rounded-full px-3 py-2 font-medium text-slate-700 transition hover:bg-slate-100">Panel</a>
                    @endauth
                </div>

                <div class="flex items-center gap-2">
                    @auth
                        <div class="relative">
                            <button type="button" @click="profileOpen = !profileOpen" class="flex items-center gap-2 rounded-full border border-slate-200 bg-slate-50 px-3 py-2 text-sm font-medium text-slate-700 shadow-sm transition hover:bg-slate-100">
                                @if (auth()->user()->profile_photo_url)
                                    <img src="{{ auth()->user()->getProfilePhotoUrl() }}" alt="Foto Profil" class="h-9 w-9 rounded-full object-cover">
                                @else
                                    <span class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-600 text-xs font-bold uppercase text-white">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </span>
                                @endif
                                <span>{{ auth()->user()->name }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M6 9l6 6 6-6" />
                                </svg>
                            </button>
                            <div x-show="profileOpen" x-cloak @click.outside="profileOpen = false" class="absolute right-0 mt-2 w-48 rounded-3xl border border-slate-200 bg-white p-2 shadow-xl">
                                <a href="{{ route('profile.edit') }}" class="block rounded-2xl px-4 py-2 text-sm text-slate-700 hover:bg-slate-100">Edit Profil</a>
                                <form action="{{ route('logout') }}" method="POST" class="mt-1">
                                    @csrf
                                    <button type="submit" class="w-full rounded-2xl px-4 py-2 text-left text-sm text-slate-700 hover:bg-slate-100">Logout</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="hidden rounded-full px-4 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-100 md:inline">Login</a>
                        <a href="{{ route('register') }}" class="hidden rounded-full bg-blue-700 px-4 py-2 text-sm font-medium text-white transition hover:bg-blue-800 md:inline">Register</a>
                    @endauth

                    <button type="button" @click="menuOpen = !menuOpen" class="inline-flex h-11 w-11 items-center justify-center rounded-2xl border border-slate-200 bg-white text-slate-700 shadow-sm md:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 7h16M4 12h16M4 17h16" />
                        </svg>
                    </button>
                </div>
            </div>

            <div x-show="menuOpen" x-cloak class="border-t border-slate-200 bg-slate-50 px-4 py-4 md:hidden">
                <a href="{{ route('landing') }}" class="block rounded-3xl px-4 py-3 text-sm text-slate-700 hover:bg-white">Beranda</a>
                <a href="{{ route('contact') }}" class="mt-2 block rounded-3xl px-4 py-3 text-sm text-slate-700 hover:bg-white">Kontak</a>
                @auth
                    <a href="{{ route('dashboard.redirect') }}" class="mt-2 block rounded-3xl px-4 py-3 text-sm text-slate-700 hover:bg-white">Panel</a>
                    <a href="{{ route('profile.edit') }}" class="mt-2 block rounded-3xl px-4 py-3 text-sm text-slate-700 hover:bg-white">Edit Profil</a>
                    <form action="{{ route('logout') }}" method="POST" class="mt-2">
                        @csrf
                        <button type="submit" class="w-full rounded-3xl bg-slate-900 px-4 py-3 text-sm font-medium text-white">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="mt-2 block rounded-3xl px-4 py-3 text-sm text-slate-700 hover:bg-white">Login</a>
                    <a href="{{ route('register') }}" class="mt-2 block rounded-3xl bg-blue-700 px-4 py-3 text-sm font-medium text-white">Register</a>
                @endauth
            </div>
        </header>

        <div class="sticky top-[72px] z-30 border-b border-slate-200 bg-slate-50/90 backdrop-blur-sm">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 sm:px-6">
                @php
                    $hideBack = in_array(Route::currentRouteName(), ['buyer.dashboard', 'operator.dashboard', 'admin.dashboard', 'dashboard.redirect']);
                @endphp
                @unless ($hideBack)
                    <button type="button" onclick="window.history.back()" class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 shadow-sm transition hover:bg-slate-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M15 18l-6-6 6-6" />
                        </svg>
                        Kembali
                    </button>
                @endunless
                <p class="hidden text-sm text-slate-600 sm:block">Mulai perjalanan wisata Anda dengan akses cepat.</p>
            </div>
        </div>

        <main class="mx-auto max-w-7xl px-4 py-8 pb-20 sm:px-6 md:pb-8">
            @if (session('success'))
                <div class="mb-6 rounded-3xl border border-emerald-200 bg-emerald-50 p-4 text-sm font-medium text-emerald-700 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="mb-6 rounded-3xl border border-red-200 bg-red-50 p-4 text-sm text-red-700 shadow-sm">
                    <ul class="space-y-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{ $slot }}
        </main>

        <footer class="border-t border-slate-200 bg-slate-900 text-white">
            <div class="mx-auto max-w-7xl px-4 py-12">
                <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="flex h-10 w-10 items-center justify-center rounded-2xl bg-blue-600">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-5 w-5 fill-white">
                                    <path d="M4 18c.5 0 1-.2 1.4-.6l12.5-12.5 2.1 2.1L7.6 19.5c-.4.4-.9.5-1.4.5H4v-2zm15.3-12.6l-1.6 1.6 2.1 2.1 1.6-1.6a1 1 0 0 0 0-1.4l-1.5-1.5a1 1 0 0 0-1.4 0zm-2.9 5.3l-6 6L7 14.4l6-6 2.4 2.4z"/>
                                </svg>
                            </span>
                            <span class="text-lg font-bold">Jelaja</span>
                        </div>
                        <p class="mt-2 text-sm text-slate-400">Marketplace Tiket Wisata Online Indonesia</p>
                    </div>
                    <div>
                        <h3 class="font-semibold">Menu</h3>
                        <ul class="mt-4 space-y-2 text-sm text-slate-400">
                            <li><a href="{{ route('landing') }}" class="hover:text-white">Beranda</a></li>
                            <li><a href="{{ route('contact') }}" class="hover:text-white">Kontak</a></li>
                            @auth
                                <li><a href="{{ route('dashboard.redirect') }}" class="hover:text-white">Dashboard</a></li>
                            @endauth
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-semibold">Kontak</h3>
                        <ul class="mt-4 space-y-2 text-sm text-slate-400">
                            <li>Email: support@jelaja.com</li>
                            <li>Telepon: +62 812-3456-7890</li>
                            <li class="pt-2">
                                <span class="text-xs font-medium">Ikuti Kami:</span>
                                <div class="mt-2 flex gap-3">
                                    <a href="#" class="hover:text-blue-400">Facebook</a>
                                    <a href="#" class="hover:text-blue-400">Twitter</a>
                                    <a href="#" class="hover:text-pink-400">Instagram</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="mt-8 border-t border-slate-700 pt-6 text-center text-sm text-slate-500">
                    <p>&copy; {{ now()->year }} Jelaja. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
