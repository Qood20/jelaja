<?php
/**
 * Script Manual untuk membuat Storage Link (Symlink) di Hosting
 * Gunakan jika Artisan::call('storage:link') tidak berhasil.
 */

// Menentukan path target (folder asli penyimpanan)
// Sejajarkan dengan struktur Laravel standar
$target = __DIR__ . '/../storage/app/public'; 

// Menentukan path link (folder yang akan diakses publik)
$link = __DIR__ . '/storage'; 

if (file_exists($link)) {
    if (is_link($link)) {
        echo "Link simbolis sudah ada.";
    } else {
        echo "PERINGATAN: Folder 'storage' sudah ada di dalam public tetapi bukan link simbolis. <br>";
        echo "Silakan hapus folder 'public/storage' terlebih dahulu lalu jalankan script ini lagi.";
    }
} else {
    if (symlink($target, $link)) {
        echo "SUKSES: Link simbolis berhasil dibuat! Foto seharusnya sekarang sudah tampil.";
    } else {
        echo "GAGAL: Tidak dapat membuat link simbolis. Pastikan fungsi 'symlink' tidak dinonaktifkan di hosting Anda.";
    }
}
