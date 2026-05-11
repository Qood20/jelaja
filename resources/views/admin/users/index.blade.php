<x-layouts.app title="Manajemen User">
    <div class="flex flex-col gap-6">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl font-semibold">Manajemen User</h1>
                <p class="mt-2 text-sm text-slate-600">Tambahkan, edit, lihat, atau hapus user dari sistem Jelaja.</p>
            </div>
            <a href="{{ route('admin.users.create') }}" class="inline-flex items-center justify-center rounded-full bg-blue-700 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-800">Tambah User</a>
        </div>

        <div class="overflow-x-auto rounded-3xl border bg-white shadow-sm">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-100">
                    <tr>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Role</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr class="border-t hover:bg-slate-50">
                            <td class="px-4 py-3">{{ $user->name }}</td>
                            <td class="px-4 py-3">{{ $user->email }}</td>
                            <td class="px-4 py-3">{{ ucfirst($user->role) }}</td>
                            <td class="px-4 py-3">{{ ucfirst($user->status) }}</td>
                            <td class="px-4 py-3 space-x-2">
                                <a href="{{ route('admin.users.show', $user) }}" class="rounded-full border border-slate-300 px-3 py-2 text-xs font-medium text-slate-700 hover:bg-slate-100">Lihat</a>
                                <a href="{{ route('admin.users.edit', $user) }}" class="rounded-full border border-blue-700 px-3 py-2 text-xs font-medium text-blue-700 hover:bg-blue-50">Edit</a>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus user ini?');" class="rounded-full border border-red-600 px-3 py-2 text-xs font-medium text-red-600 hover:bg-red-50">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-sm text-slate-500">Belum ada user terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $users->links() }}</div>
    </div>
</x-layouts.app>
