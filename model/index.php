<?php
// File: index.php

require_once 'model/gaji.php'; // Mengimpor data dan fungsi dari model/gaji.php

function tampilkanMenu() {
    echo "1. Lihat karyawan\n";
    echo "2. Tambah karyawan\n";
    echo "3. Update karyawan\n";
    echo "4. Hapus karyawan\n";
    echo "5. Hitung Gaji Karyawan\n";
    echo "6. Keluar aplikasi\n";
}

// Loop utama aplikasi
while (true) {
    tampilkanMenu(); // Tampilkan menu
    echo "Pilih aksi (1-6): ";
    $pilihan = intval(trim(fgets(STDIN))); // Baca input pengguna

    switch ($pilihan) {
        case 1:
            // Panggil fungsi lihatKaryawan
            lihatKaryawan($data_karyawan);
            break;
        case 2:
            // Panggil fungsi tambahKaryawan (jika ada)
            // tambahKaryawan($data_karyawan);
            break;
        case 3:
            // Panggil fungsi updateKaryawan (jika ada)
            // updateKaryawan($data_karyawan);
            break;
        case 4:
            // Panggil fungsi hapusKaryawan (jika ada)
            // hapusKaryawan($data_karyawan);
            break;
        case 5:
            // Panggil fungsi hitungGajiKaryawan (jika ada)
            // hitungGajiKaryawan($data_karyawan);
            break;
        case 6:
            echo "Terima kasih, sampai jumpa!\n";
            exit(); // Keluar dari aplikasi
        default:
            echo "Pilihan tidak valid!\n";
            break;
    }
}
?>