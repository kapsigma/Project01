<?php
include '../dbkoneksi.php';
$isEdit = isset($_GET['id']);
$paramedik = [
    'nama' => '',
    'gender' => 'L',
    'tmp_lahir' => '',
    'tgl_lahir' => '',
    'kategori' => 'Dokter',
    'telpon' => '',
    'alamat' => '',
    'unit_kerja_id' => 1
];

$unit_kerja = $dbh->query("SELECT id, nama FROM unit_kerja")->fetchAll();

if ($isEdit) {
    $id = $_GET['id'];
    $stmt = $dbh->prepare("SELECT * FROM paramedik WHERE id = ?");
    $stmt->execute([$id]);
    $paramedik = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Form Paramedik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2><?= $isEdit ? 'Edit' : 'Tambah' ?> Data Paramedik</h2>
        <form action="proses_paramedik.php" method="post">
            <input type="hidden" name="idx" value="<?= $isEdit ? $paramedik['id'] : '' ?>">
            
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" name="nama" value="<?= $paramedik['nama'] ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis Kelamin</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" value="L" <?= $paramedik['gender'] == 'L' ? 'checked' : '' ?> required>
                    <label class="form-check-label">Laki-laki</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="gender" value="P" <?= $paramedik['gender'] == 'P' ? 'checked' : '' ?>>
                    <label class="form-check-label">Perempuan</label>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Tempat Lahir</label>
                <input type="text" class="form-control" name="tmp_lahir" value="<?= $paramedik['tmp_lahir'] ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" name="tgl_lahir" value="<?= $paramedik['tgl_lahir'] ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select class="form-select" name="kategori" required>
                    <option value="Dokter" <?= $paramedik['kategori'] == 'Dokter' ? 'selected' : '' ?>>Dokter</option>
                    <option value="Perawat" <?= $paramedik['kategori'] == 'Perawat' ? 'selected' : '' ?>>Perawat</option>
                    <option value="Bidan" <?= $paramedik['kategori'] == 'Bidan' ? 'selected' : '' ?>>Bidan</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control" name="telpon" value="<?= $paramedik['telpon'] ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea class="form-control" name="alamat"><?= $paramedik['alamat'] ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Unit Kerja</label>
                <select class="form-select" name="unit_kerja_id" required>
                    <?php foreach ($unit_kerja as $uk): ?>
                        <option value="<?= $uk['id'] ?>" <?= $paramedik['unit_kerja_id'] == $uk['id'] ? 'selected' : '' ?>>
                            <?= $uk['nama'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary"><?= $isEdit ? 'Update' : 'Simpan' ?></button>
            <a href="data_paramedik.php" class="btn btn-danger">Batal</a>
        </form>
    </div>
</body>
</html>