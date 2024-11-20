<?php
    // Parameter koneksi
    $serverName = "USER,1433"; // Nama server dan port
    $connectionOptions = [
        "Database" => "prakwebdb",
        "Uid" => "", // Masukkan username SQL Server
        "PWD" => "", // Masukkan password SQL Server
        "Encrypt" => true,
        "TrustServerCertificate" => true
    ];

    // Membuka koneksi
    $conn = sqlsrv_connect($serverName, $connectionOptions);

    if ($conn) {
        echo "Koneksi berhasil!";
    } else {
        echo "Error koneksi!";
        die(print_r(sqlsrv_errors(), true));
    }
?>