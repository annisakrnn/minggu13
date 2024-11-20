<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Anggota</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php
    $serverName = "USER"; 
    $connectionOptions = array(
        "Database" => "prakwebdb", 
        "Uid" => "sa", 
        "PWD" => "12345" 
    );

    $koneksi = sqlsrv_connect($serverName, $connectionOptions);
    if (!$koneksi) {
        die(print_r(sqlsrv_errors(), true));
    }
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM anggota WHERE ID = ?";
        $params = array($id);
        $stmt = sqlsrv_query($koneksi, $query, $params);
        if ($stmt) {
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        } else {
            echo "Data tidak ditemukan.";
            exit();
        }
    } else {
        echo "ID tidak valid.";
        exit();
    }
    sqlsrv_close($koneksi);
    ?>
    <div class="container mt-4">
        <h2>Edit Data Anggota</h2>
        <form action="proses.php?aksi=ubah" method="post">
            <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
            <div class="form-group">
                <label for="Nama">Nama:</label>
                <input type="text" class="form-control" name="nama" id="Nama" value="<?php echo $row['Nama']; ?>" required>
            </div>
            <div class="form-group">
                <label for="Jenis_Kelamin">Jenis Kelamin:</label>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="jenis_kelamin" value="L" id="laki" <?php echo ($row['Jenis_Kelamin'] === 'L') ? 'checked' : ''; ?> required>
                    <label class="form-check-label" for="laki">Laki-laki</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="jenis_kelamin" value="P" id="perempuan" <?php echo ($row['Jenis_Kelamin'] === 'P') ? 'checked' : ''; ?> required>
                    <label class="form-check-label" for="perempuan">Perempuan</label>
                </div>
            </div>
            <div class="form-group">
                <label for="Alamat">Alamat:</label>
                <input type="text" class="form-control" name="alamat" id="Alamat" value="<?php echo $row['Alamat']; ?>" required>
            </div>
            <div class="form-group">
                <label for="No_Telp">No. Telp:</label>
                <input type="text" class="form-control" name="no_telp" id="No_Telp" value="<?php echo $row['No_Telp']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
        <a class="btn btn-secondary mt-2" href="index.php">Kembali</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
