<?php
include '../dbkoneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        $_POST['tanggal'],
        $_POST['berat'],
        $_POST['tinggi'],
        $_POST['pasien_id'],
        $_POST['dokter_id']
    ];

    if (empty($_POST['idx'])) {
        $sql = "INSERT INTO periksa (tanggal, berat, tinggi, pasien_id, dokter_id) VALUES (?, ?, ?, ?, ?)";
    } else {
        $data[] = $_POST['idx'];
        $sql = "UPDATE periksa SET tanggal=?, berat=?, tinggi=?, pasien_id=?, dokter_id=? WHERE id=?";
    }

    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
} elseif (isset($_GET['idx'])) {
    $stmt = $dbh->prepare("DELETE FROM periksa WHERE id=?");
    $stmt->execute([$_GET['idx']]);
}

header("Location: data_periksa.php");
?>