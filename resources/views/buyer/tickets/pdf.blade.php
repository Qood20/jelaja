<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>E-Tiket Jelaja - {{ $ticket->destination->name }}</title>
    <style>
        @page {
            margin: 0;
        }
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #1e293b;
            background-color: #f1f5f9;
            margin: 0;
            padding: 40px;
        }
        .ticket-container {
            max-width: 680px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 24px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            overflow: hidden;
            position: relative;
        }
        .header {
            background: linear-gradient(135deg, #1d4ed8 0%, #06b6d4 100%);
            padding: 24px 32px;
            color: #ffffff;
        }
        .header table {
            width: 100%;
            border-collapse: collapse;
        }
        .header h1 {
            font-size: 24px;
            font-weight: 800;
            margin: 0;
            letter-spacing: -0.5px;
        }
        .header p {
            font-size: 12px;
            margin: 4px 0 0 0;
            color: #e0f2fe;
            opacity: 0.9;
        }
        .header-right {
            text-align: right;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        .body-table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-cell {
            width: 60%;
            padding: 32px;
            vertical-align: top;
        }
        .qr-cell {
            width: 40%;
            padding: 32px;
            text-align: center;
            vertical-align: middle;
            background-color: #f8fafc;
            border-left: 2px dashed #e2e8f0;
        }
        /* Ticket punch holes */
        .punch-left, .punch-right {
            position: absolute;
            top: 50%;
            width: 24px;
            height: 24px;
            background-color: #f1f5f9;
            border-radius: 50%;
            margin-top: -12px;
            border: 1px solid #e2e8f0;
            z-index: 10;
        }
        .punch-left {
            left: -13px;
        }
        .punch-right {
            right: -13px;
        }
        .section-title {
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #94a3b8;
            margin-bottom: 4px;
        }
        .section-content {
            font-size: 15px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 20px;
        }
        .section-content-highlight {
            font-size: 18px;
            font-weight: 800;
            color: #1d4ed8;
            margin-bottom: 20px;
        }
        .qr-code-img {
            display: inline-block;
            padding: 12px;
            background-color: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 16px;
        }
        .qr-payload {
            margin-top: 12px;
            font-family: monospace;
            font-size: 9px;
            color: #64748b;
            word-break: break-all;
        }
        .footer {
            background-color: #f8fafc;
            border-top: 1px solid #f1f5f9;
            padding: 16px 32px;
            text-align: center;
            font-size: 11px;
            color: #64748b;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="ticket-container">
        <!-- Punch Holes -->
        <div class="punch-left"></div>
        <div class="punch-right"></div>

        <!-- Header -->
        <div class="header">
            <table>
                <tr>
                    <td>
                        <h1>JELAJA</h1>
                        <p>Tiket Masuk Digital (E-Voucher)</p>
                    </td>
                    <td class="header-right">
                        {{ ucfirst($ticket->status) }}
                    </td>
                </tr>
            </table>
        </div>

        <!-- Content Body -->
        <table class="body-table">
            <tr>
                <!-- Left Column: Details -->
                <td class="info-cell">
                    <div class="section-title">Destinasi Wisata</div>
                    <div class="section-content-highlight">{{ $ticket->destination->name }}</div>

                    <table style="width: 100%; border-collapse: collapse;">
                        <tr>
                            <td style="width: 50%; padding-bottom: 16px; vertical-align: top;">
                                <div class="section-title">Nama Pengunjung</div>
                                <div class="section-content">{{ $ticket->buyer->name ?? '-' }}</div>
                            </td>
                            <td style="width: 50%; padding-bottom: 16px; vertical-align: top;">
                                <div class="section-title">Nomor Handphone</div>
                                <div class="section-content">{{ $ticket->buyer->phone ?? '-' }}</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 50%; padding-bottom: 16px; vertical-align: top;">
                                <div class="section-title">Tanggal Kunjungan</div>
                                <div class="section-content">{{ optional($ticket->transaction)->visit_date ? optional($ticket->transaction->visit_date)->format('d M Y') : '-' }}</div>
                            </td>
                            <td style="width: 50%; padding-bottom: 16px; vertical-align: top;">
                                <div class="section-title">Kapasitas Tiket</div>
                                <div class="section-content">{{ $ticket->transaction->quantity ?? 1 }} Orang</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 50%; vertical-align: top;">
                                <div class="section-title">Order ID</div>
                                <div class="section-content" style="font-family: monospace; font-size: 13px;">{{ optional($ticket->transaction)->order_id ?? '-' }}</div>
                            </td>
                            <td style="width: 50%; vertical-align: top;">
                                <div class="section-title">Waktu Pembayaran</div>
                                <div class="section-content" style="font-size: 13px;">{{ optional($ticket->transaction)->paid_at ? optional($ticket->transaction->paid_at)->format('d M Y H:i') . ' WIB' : '-' }}</div>
                            </td>
                        </tr>
                    </table>
                </td>

                <!-- Right Column: QR Code -->
                <td class="qr-cell">
                    <div class="qr-code-img">
                        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(160)->margin(0)->generate($ticket->qr_code_payload)) !!}" style="width: 160px; height: 160px; display: block;" alt="QR Code">
                    </div>
                    <div class="qr-payload">ID: {{ substr($ticket->qr_code_payload, -8) }}</div>
                    <div style="font-size: 10px; color: #94a3b8; font-weight: 700; text-transform: uppercase; margin-top: 10px; letter-spacing: 0.5px;">Tunjukkan QR Code Ke Petugas</div>
                </td>
            </tr>
        </table>

        <!-- Footer -->
        <div class="footer">
            Harap tunjukkan e-tiket ini kepada petugas di gerbang masuk lokasi untuk diverifikasi. Terima kasih telah menggunakan Jelaja!
        </div>
    </div>
</body>
</html>
