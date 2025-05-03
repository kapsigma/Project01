<?php include '../dbkoneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Paramedik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Data Paramedik</h2>
        <a href="form_paramedik.php" class="btn btn-primary mb-3">Tambah Paramedik</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Gender</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $dbh->query("SELECT * FROM paramedik");
                while ($row = $stmt->fetch()) {
                    echo "<tr>
                            <td>{$row['nama']}</td>
                            <td>".($row['gender'] == 'L' ? 'Laki-laki' : 'Perempuan')."</td>
                            <td>
                                <a href='form_paramedik.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='proses_paramedik.php?idx={$row['id']}&proses=Hapus' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin hapus?\")'>Hapus</a>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>