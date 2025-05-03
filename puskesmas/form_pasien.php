<?php
include 'dbkoneksi.php';
$isEdit = isset($_GET['id']);
$pasien = ['kode' => '', 'nama' => '', 'gender' => ''];

if ($isEdit) {
    $id = $_GET['id'];
    $stmt = $dbh->prepare("SELECT * FROM pasien WHERE id = ?");
    $stmt->execute([$id]);
    $pasien = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Form Pasien</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2><?= $isEdit ? 'Edit' : 'Tambah' ?> Pasien</h2>
        <form action="proses_pasien.php" method="post">
            <input type="hidden" name="idx" value="<?= $isEdit ? $pasien['id'] : '' ?>">
            <div class="mb-3">
                <label class="form-label">Kode Pasien</label>
                <input type="text" class="form-control" name="kode" value="<?= $pasien['kode'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" name="nama" value="<?= $pasien['nama'] ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" value="L" <?= $pasien['gender'] == 'L' ? 'checked' : '' ?> required>
                    <label class="form-check-label">Laki-laki</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" value="P" <?= $pasien['gender'] == 'P' ? 'checked' : '' ?>>
                    <label class="form-check-label">Perempuan</label>
                </div>
            </div>
            <button type="submit" name="proses" value="<?= $isEdit ? 'Ubah' : 'Simpan' ?>" class="btn btn-primary">Simpan</button>
            <a href="data_pasien.php" class="btn btn-danger">Batal</a>
        </form>
    </div>
</body>
</html>