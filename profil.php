<?php
// Veritabanı bağlantısı
require_once("inc/baglan.php");
// Kullanıcı profil bilgilerini getirme
session_start();
$username=htmlspecialchars($_SESSION['username']);
$stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
$stmt->execute(['username' => $username]);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Profil bilgilerini düzenleme
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "blog";

   echo $user = $_POST['name'];
   echo $email = $_POST['email'];
   echo $pass = $_POST['password'].'<br>';


   try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Bağlantı hatası: " . $e->getMessage();
}

   try {
       $stmt = $conn->prepare("UPDATE users SET username = :user, email = :email, password = :pass WHERE username = :user");

       $stmt->bindParam(':email', $email);
       $stmt->bindParam(':password', $password);
  
       $stmt->execute();

       echo "Kayıt başarıyla güncellendi.";
   } catch(PDOException $e) {
       echo "Güncelleme hatası: " . $e->getMessage();
   }


}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profil Bilgileri</title>
</head>
<body>
    <h1>Profil Bilgileri</h1>
    <form method="post">
        <label for="name">Ad:</label>
        <input type="text" id="name" name="name" value="<?php echo $user['username']; ?>"><br>

        <label for="email">E-posta:</label>
        <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>"><br>

        <label for="password">password:</label>
        <input type="password" id="password" name="password" value="<?php echo $user['password']; ?>"><br>

        <input type="submit" value="Güncelle">
    </form>
</body>
</html>
