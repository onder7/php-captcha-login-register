<?php
require_once("inc/baglan.php");
session_start();
if (isset($_SESSION['user_id'])) {

            $username=htmlspecialchars($_SESSION['username']);
            $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
            $stmt->execute(['username' => $username]);
            $user = $stmt->fetch();}
    ?>
   

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blog Profile Page</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
  <div class="flex justify-center items-center h-screen">
    <div class="bg-white shadow-lg rounded-lg max-w-4xl w-full mx-4">
      <div class="flex flex-col md:flex-row">
        <div class="md:w-1/3 bg-gray-200 rounded-l-lg">
          <div class="h-40 bg-cover bg-center" style="background-image: url('https://via.placeholder.com/400x300');">
          </div>
          <div class="flex justify-center -mt-12">
            <img src="https://via.placeholder.com/100" alt="Profile Picture" class="rounded-full border-4 border-white w-24 h-24">
          </div>
          <div class="text-center px-6 py-4">
            <h2 class="text-2xl font-bold"> <?php echo $user['username'];?></h2><a href="profil_update.php?id=<?php echo $user['id'];?>">Düzenle</a>
            <p class="text-gray-600 mb-4"> <?php echo $user['job'];?></p>
            <p class="text-gray-700 mb-4"> <?php echo $user['about'];?></p>
            <div class="flex justify-center space-x-4">
              <a href="#" class="text-blue-500 hover:text-blue-700">
                <i class="fab fa-twitter"><?php echo $user['about'];?></i>
              </a>
              <a href="#" class="text-blue-500 hover:text-blue-700">
                <i class="fab fa-linkedin-in"><?php echo $user['about'];?></i>
              </a>
              <a href="#" class="text-blue-500 hover:text-blue-700">
                <i class="fab fa-github"><?php echo $user['about'];?></i>
              </a>
            
            </div>
          </div>
        </div>
        <div class="md:w-2/3 p-6">
          <h2 class="text-2xl font-bold mb-4">Latest Blog Posts</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-gray-100 rounded-lg p-4">
              <img src="https://via.placeholder.com/300x200" alt="Blog Post Image" class="rounded-t-lg">
              <h3 class="text-lg font-bold mt-2">Blog Post Title</h3>
              <p class="text-gray-700 mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              <a href="#" class="text-blue-500 hover:text-blue-700 mt-2">Read More</a>
            </div>
            <div class="bg-gray-100 rounded-lg p-4">
              <img src="https://via.placeholder.com/300x200" alt="Blog Post Image" class="rounded-t-lg">
              <h3 class="text-lg font-bold mt-2">Another Blog Post</h3>
              <p class="text-gray-700 mt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              <a href="#" class="text-blue-500 hover:text-blue-700 mt-2">Read More</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://kit.fontawesome.com/your-font-awesome-kit.js"></script>
</body>
</html>
