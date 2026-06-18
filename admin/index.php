<?php
session_start();

if (!isset($_SESSION['logined']) || $_SESSION['logined'] !== true) {
    header("Location: ./login.php");
    exit;
}
?>

<h1>salom</h1>
<a href="./logout.php">chiqish</a>