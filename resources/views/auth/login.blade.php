<x-layouts.app title="Login - Jelaja">
    <div class="mx-auto max-w-md rounded-xl border bg-white p-6">
        <h1 class="text-xl font-semibold">Login</h1>
        <form action="{{ route('login.attempt') }}" method="POST" class="mt-4 space-y-4">
            @csrf
            <input type="email" name="email" placeholder="Email" class="w-full rounded border px-3 py-2" required>
            <input type="password" name="password" placeholder="Password" class="w-full rounded border px-3 py-2" required>
            <button class="w-full rounded bg-blue-700 px-4 py-2 text-white">Masuk</button>
        </form>
        <div class="mt-4 text-center text-sm text-slate-600">
            Belum punya akun? <a href="{{ route('register') }}" class="font-medium text-blue-700 hover:text-blue-800">Register di sini</a>
        </div>
    </div>
</x-layouts.app>
