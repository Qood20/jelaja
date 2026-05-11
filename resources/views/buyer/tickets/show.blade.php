<x-layouts.app title="Tiket {{ $transaction->destination->name }}">
    <div class="mx-auto max-w-4xl space-y-6">
        <!-- Header -->
        <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-slate-900">Tiket Wisata</h1>
                    <p class="mt-1 text-sm text-slate-500">Tunjukkan QR code ini kepada petugas di lokasi.</p>
                </div>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('buyer.tickets.index') }}" class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50 transition">
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-[1fr_1.5fr]">
            <!-- Sidebar: Info -->
            <div class="space-y-6">
                <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <h2 class="text-lg font-bold text-slate-900">Informasi Kunjungan</h2>
                    <div class="mt-4 space-y-4">
                        <div>
                            <p class="text-xs font-medium uppercase tracking-wider text-slate-400">Destinasi</p>
                            <p class="mt-1 font-semibold text-slate-900">{{ $transaction->destination->name }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-medium uppercase tracking-wider text-slate-400">Tanggal Kunjungan</p>
                            <p class="mt-1 font-semibold text-slate-900">{{ $transaction->visit_date->format('d M Y') }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-medium uppercase tracking-wider text-slate-400">Order ID</p>
                            <p class="mt-1 font-mono text-xs text-slate-900">{{ $transaction->order_id }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-medium uppercase tracking-wider text-slate-400">Jumlah Tiket</p>
                            <p class="mt-1 font-semibold text-slate-900">{{ $transaction->quantity }} Orang</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main: QR Codes -->
            <div class="space-y-4">
                @foreach($transaction->tickets as $index => $t)
                    <div class="relative overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-slate-200">
                        <div class="flex flex-col sm:flex-row items-center gap-6 p-6">
                            <!-- QR Code Container -->
                            <div class="relative group shrink-0 rounded-2xl bg-slate-50 p-3 ring-1 ring-slate-100 cursor-zoom-in" 
                                 onclick="openZoomModal('{{ $t->qr_code_payload }}', 'Tiket #{{ $index + 1 }}')">
                                {!! QrCode::size(140)->generate($t->qr_code_payload) !!}
                                <div class="absolute inset-0 flex items-center justify-center bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity rounded-2xl">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="white" class="h-8 w-8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607ZM10.5 7.5v6m3-3h-6" />
                                    </svg>
                                </div>
                            </div>
                            
                            <!-- Ticket Info -->
                            <div class="flex-1 w-full text-center sm:text-left">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <h3 class="font-bold text-slate-900 text-xl tracking-tight">Tiket #{{ $index + 1 }}</h3>
                                        <span class="rounded-lg bg-blue-100 px-2 py-0.5 text-[10px] font-bold text-blue-700 uppercase tracking-widest">{{ substr($t->qr_code_payload, -4) }}</span>
                                    </div>
                                    <span class="rounded-full px-3 py-1 text-[10px] font-bold uppercase tracking-wider {{ $t->status === 'available' ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-600' }}">
                                        {{ $t->status === 'available' ? 'Tersedia' : 'Digunakan' }}
                                    </span>
                                </div>
                                <p class="mt-1 text-xs text-slate-400 font-mono overflow-hidden text-ellipsis">{{ $t->qr_code_payload }}</p>
                                
                                <div class="mt-5 flex flex-wrap justify-center sm:justify-start gap-4">
                                    <button onclick="openZoomModal('{{ $t->qr_code_payload }}', 'Tiket #{{ $index + 1 }}')" class="inline-flex items-center gap-2 text-sm font-bold text-blue-600 hover:text-blue-800 transition">
                                        Perbesar QR
                                    </button>
                                    <a href="{{ route('buyer.tickets.download', $t) }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-600 hover:text-slate-900 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-4 w-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M7.5 12 12 16.5m0 0L16.5 12M12 16.5V3" />
                                        </svg>
                                        Unduh PDF
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Zoom Modal -->
    <div id="zoom-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/90 backdrop-blur-sm p-4 transition-all duration-300 opacity-0" onclick="closeZoomModal()">
        <div class="relative max-w-sm w-full rounded-[2.5rem] bg-white p-8 shadow-2xl transition-transform duration-300 scale-90" onclick="event.stopPropagation()">
            <button class="absolute -top-12 right-0 text-white hover:text-slate-300 transition" onclick="closeZoomModal()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="h-8 w-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
            <div class="text-center">
                <h3 id="modal-ticket-title" class="text-xl font-bold text-slate-900">Tiket</h3>
                <p class="text-sm text-slate-500 mt-1">Scan QR code ini di gerbang masuk</p>
                <div id="modal-qr-container" class="mt-8 flex justify-center p-4 bg-slate-50 rounded-3xl ring-1 ring-slate-100">
                    <!-- QR code will be injected here -->
                </div>
                <button class="mt-8 w-full rounded-2xl bg-slate-900 py-4 font-bold text-white transition hover:bg-slate-800" onclick="closeZoomModal()">
                    Tutup
                </button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/qrcode-generator@1.4.4/qrcode.min.js"></script>
    <script>
        function openZoomModal(payload, title) {
            const modal = document.getElementById('zoom-modal');
            const modalContent = modal.querySelector('div');
            const titleElem = document.getElementById('modal-ticket-title');
            const qrContainer = document.getElementById('modal-qr-container');

            titleElem.innerText = title;
            
            // Generate QR using library (to avoid round trip to server)
            const typeNumber = 4;
            const errorCorrectionLevel = 'L';
            const qr = qrcode(typeNumber, errorCorrectionLevel);
            qr.addData(payload);
            qr.make();
            qrContainer.innerHTML = qr.createSvgTag({cellSize: 8, margin: 0});
            
            // Adjust SVG to be responsive
            const svg = qrContainer.querySelector('svg');
            svg.setAttribute('width', '100%');
            svg.setAttribute('height', 'auto');
            svg.classList.add('rounded-xl');

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            // Animation trigger
            setTimeout(() => {
                modal.classList.add('opacity-100');
                modalContent.classList.remove('scale-90');
                modalContent.classList.add('scale-100');
            }, 10);
        }

        function closeZoomModal() {
            const modal = document.getElementById('zoom-modal');
            const modalContent = modal.querySelector('div');
            
            modal.classList.remove('opacity-100');
            modalContent.classList.remove('scale-100');
            modalContent.classList.add('scale-90');
            
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, 300);
        }
    </script>
</x-layouts.app>
