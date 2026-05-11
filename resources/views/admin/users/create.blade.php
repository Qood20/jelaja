<x-layouts.app title="Tambah User">
    <div class="mx-auto max-w-3xl space-y-6 rounded-3xl bg-white p-6 shadow-sm">
        <div>
            <h1 class="text-2xl font-semibold">Tambah User Baru</h1>
            <p class="mt-2 text-sm text-slate-600">Buat akun untuk admin, operator, atau pembeli.</p>
        </div>

        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-5">
            @csrf
            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-slate-700">Nama</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-100" required>
                    @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-100" required>
                    @error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-slate-700">Role</label>
                    <select name="role" class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-100" required>
                        <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="operator" {{ old('role') === 'operator' ? 'selected' : '' }}>Operator</option>
                        <option value="buyer" {{ old('role') === 'buyer' ? 'selected' : '' }}>Pembeli</option>
                    </select>
                    @error('role')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700">Status</label>
                    <select name="status" class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-100" required>
                        <option value="approved" {{ old('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="rejected" {{ old('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                    @error('status')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700">Password</label>
                <input type="password" name="password" class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-100" required>
                @error('password')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="flex items-center justify-between gap-3">
                <a href="{{ route('admin.users.index') }}" class="rounded-full border border-slate-300 px-5 py-3 text-sm font-medium text-slate-700 hover:bg-slate-100">Batal</a>
                <button type="submit" class="rounded-full bg-blue-700 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-800">Tambah User</button>
            </div>
        </form>
    </div>
</x-layouts.app>
