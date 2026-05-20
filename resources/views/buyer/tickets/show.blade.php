<x-layouts.app title="Tiket {{ $transaction->destination->name }}">
    <div class="mx-auto max-w-4xl space-y-6">
        <!-- Header -->
        <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Tiket Wisata</h1>
                <p class="mt-1 text-sm text-slate-500">Tunjukkan QR code ini kepada petugas di lokasi.</p>
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
                            <div class="relative group shrink-0 rounded-2xl bg-slate-50 p-3 ring-1 ring-slate-100 cursor-zoom-in" 
                                 onclick="openZoomModal('{{ $t->qr_code_payload }}', 'Tiket #{{ $index + 1 }}')">
                                {!! QrCode::size(140)->generate($t->qr_code_payload) !!}
                            </div>
                            
                            <div class="flex-1 w-full text-center sm:text-left">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <h3 class="font-bold text-slate-900 text-xl tracking-tight">Tiket #{{ $index + 1 }}</h3>
                                    </div>
                                    <span id="status-{{ $t->id }}" class="rounded-full px-3 py-1 text-[10px] font-bold uppercase tracking-wider {{ $t->status === 'available' ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-600' }}">
                                        {{ $t->status === 'available' ? 'Tersedia' : 'Digunakan' }}
                                    </span>
                                </div>
                                <p class="mt-1 text-xs text-slate-400 font-mono">{{ $t->qr_code_payload }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Zoom Modal -->
    <div id="zoom-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/90 backdrop-blur-sm p-4 opacity-0 transition-opacity duration-300" onclick="closeZoomModal()">
        <div class="relative max-w-sm w-full rounded-[2.5rem] bg-white p-8 shadow-2xl scale-90 transition-transform duration-300" onclick="event.stopPropagation()">
            <div class="text-center">
                <h3 id="modal-ticket-title" class="text-xl font-bold text-slate-900">Tiket</h3>
                <div id="modal-qr-container" class="mt-8 flex justify-center p-4 bg-slate-50 rounded-3xl ring-1 ring-slate-100"></div>
                <button class="mt-8 w-full rounded-2xl bg-slate-900 py-4 font-bold text-white" onclick="closeZoomModal()">Tutup</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode-generator@1.4.4/qrcode.min.js"></script>
    <script>
        function openZoomModal(payload, title) {
            const modal = document.getElementById('zoom-modal');
            const modalContent = modal.querySelector('div');
            document.getElementById('modal-ticket-title').innerText = title;
            const qr = qrcode(4, 'L');
            qr.addData(payload);
            qr.make();
            document.getElementById('modal-qr-container').innerHTML = qr.createSvgTag({cellSize: 8, margin: 0});
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            setTimeout(() => { modal.classList.add('opacity-100'); modalContent.classList.remove('scale-90'); modalContent.classList.add('scale-100'); }, 10);
        }

        function closeZoomModal() {
            const modal = document.getElementById('zoom-modal');
            const modalContent = modal.querySelector('div');
            modal.classList.remove('opacity-100');
            modalContent.classList.remove('scale-100');
            modalContent.classList.add('scale-90');
            setTimeout(() => { modal.classList.add('hidden'); modal.classList.remove('flex'); }, 300);
        }

        // --- POLLING LOGIC ---
        let previousStatuses = {
            @foreach($transaction->tickets as $t)
                '{{ $t->id }}': '{{ $t->status }}',
            @endforeach
        };

        function checkStatuses() {
            // GUNAKAN PATH RELATIF: Ini paling aman untuk ngrok dan hosting
            const relativeUrl = '/tickets/transaction/{{ $transaction->id }}/check-status';
            
            fetch(relativeUrl)
                .then(response => {
                    if (!response.ok) throw new Error('Request gagal');
                    return response.json();
                })
                .then(data => {
                    let hasNewUsed = false;
                    data.tickets.forEach(ticket => {
                        if (previousStatuses[ticket.id] === 'available' && ticket.status === 'used') {
                            hasNewUsed = true;
                            const badge = document.getElementById(`status-${ticket.id}`);
                            if (badge) {
                                badge.className = 'rounded-full px-3 py-1 text-[10px] font-bold uppercase tracking-wider bg-slate-100 text-slate-600';
                                badge.innerText = 'Digunakan';
                            }
                        }
                        previousStatuses[ticket.id] = ticket.status;
                    });

                    if (hasNewUsed) {
                        Swal.fire({
                            icon: 'success',
                            title: 'BERHASIL!',
                            text: 'Tiket telah di-scan oleh petugas.',
                            timer: 5000,
                            confirmButtonText: 'Mantap!',
                            customClass: { popup: 'rounded-3xl' }
                        });
                    }
                })
                .catch(err => console.error('Gagal mengecek status:', err));
        }

        setInterval(checkStatuses, 2000);
    </script>
</x-layouts.app>
