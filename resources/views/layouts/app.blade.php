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
    @endif
</head>
<body class="min-h-screen bg-slate-50 text-slate-800">
    <nav class="border-b bg-white">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-3">
            <a href="{{ route('landing') }}" class="font-bold text-blue-700">Jelaja</a>
            <div class="flex items-center gap-2 text-sm">
                <a href="{{ route('dashboard.redirect') }}" class="rounded px-3 py-2 hover:bg-slate-100">Dashboard</a>
                <a href="{{ route('landing') }}#kontak" class="rounded px-3 py-2 hover:bg-slate-100">Kontak</a>
                @auth
                    @if(auth()->user()->role === 'buyer')
                        <a href="{{ route('buyer.tickets.index') }}" class="rounded px-3 py-2 hover:bg-slate-100">Tiket Saya</a>
                        <a href="{{ route('buyer.transactions.index') }}" class="rounded px-3 py-2 hover:bg-slate-100">Riwayat</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button class="ml-2 rounded bg-slate-900 px-3 py-2 text-white transition hover:bg-slate-800">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="rounded px-3 py-2 hover:bg-slate-100">Login</a>
                    <a href="{{ route('register') }}" class="rounded bg-blue-700 px-3 py-2 text-white transition hover:bg-blue-800">Register</a>
                @endauth
            </div>
        </div>
    </nav>
    <main class="mx-auto max-w-7xl px-4 py-6">
        @if (session('success'))
            <div class="mb-4 rounded border border-emerald-200 bg-emerald-50 p-3 text-sm text-emerald-700">{{ session('success') }}</div>
        @endif
        {{ $slot }}
    </main>
</body>
</html>
