<?php require_once("inc/baglan.php");?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Mobil Uyumlu Blog Sayfası</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        function toggleMenu() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        }
    </script>
</head>
<body class="bg-gray-100 text-gray-900">

    <!-- Navbar -->



    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <a href="#" class="flex-shrink-0 flex items-center">
                        <span class="text-xl font-bold">Blog</span>
                    </a>
                </div>
                <div class="hidden md:flex items-center">
                <a href="#" class="block text-gray-900 hover:text-blue-500 px-3 py-2 rounded-md text-base font-medium">Ana Sayfa</a>
                <?php
session_start();

if (isset($_SESSION['user_id'])) {
    
    $username=htmlspecialchars($_SESSION['username']);
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();
    if ($user['is_admin'])
    
    {
       
       echo '
        <a href="profil" class="block text-gray-900 hover:text-blue-500 px-3 py-2 rounded-md text-base font-medium"> '.htmlspecialchars($_SESSION['username']).'
        <a href="/admin">[Admin]</a></a>
        <a href="logout" class="block text-gray-900 hover:text-blue-500 px-3 py-2 rounded-md text-base font-medium">Çıkış Yap</a>
        
        ';
    }
    else{
        if ($user['is_admin']){}
        
        
        else{    echo '
            <a href="register" class="block text-gray-900 hover:text-blue-500 px-3 py-2 rounded-md text-base font-medium">Merhaba '.htmlspecialchars($_SESSION['username']).'</a>
            <a href="logout" class="block text-gray-900 hover:text-blue-500 px-3 py-2 rounded-md text-base font-medium">Çıkış Yap</a>
            
            ';}
    
       }
}



if (!isset($_SESSION['user_id'])) {
   echo '  <a href="register" class="block text-gray-900 hover:text-blue-500 px-3 py-2 rounded-md text-base font-medium">Kayıt Ol!</a>
   <a href="login" class="block text-gray-900 hover:text-blue-500 px-3 py-2 rounded-md text-base font-medium">Giriş Yap</a>';
  
}

?>
          
                </div>
                <div class="md:hidden flex items-center">
                    <button onclick="toggleMenu()" class="text-gray-900 hover:text-blue-500 focus:outline-none">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div id="mobile-menu" class="hidden md:hidden">
            <a href="#" class="block text-gray-900 hover:text-blue-500 px-3 py-2 rounded-md text-base font-medium">Ana Sayfa</a>
            <a href="register" class="block text-gray-900 hover:text-blue-500 px-3 py-2 rounded-md text-base font-medium">Kayıt Ol!</a>
            <a href="login" class="block text-gray-900 hover:text-blue-500 px-3 py-2 rounded-md text-base font-medium">Giriş Yap</a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <!-- Blog Post -->
        <article class="mb-8 bg-white p-6 rounded-lg shadow-lg">
            <header class="mb-4">
                <h1 class="text-3xl font-bold">Blog Başlığı</h1>
                <div class="flex items-center mt-2">
                    <img class="h-10 w-10 rounded-full mr-2" src="https://via.placeholder.com/150" alt="Yazar Fotoğrafı">
                    <div>
                        <p class="text-sm font-medium text-gray-700">Yazar İsmi</p>
                        <p class="text-sm text-gray-500">Tarih</p>
                    </div>
                </div>
            </header>
            <section class="prose prose-lg">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nec iaculis mauris. Vivamus semper quam at dui scelerisque, sit amet bibendum massa molestie. Aenean non lacus vel erat tincidunt bibendum. Integer tincidunt magna vitae metus malesuada sagittis.</p>
                <p>Morbi non est nec metus facilisis semper. Quisque facilisis placerat mauris, non interdum nulla sollicitudin sit amet. Praesent a urna at ligula sagittis convallis. Nulla facilisi. In hac habitasse platea dictumst.</p>
                <p>Nam ut ipsum euismod, vulputate libero in, accumsan augue. Cras aliquam turpis at odio tincidunt, nec congue arcu ultricies. Nulla facilisi. Donec at magna non tortor vestibulum bibendum. Aenean nec arcu ac elit venenatis viverra vel vel ipsum. Nulla facilisi.</p>
            </section>
        </article>

        <!-- Repeat Blog Post -->
        <article class="mb-8 bg-white p-6 rounded-lg shadow-lg">
            <header class="mb-4">
                <h1 class="text-3xl font-bold">Başka Bir Blog Başlığı</h1>
                <div class="flex items-center mt-2">
                    <img class="h-10 w-10 rounded-full mr-2" src="https://via.placeholder.com/150" alt="Yazar Fotoğrafı">
                    <div>
                        <p class="text-sm font-medium text-gray-700">Başka Bir Yazar</p>
                        <p class="text-sm text-gray-500">Başka Bir Tarih</p>
                    </div>
                </div>
            </header>
            <section class="prose prose-lg">
                <p>Bu, başka bir blog gönderisinin örnek içeriğidir. Aynı şekilde stilize edilmiş ve düzenlenmiştir. Burada da makale içeriği yer alır.</p>
            </section>
        </article>
    </main>

</body>
</html>
