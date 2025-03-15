<?php
// File: index.php

require_once 'model/gaji.php'; // Mengimpor data karyawan dari model/gaji.php

function tampilkanMenu() {
    echo "1. Lihat karyawan\n";
    echo "2. Tambah karyawan\n";
    echo "3. Update karyawan\n";
    echo "4. Hapus karyawan\n";
    echo "5. Hitung Gaji Karyawan\n";
    echo "6. Keluar aplikasi\n";
}

function lihatKaryawan($data_karyawan) {
    echo "Daftar Karyawan:\n";
    foreach ($data_karyawan as $index => $karyawan) {
        echo ($index + 1) . ". Nama: " . $karyawan['nama'] . ", Jabatan: " . $karyawan['jabatan'] . "\n";
    }
}

function tambahKaryawan(&$data_karyawan) {
    echo "Masukkan nama karyawan: ";
    $nama = trim(fgets(STDIN));
    echo "Masukkan jabatan karyawan (Manager/Supervisor/Staff): ";
    $jabatan = trim(fgets(STDIN));

    if (!in_array($jabatan, ['Manager', 'Supervisor', 'Staff'])) {
        echo "Jabatan tidak valid!\n";
        return;
    }

    $data_karyawan[] = ['nama' => $nama, 'jabatan' => $jabatan];
    echo "Karyawan berhasil ditambahkan!\n";
}

function updateKaryawan(&$data_karyawan) {
    lihatKaryawan($data_karyawan);
    echo "Masukkan nomor karyawan yang ingin diupdate: ";
    $nomor = intval(trim(fgets(STDIN))) - 1;

    if (!isset($data_karyawan[$nomor])) {
        echo "Nomor karyawan tidak valid!\n";
        return;
    }

    echo "Masukkan nama baru: ";
    $nama = trim(fgets(STDIN));
    echo "Masukkan jabatan baru (Manager/Supervisor/Staff): ";
    $jabatan = trim(fgets(STDIN));

    if (!in_array($jabatan, ['Manager', 'Supervisor', 'Staff'])) {
        echo "Jabatan tidak valid!\n";
        return;
    }

    $data_karyawan[$nomor] = ['nama' => $nama, 'jabatan' => $jabatan];
    echo "Karyawan berhasil diupdate!\n";
}

function hapusKaryawan(&$data_karyawan) {
    lihatKaryawan($data_karyawan);
    echo "Masukkan nomor karyawan yang ingin dihapus: ";
    $nomor = intval(trim(fgets(STDIN))) - 1;

    if (!isset($data_karyawan[$nomor])) {
        echo "Nomor karyawan tidak valid!\n";
        return;
    }

    echo "Anda akan menghapus karyawan berikut:\n";
    echo "Nama: " . $data_karyawan[$nomor]['nama'] . ", Jabatan: " . $data_karyawan[$nomor]['jabatan'] . "\n";
    echo "Apakah Anda yakin? (y/n): ";
    $konfirmasi = trim(fgets(STDIN));

    if ($konfirmasi === 'y') {
        array_splice($data_karyawan, $nomor, 1);
        echo "Karyawan berhasil dihapus!\n";
    } else {
        echo "Penghapusan dibatalkan.\n";
    }
}

function hitungGaji($data_karyawan) {
    lihatKaryawan($data_karyawan);
    echo "Masukkan nomor karyawan yang ingin dihitung gajinya: ";
    $nomor = intval(trim(fgets(STDIN))) - 1;

    if (!isset($data_karyawan[$nomor])) {
        echo "Nomor karyawan tidak valid!\n";
        return;
    }

    $karyawan = $data_karyawan[$nomor];
    echo "Masukkan jumlah jam lembur: ";
    $jam_lembur = intval(trim(fgets(STDIN)));
    echo "Masukkan rating kinerja (1-5): ";
    $rating = intval(trim(fgets(STDIN)));

    // Hitung gaji berdasarkan jabatan, jam lembur, dan rating
    $gaji_pokok = 0;
    $tunjangan_jabatan = 0;

    switch ($karyawan['jabatan']) {
        case 'Manager':
            $gaji_pokok = 10000000;
            $tunjangan_jabatan = 5000000;
            break;
        case 'Supervisor':
            $gaji_pokok = 7000000;
            $tunjangan_jabatan = 3000000;
            break;
        case 'Staff':
            $gaji_pokok = 5000000;
            $tunjangan_jabatan = 1000000;
            break;
    }

    $lembur = $jam_lembur * 25000;
    $bonus_kinerja = $rating * 500000;
    $total_gaji = $gaji_pokok + $tunjangan_jabatan + $lembur + $bonus_kinerja;

    echo "Gaji karyawan:\n";
    echo "Nama: " . $karyawan['nama'] . "\n";
    echo "Jabatan: " . $karyawan['jabatan'] . "\n";
    echo "Gaji pokok: Rp " . number_format($gaji_pokok, 0, ',', '.') . "\n";
    echo "Tunjangan jabatan: Rp " . number_format($tunjangan_jabatan, 0, ',', '.') . "\n";
    echo "Jam lembur: $jam_lembur x Rp 25.000\n";
    echo "Lembur: Rp " . number_format($lembur, 0, ',', '.') . "\n";
    echo "Bonus kinerja: Rp " . number_format($bonus_kinerja, 0, ',', '.') . "\n";
    echo "Total gaji: Rp " . number_format($total_gaji, 0, ',', '.') . "\n";
}

function keluarAplikasi() {
    echo "Terima kasih, sampai jumpa!\n";
    exit();
}

// Loop utama aplikasi
while (true) {
    tampilkanMenu();
    echo "Pilih aksi (1-6): ";
    $pilihan = intval(trim(fgets(STDIN)));

    switch ($pilihan) {
        case 1:
            lihatKaryawan($data_karyawan);
            break;
        case 2:
            tambahKaryawan($data_karyawan);
            break;
        case 3:
            updateKaryawan($data_karyawan);
            break;
        case 4:
            hapusKaryawan($data_karyawan);
            break;
        case 5:
            hitungGaji($data_karyawan);
            break;
        case 6:
            keluarAplikasi();
            break;
        default:
            echo "Pilihan tidak valid!\n";
            break;
    }
}
?>