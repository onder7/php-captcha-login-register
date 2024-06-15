<?php require_once("inc/baglan.php");?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Giriş Yap</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <style>
a:link, a:visited {
  background-color: #f44336;
  color: white;
  padding: 11px 15px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
}

a:hover, a:active {
  background-color: red;
}
</style>
    <script>
        function showPopup() {
            document.getElementById('popup').classList.remove('hidden');
            setTimeout(() => {
                window.location.href = 'index.php';
            }, 3000);
        }
    </script>
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
    <div class="w-full max-w-xs">
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="login.php" method="post">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">Kullanıcı Adı</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="username" id="username" type="text" required>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Şifre</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" name="password" id="password" type="password" required>
            </div>
  
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Aşağıdaki Değeri Yazın</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" 
                                id="captcha" name="captcha" required> <img src="captcha.php" alt="CAPTCHA">
            </div>
           
        

<div class="flex items-center justify-between">
<button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Giriş Yap</button>
</div><a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" href="index.php?cancel=true">İptal</a>
        </form>



        <div id="popup" class="hidden fixed top-0 left-0 w-full h-full flex items-center justify-center bg-gray-800 bg-opacity-50">
            <div class="bg-white p-5 rounded shadow-lg">
                <p class="text-lg">Giriş başarılı! Yönlendiriliyorsunuz...</p>
            </div>
        </div>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       
            session_start();

            $username = $_POST['username'];
            $password = $_POST['password'];
            $user_captcha = $_POST['captcha'];
            $actual_captcha = $_SESSION['captcha'];
            if ($user_captcha == $actual_captcha){
            $sql = "SELECT * FROM users WHERE username = :username";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['username' => $username]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                echo "<script>showPopup();</script>";
            } else {
                echo "<p class='text-red-500'>Kullanıcı adı veya şifre hatalı.</p>";
            }}else {
                echo "
                
                <p class='text-red-500'>Doğrulaması başarısız.</p>";
               
            }
        }

        if(isset($_GET['cancel']) && $_GET['cancel'] == 'true') {
            // Kullanıcıyı ana sayfaya yönlendir
            header("Location: index.php");
            exit;
        }
        ?>
    </div>
</body>
</html>
