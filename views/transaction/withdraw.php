<?php include __DIR__ . '/../style/head.php'; ?>
<body class="bg-gray-100 min-h-screen">
<div class="container mx-auto py-8">
  <h2 class="text-2xl font-bold mb-4 text-pink-700">Saque</h2>
  <form method="POST" action="" class="bg-white p-6 rounded shadow-md max-w-md mx-auto">
    <input type="number" name="valor" min="1" step="0.01" placeholder="Valor do saque" required class="mb-3 w-full p-2 border rounded">
    <button type="submit" class="w-full bg-pink-600 text-white py-2 rounded hover:bg-pink-700 transition">Sacar</button>
  </form>
</div>
<?php include __DIR__ . '/../style/footer.php'; ?>
</body>
