<?php

session_start();
$_SESSION = [];
session_unset();
session_destroy();

setcookie('_i', '', time() - 3600);
setcookie('_ky', '', time() - 3600);

header("Location: login.php");
exit;

?>