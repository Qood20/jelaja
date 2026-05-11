<x-layouts.app title="Transaksi Saya">
    <h1 class="text-2xl font-semibold">Riwayat Transaksi</h1>
    <div class="mt-4 overflow-x-auto rounded-xl border bg-white">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-100">
                <tr>
                    <th class="px-3 py-2">Order ID</th>
                    <th class="px-3 py-2">Destinasi</th>
                    <th class="px-3 py-2">Status</th>
                    <th class="px-3 py-2">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $trx)
                    <tr class="border-t">
                        <td class="px-3 py-2">{{ $trx->order_id }}</td>
                        <td class="px-3 py-2">{{ $trx->destination->name }}</td>
                        <td class="px-3 py-2">{{ strtoupper($trx->status) }}</td>
                        <td class="px-3 py-2">Rp{{ number_format($trx->gross_amount, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $transactions->links() }}</div>
</x-layouts.app>
