
<?php include __DIR__ . '/../style/head.php'; ?>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
  <form method="POST" action="/login" class="bg-white p-6 rounded shadow-md w-full max-w-md">
    <h2 class="text-2xl font-bold mb-4 text-purple-700">Login</h2>
    <input type="email" name="email" placeholder="E-mail" required class="mb-3 w-full p-2 border rounded">
    <input type="password" name="senha" placeholder="Senha" required class="mb-3 w-full p-2 border rounded">
    <button type="submit" class="w-full bg-purple-600 text-white py-2 rounded hover:bg-purple-700 transition">Entrar</button>
    <p class="mt-3 text-sm text-center"><a href="recover.php" class="text-purple-600 hover:underline">Esqueci minha senha</a></p>
  </form>
<?php include __DIR__ . '/../style/footer.php'; ?>
</body>
