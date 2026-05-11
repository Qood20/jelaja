<x-layouts.app title="Edit User">
    <div class="mx-auto max-w-3xl space-y-6 rounded-3xl bg-white p-6 shadow-sm">
        <div>
            <h1 class="text-2xl font-semibold">Edit User</h1>
            <p class="mt-2 text-sm text-slate-600">Perbarui detail user yang terdaftar.</p>
        </div>

        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')
            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-slate-700">Nama</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-100" required>
                    @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-100" required>
                    @error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-slate-700">Role</label>
                    <select name="role" class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-100" required>
                        <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="operator" {{ old('role', $user->role) === 'operator' ? 'selected' : '' }}>Operator</option>
                        <option value="buyer" {{ old('role', $user->role) === 'buyer' ? 'selected' : '' }}>Pembeli</option>
                    </select>
                    @error('role')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700">Status</label>
                    <select name="status" class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-100" required>
                        <option value="approved" {{ old('status', $user->status) === 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="pending" {{ old('status', $user->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="rejected" {{ old('status', $user->status) === 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                    @error('status')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700">Password Baru (opsional)</label>
                <input type="password" name="password" class="mt-1 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm focus:border-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-100">
                @error('password')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="flex items-center justify-between gap-3">
                <a href="{{ route('admin.users.index') }}" class="rounded-full border border-slate-300 px-5 py-3 text-sm font-medium text-slate-700 hover:bg-slate-100">Batal</a>
                <button type="submit" class="rounded-full bg-blue-700 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-800">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</x-layouts.app>
