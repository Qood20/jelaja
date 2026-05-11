<x-layouts.app title="Scanner QR">
    <h1 class="text-2xl font-semibold">Scanner QR Code</h1>

    <div class="mt-6 grid gap-6 lg:grid-cols-[1.3fr_0.7fr]">
        <div class="rounded-3xl bg-white p-5 shadow-sm">
            <div class="space-y-4">
                <div class="space-y-2">
                    <p class="text-sm text-slate-600">Akses kamera untuk memindai QR Code tiket secara langsung.</p>
                    <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 text-sm text-slate-700">
                        <p class="font-semibold">Catatan:</p>
                        <ul class="mt-1 ml-4 list-disc space-y-1">
                            <li>Pastikan browser mendukung kamera dan izinkan akses saat diminta.</li>
                            <li>Gunakan kamera belakang perangkat jika tersedia.</li>
                        </ul>
                    </div>
                </div>

                <div class="rounded-3xl bg-slate-900 p-4 text-center text-white">
                    <video id="qr-video" class="mx-auto max-h-96 w-full rounded-3xl bg-black" playsinline></video>
                    <canvas id="qr-canvas" class="hidden"></canvas>
                </div>

                <div class="flex flex-wrap items-center gap-3">
                    <button id="start-camera" type="button" class="rounded-full bg-emerald-700 px-4 py-3 text-sm font-semibold text-white hover:bg-emerald-800">Mulai Kamera</button>
                    <button id="stop-camera" type="button" class="rounded-full border border-slate-300 bg-white px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-100" disabled>Hentikan Kamera</button>
                </div>

                <div class="rounded-3xl bg-slate-50 p-4 text-sm text-slate-700">
                    <p class="font-semibold">Status Scan</p>
                    <p id="scan-status" class="mt-2 text-slate-600">Tekan "Mulai Kamera" untuk memulai pemindaian.</p>
                </div>
            </div>
        </div>

        <div class="rounded-3xl bg-white p-5 shadow-sm">
            <form action="{{ route('operator.scanner.verify') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-slate-900">Payload QR</label>
                    <input id="qr_payload" name="qr_payload" class="w-full rounded-2xl border border-slate-300 px-4 py-3 text-slate-900" required>
                </div>
                <button type="submit" class="w-full rounded-2xl bg-blue-700 px-4 py-3 text-sm font-semibold text-white hover:bg-blue-800">Verifikasi Tiket</button>
            </form>

            @if ($errors->any())
                <div class="mt-4 rounded-2xl bg-red-50 p-4 text-sm text-red-700">
                    <ul class="list-disc space-y-1 pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="mt-4 rounded-2xl bg-emerald-50 p-4 text-sm text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.min.js"></script>
    <script>
        const video = document.getElementById('qr-video');
        const canvas = document.getElementById('qr-canvas');
        const statusText = document.getElementById('scan-status');
        const startButton = document.getElementById('start-camera');
        const stopButton = document.getElementById('stop-camera');
        const qrPayloadInput = document.getElementById('qr_payload');
        let stream = null;
        let scanActive = false;

        async function startCamera() {
            if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                statusText.textContent = 'Browser Anda tidak mendukung akses kamera. Gunakan input manual.';
                return;
            }

            try {
                stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } });
                video.srcObject = stream;
                await video.play();
                scanActive = true;
                stopButton.disabled = false;
                startButton.disabled = true;
                statusText.textContent = 'Kamera aktif, menunggu QR Code...';
                scanFrame();
            } catch (error) {
                statusText.textContent = 'Tidak dapat mengakses kamera: ' + (error.message || error);
            }
        }

        function stopCamera() {
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
                stream = null;
            }

            scanActive = false;
            video.pause();
            video.srcObject = null;
            stopButton.disabled = true;
            startButton.disabled = false;
            statusText.textContent = 'Kamera dihentikan. Tekan "Mulai Kamera" untuk memulai lagi.';
        }

        function scanFrame() {
            if (!scanActive) {
                return;
            }

            if (video.readyState === video.HAVE_ENOUGH_DATA) {
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                const context = canvas.getContext('2d');
                context.drawImage(video, 0, 0, canvas.width, canvas.height);
                const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
                const code = jsQR(imageData.data, imageData.width, imageData.height, { inversionAttempts: 'attemptBoth' });

                if (code) {
                    qrPayloadInput.value = code.data;
                    statusText.textContent = 'QR Code terdeteksi, mengisi payload otomatis...';
                    stopCamera();
                    return;
                }
            }

            requestAnimationFrame(scanFrame);
        }

        startButton.addEventListener('click', startCamera);
        stopButton.addEventListener('click', stopCamera);
    </script>
</x-layouts.app>
