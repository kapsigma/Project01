<?php include '../dbkoneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Pemeriksaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Data Pemeriksaan Pasien</h2>
        <a href="form_periksa.php" class="btn btn-primary mb-3">Tambah Pemeriksaan</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Pasien</th>
                    <th>Dokter</th>
                    <th>Berat (kg)</th>
                    <th>Tinggi (cm)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT p.id, p.tanggal, ps.nama as pasien, pm.nama as dokter, p.berat, p.tinggi 
                        FROM periksa p
                        JOIN pasien ps ON p.pasien_id = ps.id
                        JOIN paramedik pm ON p.dokter_id = pm.id";
                $stmt = $dbh->query($sql);
                while ($row = $stmt->fetch()) {
                    echo "<tr>
                            <td>{$row['tanggal']}</td>
                            <td>{$row['pasien']}</td>
                            <td>{$row['dokter']}</td>
                            <td>{$row['berat']}</td>
                            <td>{$row['tinggi']}</td>
                            <td>
                                <a href='form_periksa.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='proses_periksa.php?idx={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin bro?\")'>Hapus</a>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>