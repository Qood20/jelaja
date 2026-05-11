<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket {{ $ticket->destination->name }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #111827; margin: 0; padding: 0; }
        .container { padding: 24px; }
        .card { border-radius: 24px; border: 1px solid #e2e8f0; padding: 24px; }
        .header { margin-bottom: 28px; }
        .header h1 { font-size: 28px; margin: 0 0 8px; }
        .header p { margin: 0; color: #475569; }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; margin-top: 24px; }
        .field { background: #f8fafc; border-radius: 18px; padding: 16px; }
        .field label { display: block; font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 8px; }
        .field span { display: block; font-size: 16px; color: #0f172a; }
        .qr { margin-top: 28px; text-align: center; }
        .qr svg { max-width: 100%; height: auto; }
        .footer { margin-top: 32px; font-size: 12px; color: #475569; }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="header">
                <h1>Tiket Digital Jelaja</h1>
                <p>Gunakan QR code ini untuk masuk ke destinasi wisata.</p>
            </div>

            <div class="grid">
                <div class="field">
                    <label>Destinasi</label>
                    <span>{{ $ticket->destination->name }}</span>
                </div>
                <div class="field">
                    <label>Tanggal Kunjungan</label>
                    <span>{{ optional($ticket->transaction)->visit_date ? optional($ticket->transaction->visit_date)->format('d M Y') : '-' }}</span>
                </div>
                <div class="field">
                    <label>Jumlah Tiket</label>
                    <span>{{ $ticket->transaction->quantity ?? 1 }}</span>
                </div>
                <div class="field">
                    <label>Status</label>
                    <span>{{ ucfirst($ticket->status) }}</span>
                </div>
            </div>

            <div class="qr">
                {!! QrCode::size(260)->generate($ticket->qr_code_payload) !!}
                <p style="margin-top: 16px; font-size: 13px; color: #475569;">QR Code Payload: {{ $ticket->qr_code_payload }}</p>
            </div>

            <div class="footer">
                <p>Tunjukkan tiket ini kepada petugas saat memasuki lokasi.</p>
            </div>
        </div>
    </div>
</body>
</html>
