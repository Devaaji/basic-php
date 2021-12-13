<?php
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

    if( isset($_POST["submit"])) {

        
        //cek berhasil atau tidak
        if ( tambah($_POST) > 0 ){
            echo "
                <script>
                    alert('Data Berhasil ditambahkan');
                    document.location.href = 'index.php';
                </script>
            ";
        } else {
            echo "
            <script>
                alert('Data Gagal ditambahkan');
                document.location.href = 'index.php';
             </script>
            ";
        }

    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
</head>
<body>
    <h1>Tambah Data Laptop</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="gambar">Gambar : </label>
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <label for="brand">Brand : </label>
                <input type="text" name="brand" id="brand" required>
            </li>
            <li>
                <label for="processor">Processor : </label>
                <input type="text" name="processor" id="processor" required>
            </li>
            <li>
                <label for="operating_system">Operating Sistem : </label>
                <input type="text" name="operating_system" id="operating_system" required>
            </li>
            <li>
                <label for="ram">RAM : </label>
                <input type="text" name="ram" id="ram" required>
            </li>
            <li>
                <label for="storage">Storage : </label>
                <input type="text" name="storage" id="storage" required>
            </li>
            <li>
                <label for="Graphics">Graphics : </label>
                <input type="text" name="Graphics" id="Graphics" required>
            </li>
            <li>
                <label for="harga">Harga : </label>
                <input type="text" name="harga" id="harga" required>
            </li>
            <li>
                <button type="submit" name="submit">SUBMIT</button>
            </li>
        </ul>
    </form>
</body>
</html>