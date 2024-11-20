<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Data Anggota</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container mt-4">
            <h2>Data Anggota</h2>
            <a class="btn btn-success mt-2" href="create.php">Tambah Data</a>
            <br><br>
            <?php
            $serverName = "USER"; 
            $connectionOptions = array(
                "Database" => "prakwebdb",
                "Uid" => "sa", 
                "PWD" => "12345"
            );
            $koneksi = sqlsrv_connect( $serverName, $connectionOptions);

            if( !$koneksi ) {
                die( print_r(sqlsrv_errors(), true));
            }
            $query = "SELECT * FROM anggota ORDER BY id DESC";
            $result = sqlsrv_query( $koneksi, $query);

            if( sqlsrv_has_rows($result) ) {
            ?>
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>No. Telp</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                            $kelamin = ($row["Jenis_Kelamin"] == 'L') ? 'Laki-Laki' : 'Perempuan';
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row["Nama"] ?></td>
                                <td><?= $kelamin ?></td>
                                <td><?= $row["Alamat"] ?></td>
                                <td><?= $row["No_Telp"] ?></td>
                                <td>
                                    <a class="btn btn-primary" href="edit.php?id=<?= $row["ID"] ?>">Edit</a>
                                    <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#hapusModal<?= $row["ID"] ?>">Hapus</a>
                                </td>
                            </tr>
                            <div class="modal fade" id="hapusModal<?= $row["ID"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <?= "Apakah anda yakin ingin menghapus data dengan nama " . $row["Nama"] . "?" ?>
                                        </div>
                                        <div class="modal-footer">
                                            <a class="btn btn-danger" href="proses.php?aksi=hapus&id=<?= $row["ID"] ?>">Hapus</a>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            } else {
                echo "Tidak ada data.";
            }

            // Menutup koneksi
            sqlsrv_close($koneksi);
            ?>
        </div>
        
        <!-- Script untuk Bootstrap JS dan dependencies -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
</html>
