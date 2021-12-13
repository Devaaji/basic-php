<?php

session_start();
require 'functions.php';

//cek cookie
if( isset($_COOKIE['_i']) && isset($_COOKIE['_ky'])  ){

    $id = $_COOKIE['_i'];
    $key = $_COOKIE['_ky'];

    //ambil username berdasarkan id
    $result = mysqli_query($dbconnect, "SELECT username FROM user WHERE id = $id ");
    $row = mysqli_fetch_assoc($result);

    //cek cookie dan username
    if( $key === hash('haval256,5', $row['username']) ) {
        $_SESSION['login'] = true;
    }
    

}

//jika sudah login di balik ke index.php
if( isset($_SESSION["login"]) ){
    header("Location: index.php");
    exit;
}


if( isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($dbconnect, "SELECT * FROM user WHERE username = '$username'");

    //cek username
    if(mysqli_num_rows($result) === 1) {

        //cek password
        $row = mysqli_fetch_assoc($result);
        if( password_verify($password, $row["password"]) ){
            //set session
            $_SESSION["login"] = true;

            //cek remember me
            if ( isset($_POST['remember']) ){
                //buat cookie
                setcookie('_i', $row['id'], time()+60);
                setcookie('_ky', hash('haval256,5', $row['username']), time()+60 );
                
            }

            header("Location: index.php");
            exit;
        }

    }
    $error = true;

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Depdep</title>
</head>
<body>
    <h1>Halaman Login</h1>

    <?php if(isset($error)) : ?>
        <p style="color: red;"> Username atau Password Salah</p>
    <?php endif ?>

    <form action="" method="POST" >
        <ul>
            <li>
                <label for="username">username :</label>
                <input type="text" name="username" id="username">
            </li>
            <li>
                <label for="password">password :</label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember Me </label>
            </li>
            <li>
                <button type="submit" name="login">LOGIN</button>
            </li>
        </ul>
    </form>
</body>
</html>