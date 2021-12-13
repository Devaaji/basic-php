<?php

require '../functions.php';

$keyword = $_GET["keyword"];
$query = "SELECT * FROM laptop 
            WHERE 
            brand LIKE '%$keyword%' OR 
            processor LIKE '%$keyword%' OR 
            operating_system LIKE '%$keyword%' OR
            ram LIKE '%$keyword%'OR
            storage LIKE '%$keyword%' OR
            Graphics LIKE '%$keyword%'OR
            harga LIKE '%$keyword%'  ";

$laptops = query($query);

?>

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