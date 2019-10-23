<?php
session_start();
$_SESSION["MahasiswaID"] = '';
unset($_SESSION["MahasiswaID"]);
session_unset();
session_destroy();
header("location:index.php");

?>