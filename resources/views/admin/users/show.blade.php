<x-layouts.app title="Detail User">
    <div class="mx-auto max-w-3xl rounded-3xl bg-white p-6 shadow-sm">
        <h1 class="text-2xl font-semibold">Detail User</h1>
        <div class="mt-6 grid gap-4 rounded-3xl border border-slate-200 bg-slate-50 p-6 text-sm text-slate-700 md:grid-cols-2">
            <div>
                <p class="font-semibold text-slate-900">Nama</p>
                <p>{{ $user->name }}</p>
            </div>
            <div>
                <p class="font-semibold text-slate-900">Email</p>
                <p>{{ $user->email }}</p>
            </div>
            <div>
                <p class="font-semibold text-slate-900">Role</p>
                <p>{{ ucfirst($user->role) }}</p>
            </div>
            <div>
                <p class="font-semibold text-slate-900">Status</p>
                <p>{{ ucfirst($user->status) }}</p>
            </div>
            <div>
                <p class="font-semibold text-slate-900">Dibuat Pada</p>
                <p>{{ $user->created_at->format('d M Y H:i') }}</p>
            </div>
            <div>
                <p class="font-semibold text-slate-900">Terakhir Diperbarui</p>
                <p>{{ $user->updated_at->format('d M Y H:i') }}</p>
            </div>
        </div>
        <div class="mt-6 flex flex-wrap gap-3">
            <a href="{{ route('admin.users.edit', $user) }}" class="rounded-full bg-blue-700 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-800">Edit User</a>
            <a href="{{ route('admin.users.index') }}" class="rounded-full border border-slate-300 px-5 py-3 text-sm font-medium text-slate-700 hover:bg-slate-100">Kembali</a>
        </div>
    </div>
</x-layouts.app>
