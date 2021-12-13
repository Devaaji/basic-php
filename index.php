<?php
//open session
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}


//koneksi database
require 'functions.php';



//ambil data dari table laptop
$laptops = query("SELECT * FROM laptop ORDER BY id DESC");

if (isset($_POST["cari"])) {

    $laptops = cari($_POST["keyword"]);
}


// while ( $acc = mysqli_fetch_assoc($result) ){
// var_dump($acc);

// }


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Laptop</title>
    <style>
        table {
            border: 2px solid black;
        }

        th {
            padding: 20px;
        }
    </style>
</head>

<body>

    <a href="logout.php">Log out</a>

    <h1>Daftar Laptop</h1>
    <h2> <a href="tambah.php">Tambah Data Laptop</a></h2>
    <br>
    <form action="" method="POST">
        <input type="text" name="keyword" size="50" autofocus placeholder="Search ..." autocomplete="off" id="keyword">
        <button type="submit" name="cari" id="tombol-cari">Cari</button>
    </form>
    <br>
    <br>
    <div id="container">
        <table border="1">
            <tr>
                <th>No.</th>
                <th>Aksi</th>
                <th>Image</th>
                <th>Brand</th>
                <th>Processor</th>
                <th>Operating System</th>
                <th>RAM</th>
                <th>Storage</th>
                <th>Graphics</th>
                <th>Harga</th>
            </tr>
            <?php $i = 1; ?>
            <?php foreach ($laptops as $row) { ?>
                <tr>
                    <td><?= $i ?></td>
                    <td>
                        <a style="padding: 20px;" href="edit.php?id=<?= $row["id"]; ?>">Edit</a>|
                        <a style="padding: 20px;" href="hapus.php?id=<?= $row["id"]; ?>" onclick=" return confirm('Apakah Anda Yakin Menghapus Data Tersebut?');">Delete</a>
                    </td>
                    <td><img width="90px" height="90px" src="image/<?= $row["gambar"]; ?>" alt=""></td>
                    <td><?= $row["brand"] ?></td>
                    <td><?= $row["processor"] ?></td>
                    <td><?= $row["operating_system"] ?></td>
                    <td><?= $row["ram"] ?></td>
                    <td><?= $row["storage"] ?></td>
                    <td><?= $row["Graphics"] ?></td>
                    <td><?= $row["harga"] ?></td>
                </tr>
                <?php $i++ ?>
            <?php } ?>
        </table>
    </div>


    <script src="js/script.js"></script>

</body>

</html>