<?php
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

//ambil data di URL
$id = $_GET["id"];

//query bedasarkan id

$laptop = query("SELECT * FROM laptop WHERE id = $id")[0];




 if( isset($_POST["submit"])) {
        
        //cek berhasil atau tidak
        if ( edit($_POST) > 0 ){
            echo "
                <script>
                    alert('Data Berhasil diedit');
                    document.location.href = 'index.php';
                </script>
            ";
        } else {
            echo "
            <script>
                alert('Data Gagal diedit');
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
        <input type="hidden" name="id" value="<?= $laptop["id"] ?>">
        <input type="hidden" name="gambarLama" value="<?= $laptop["gambar"] ?>">
        <ul>
            <li>
                <label for="gambar">Gambar : </label> <br>
                <img width="80px" height="80px" src="image/<?= $laptop["gambar"] ?>" alt=""> <br>
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <label for="brand">Brand : </label>
                <input type="text" name="brand" id="brand" required value="<?= $laptop["brand"] ?>">
            </li>
            <li>
                <label for="processor">Processor : </label>
                <input type="text" name="processor" id="processor" required value="<?= $laptop["processor"] ?>">
            </li>
            <li>
                <label for="operating_system">Operating Sistem : </label>
                <input type="text" name="operating_system" id="operating_system" required value="<?= $laptop["operating_system"] ?>">
            </li>
            <li>
                <label for="ram">RAM : </label>
                <input type="text" name="ram" id="ram" required value="<?= $laptop["ram"] ?>">
            </li>
            <li>
                <label for="storage">Storage : </label>
                <input type="text" name="storage" id="storage" required value="<?= $laptop["storage"] ?>">
            </li>
            <li>
                <label for="Graphics">Graphics : </label>
                <input type="text" name="Graphics" id="Graphics" required value="<?= $laptop["Graphics"] ?>">
            </li>
            <li>
                <label for="harga">Harga : </label>
                <input type="text" name="harga" id="harga" required value="<?= $laptop["harga"] ?>">
            </li>
            <li>
                <button type="submit" name="submit">UPDATE</button>
            </li>
        </ul>
    </form>
</body>
</html>
