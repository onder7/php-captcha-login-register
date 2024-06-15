<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

echo "Hoşgeldiniz, " . htmlspecialchars($_SESSION['username']) . "!";
echo "<br><a href='logout.php'>Çıkış Yap</a>";
?>
