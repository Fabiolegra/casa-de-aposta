
<?php include __DIR__ . '/../style/head.php'; ?>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
  <form method="POST" action="/recover" class="bg-white p-6 rounded shadow-md w-full max-w-md">
    <h2 class="text-2xl font-bold mb-4 text-purple-700">Recuperar Senha</h2>
    <input type="email" name="email" placeholder="E-mail cadastrado" required class="mb-3 w-full p-2 border rounded">
    <button type="submit" class="w-full bg-purple-600 text-white py-2 rounded hover:bg-purple-700 transition">Enviar link de recuperação</button>
    <p class="mt-3 text-sm text-center"><a href="/login" class="text-purple-600 hover:underline">Voltar ao login</a></p>
  </form>
<?php include __DIR__ . '/../style/footer.php'; ?>
</body>
