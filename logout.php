<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Çıkış Yap</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        function logout() {
            document.getElementById('logout-form').submit();
        }
    </script>
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
    <div class="w-full max-w-xs">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h2 class="text-xl mb-4">Oturumu kapatmak istediğinize emin misiniz?</h2>
            <form id="logout-form" action="logout.php" method="post" class="flex items-center justify-between">
                <button type="submit" name="logout" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Çıkış Yap</button>
            </form>
        </div>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['logout'])) {
        session_start();
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit();
    }
    ?>
</body>
</html>
