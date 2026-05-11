# TODO - Fix Midtrans Sandbox Simulator Pending/Unsuccessful

## Step 1: Diagnosis
- [x] Baca `PaymentController.php`
- [x] Baca `MidtransCallbackController.php`
- [x] Baca `MidtransWebhookController.php`
- [ ] Validasi controller callback/webhook cocok dengan payload Midtrans (log)

## Step 2: Fix webhook
- [x] Update `MidtransWebhookController` agar menangani semua status yang relevan (settlement/capture = paid, pending/pending = pending, deny/expire/cancel/failed/failure = expired)
- [x] Tambahkan logging detail untuk: order_id, transaction_status, ditemukan/tidaknya transaksi, status sebelum & sesudah
- [ ] Pastikan tidak ada mismatch field (contoh: `transaction_status` vs `transactionStatus`, dll)


## Step 3: Fix callback finish/unfinish
- [ ] Pastikan `finish` dan `unfinish` melakukan update status yang konsisten dengan webhook
- [ ] Perluas mapping jika simulator mengirim status lain (mis: `failure`, `deny`, `cancel`, dll)
- [ ] Jika transaction belum ada/ tidak ditemukan, simpan log & jangan salah update

## Step 4: Verifikasi
- [ ] Jalankan 1x simulasi Midtrans sandbox
- [ ] Cek `storage/logs/laravel.log` untuk urutan: redirect finish/unfinish + webhook
- [ ] Pastikan transaksi di tabel `transactions` berubah dari `pending` ke `paid` saat simulator sukses

