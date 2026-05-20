<x-layouts.app title="Konfirmasi Pembelian">
    <div class="mx-auto max-w-2xl space-y-6">
        <div class="rounded-3xl bg-white p-6 shadow-sm">
            <h1 class="text-2xl font-semibold text-slate-900">Konfirmasi Pembelian</h1>
            <p class="mt-2 text-sm text-slate-600">Pastikan detail pesanan Anda sudah benar sebelum melanjutkan pembayaran.</p>
        </div>

        <div class="rounded-3xl bg-white p-6 shadow-sm">
            <h2 class="text-lg font-semibold text-slate-900">{{ $destination->name }}</h2>
            <div class="mt-4 space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-slate-600">Tanggal Kunjungan:</span>
                    <span class="font-medium">{{ \Carbon\Carbon::parse($visit_date)->format('d M Y') }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-600">Jumlah Tiket:</span>
                    <span class="font-medium">{{ $quantity }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-600">Harga per Tiket:</span>
                    <span class="font-medium">Rp{{ number_format($destination->price, 0, ',', '.') }}</span>
                </div>
                <hr class="border-slate-200">
                <div class="flex justify-between text-base font-semibold">
                    <span>Total:</span>
                    <span>Rp{{ number_format($total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <div class="rounded-3xl bg-amber-50 p-6 text-sm text-amber-800">
            <p class="font-medium">Informasi Penting:</p>
            <ul class="mt-2 space-y-1">
                <li>• Setelah pembayaran berhasil, tiket QR Code akan muncul di menu "Tiket Saya".</li>
                <li>• Pastikan tanggal kunjungan sesuai dengan jadwal Anda.</li>
                <li>• Pembayaran diproses oleh Midtrans dengan aman.</li>
            </ul>
        </div>

        <form action="{{ route('buyer.checkout.confirm', $destination) }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="visit_date" value="{{ $visit_date }}">
            <input type="hidden" name="quantity" value="{{ $quantity }}">
            <div class="flex gap-3">
                <button type="submit" class="w-full rounded-xl bg-blue-700 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-800">Bayar Sekarang</button>
            </div>
        </form>
    </div>
</x-layouts.app>