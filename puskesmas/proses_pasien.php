<?php
include 'dbkoneksi.php';

// Proses CRUD
if (isset($_POST['proses'])) {
    $data = [
        $_POST['kode'],
        $_POST['nama'],
        $_POST['tmp_lahir'] ?? '',
        $_POST['tgl_lahir'] ?? '',
        $_POST['gender'],
        $_POST['email'] ?? '',
        $_POST['alamat'] ?? '',
        $_POST['kelurahan_id'] ?? null
    ];

    if ($_POST['proses'] == 'Simpan') {
        $sql = "INSERT INTO pasien (kode, nama, tmp_lahir, tgl_lahir, gender, email, alamat, kelurahan_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    } elseif ($_POST['proses'] == 'Ubah') {
        $data[] = $_POST['idx'];
        $sql = "UPDATE pasien SET kode=?, nama=?, tmp_lahir=?, tgl_lahir=?, gender=?, email=?, alamat=?, kelurahan_id=? WHERE id=?";
    }

    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
} elseif (isset($_GET['proses']) && $_GET['proses'] == 'Hapus') {
    $stmt = $dbh->prepare("DELETE FROM pasien WHERE id=?");
    $stmt->execute([$_GET['idx']]);
}

header("Location: data_pasien.php");
?>