<x-layouts.app title="Register - Jelaja">
    <div class="mx-auto max-w-md rounded-xl border bg-white p-6">
        <h1 class="text-xl font-semibold">Register</h1>
        <form action="{{ route('register.store') }}" method="POST" class="mt-4 space-y-4">
            @csrf
            <input type="text" name="name" placeholder="Nama lengkap" class="w-full rounded border px-3 py-2" required>
            <input type="email" name="email" placeholder="Email" class="w-full rounded border px-3 py-2" required>
            <select name="role" class="w-full rounded border px-3 py-2" required>
                <option value="buyer">Pembeli</option>
                <option value="operator">Operator Wisata</option>
            </select>
            <input type="password" name="password" placeholder="Password" class="w-full rounded border px-3 py-2" required>
            <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" class="w-full rounded border px-3 py-2" required>
            <button class="w-full rounded bg-blue-700 px-4 py-2 text-white">Daftar</button>
        </form>
        <div class="mt-4 text-center text-sm text-slate-600">
            Sudah punya akun? <a href="{{ route('login') }}" class="font-medium text-blue-700 hover:text-blue-800">Login di sini</a>
        </div>
    </div>
</x-layouts.app>
