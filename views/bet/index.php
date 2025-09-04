<?php include __DIR__ . '/../style/head.php'; ?>
<body class="bg-gray-100 min-h-screen">
<div class="container mx-auto py-8">
  <h2 class="text-2xl font-bold mb-4 text-purple-700">Apostar em Eventos</h2>
  <form method="POST" action="place.php" class="mb-6">
    <table class="w-full bg-white rounded shadow">
      <thead><tr><th>Esporte</th><th>Descrição</th><th>Data</th><th>Odds</th><th>Apostar</th></tr></thead>
      <tbody>
        <?php foreach($events as $e): ?>
        <tr>
          <td><?php echo $e['esporte']; ?></td>
          <td><?php echo $e['descricao']; ?></td>
          <td><?php echo $e['data']; ?></td>
          <td>
            <span class="px-2 py-1 bg-purple-100 text-purple-700 rounded">Odd1: <?php echo $e['odd1']; ?></span>
            <span class="px-2 py-1 bg-pink-100 text-pink-700 rounded">Odd2: <?php echo $e['odd2']; ?></span>
            <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded">Odd3: <?php echo $e['odd3']; ?></span>
          </td>
          <td>
            <input type="hidden" name="evento_id" value="<?php echo $e['id']; ?>">
            <input type="number" name="valor" min="1" step="0.01" placeholder="Valor" class="w-20 p-1 border rounded">
            <select name="odd" class="p-1 border rounded">
              <option value="<?php echo $e['odd1']; ?>">Odd1</option>
              <option value="<?php echo $e['odd2']; ?>">Odd2</option>
              <option value="<?php echo $e['odd3']; ?>">Odd3</option>
            </select>
            <button type="submit" class="bg-purple-600 text-white px-3 py-1 rounded hover:bg-purple-700">Apostar</button>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </form>
</div>
<?php include __DIR__ . '/../style/footer.php'; ?>
</body>
