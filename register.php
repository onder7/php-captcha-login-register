<?php require_once("inc/baglan.php");?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Giriş Yap</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        function showPopup() {
            document.getElementById('popup').classList.remove('hidden');
            setTimeout(() => {
                window.location.href = 'index.php';
            }, 3000);
        }
    </script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-center">Kayıt Ol</h2>
        <form action="register.php" method="post" class="space-y-4">
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">Kullanıcı Adı</label>
                <input type="text" name="username" id="username" required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Şifre</label>
                <input type="password" name="password" id="password" required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            </div>

            <div>
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Aşağıdaki Değeri Yazın</label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" 
                                id="captcha" name="captcha" required> <img src="captcha.php" alt="CAPTCHA">
            </div>            
            

            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Kayıt Yap</button>
            </div>
        </form>
    </div>




    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        session_start();
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $email = $_POST['email'];

        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            die('Invalid email address.');
        }

        if (strlen($password) < 8) {
            die('Password must be at least 8 characters long.');
        }

        $user_captcha = $_POST['captcha'];
        $actual_captcha = $_SESSION['captcha'];


        if ($user_captcha == $actual_captcha){

        $sql = "INSERT INTO users (username, password, email) VALUES (:username, :password, :email)";
        $stmt = $pdo->prepare($sql);

        try {
            $stmt->execute(['username' => $username, 'password' => $password, 'email' => $email]);
            header('Location: login.php');



        } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
                echo 
                '<div id="modal-background" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex items-center justify-center">
                <!-- Modal Content -->
                <div class="bg-white p-8 rounded shadow-md w-1/2">
                    <h2 class="text-2xl mb-4">Dikkat..!</h2>
                    <p id="modal-message" class="mb-4"></p>
                    <button class="bg-red-500 text-white font-bold py-2 px-4 rounded" onclick="closeModal()">Kapat</button>
                </div>
            </div>';
                
                
                
            } else {
                echo "Bir hata oluştu: " . $e->getMessage();
            }
        }}else {
            echo '<div id="modal-background" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex items-center justify-center">
            <!-- Modal Content -->
            <div class="bg-white p-8 rounded shadow-md w-1/2">
                <h2 class="text-2xl mb-4">Dikkat..!</h2>
                <p id="modal-message" class="mb-4"></p>
                <button class="bg-red-500 text-white font-bold py-2 px-4 rounded" onclick="closeModal()">Kapat</button>
            </div>
        </div>';
         
        
           
        }
    }


    ?>

<script>
        function openModal(message) {
            document.getElementById('modal-message').textContent = message;
            document.getElementById('modal-background').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modal-background').classList.add('hidden');
        }

        // Sayfa yüklendiğinde hata mesajı kontrolü
        document.addEventListener('DOMContentLoaded', function() {
            const hasError = true;  // Hata kontrolü (örnek olarak true ayarlandı)
            if (hasError) {
                openModal('Değerini Yanlış Yazdınız / Bu kullanıcı adı veya email zaten kayıtlı');
            }
        });

        function openModal(message) {
            document.getElementById('modal-message').textContent = message;
            document.getElementById('modal-background1').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modal-background1').classList.add('hidden');
        }

        // Sayfa yüklendiğinde hata mesajı kontrolü
        document.addEventListener('DOMContentLoaded', function() {
            const hasError = true;  // Hata kontrolü (örnek olarak true ayarlandı)
            if (hasError) {
                openModal('işlem tmm');
            }
        });
    </script>
    </body>
</html>

