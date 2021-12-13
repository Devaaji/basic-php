<?php

require 'functions.php';

if (isset($_POST['register'])) {

    if (registrasi($_POST) > 0) {
        echo "<script>
            alert('Data Berhasil Terdaftar');
        </script>";
    } else {
        echo mysqli_error($dbconnect);
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <style>
        label {
            margin-top: 10px;
            display: block;
        }

        button {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <h1>Halaman Registrasi</h1>

    <form action="" method="POST">
        <ul>
            <li>
                <label for="username">Username :</label>
                <input type="text" name="username" id="username" required>
            </li>
            <li>
                <label for="password">Password :</label>
                <input type="password" name="password" id="password" required>
            </li>
            <li>
                <label for="password2">Confirm Password :</label>
                <input type="password" name="password2" id="password2" required>
            </li>
            <li>
                <button type="submit" name="register">REGISTER</button>
            </li>
        </ul>
    </form>

</body>

</html>