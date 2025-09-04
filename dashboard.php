<?php
session_start();
if (!isset($_SESSION['user_id'])) { header('Location: views/auth/login.php'); exit; }
?>
<?php include 'views/style/head.php'; ?>
<body class="bg-gray-100 min-h-screen">
<div class="container mx-auto py-8">
  <h2 class="text-2xl font-bold mb-4 text-purple-700">Bem-vindo à LegraBet!</h2>
  <div class="mb-6">
    <a href="views/user/profile.php" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Perfil</a>
    <a href="views/bet/index.php" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Apostar</a>
    <a href="views/transaction/deposit.php" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Depositar</a>
    <a href="views/transaction/withdraw.php" class="bg-pink-600 text-white px-4 py-2 rounded hover:bg-pink-700">Sacar</a>
    <a href="views/auth/login.php?logout=1" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Sair</a>
  </div>
  <p class="text-gray-700">Escolha uma opção acima para começar.</p>
</div>
<?php include 'views/style/footer.php'; ?>
</body>
