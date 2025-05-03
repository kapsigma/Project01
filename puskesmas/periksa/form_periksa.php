<?php
include '../dbkoneksi.php';
$isEdit = isset($_GET['id']);
$periksa = ['tanggal' => date('Y-m-d'), 'berat' => '', 'tinggi' => ''];

$pasien = $dbh->query("SELECT id, nama FROM pasien")->fetchAll();
$dokter = $dbh->query("SELECT id, nama FROM paramedik WHERE kategori='Dokter'")->fetchAll();

if ($isEdit) {
    $id = $_GET['id'];
    $stmt = $dbh->prepare("SELECT * FROM periksa WHERE id = ?");
    $stmt->execute([$id]);
    $periksa = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Form Pemeriksaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2><?= $isEdit ? 'Edit' : 'Tambah' ?> Pemeriksaan</h2>
        <form action="proses_periksa.php" method="post">
            <input type="hidden" name="idx" value="<?= $isEdit ? $periksa['id'] : '' ?>">
            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date" class="form-control" name="tanggal" value="<?= $periksa['tanggal'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Pasien</label>
                <select class="form-select" name="pasien_id" required>
                    <?php foreach ($pasien as $p): ?>
                        <option value="<?= $p['id'] ?>" <?= $isEdit && $periksa['pasien_id'] == $p['id'] ? 'selected' : '' ?>>
                            <?= $p['nama'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Dokter</label>
                <select class="form-select" name="dokter_id" required>
                    <?php foreach ($dokter as $d): ?>
                        <option value="<?= $d['id'] ?>" <?= $isEdit && $periksa['dokter_id'] == $d['id'] ? 'selected' : '' ?>>
                            <?= $d['nama'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Berat Badan (kg)</label>
                <input type="number" step="0.1" class="form-control" name="berat" value="<?= $periksa['berat'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tinggi Badan (cm)</label>
                <input type="number" class="form-control" name="tinggi" value="<?= $periksa['tinggi'] ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="data_periksa.php" class="btn btn-danger">Batal</a>
        </form>
    </div>
</body>
</html>