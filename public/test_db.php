<?php

require_once '../config/database.php';

try {
    $conn = getConnection();

    if ($conn) {
        echo "Koneksi berhasil";
    }

} catch (Exception $e) {
    echo "Koneksi gagal: " . $e->getMessage();
}
