<?php
if (!isset($events)) {
  require_once __DIR__ . '/../../models/Event.php';
  $eventModel = new Event();
  $events = $eventModel->listAll();
}
include __DIR__ . '/../style/head.php';
?>
<body class="bg-gray-100 min-h-screen">
<div class="container mx-auto py-8">
  <h2 class="text-2xl font-bold mb-4 text-purple-700">Apostar em Eventos</h2>
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
          <form method="POST" action="place.php" class="flex flex-col gap-2">
            <input type="hidden" name="evento_id" value="<?php echo $e['id']; ?>">
            <input type="number" name="valor" min="1" step="0.01" placeholder="Valor" class="w-20 p-1 border rounded mb-1">
            <select name="odd" class="p-1 border rounded mb-1">
              <option value="<?php echo $e['odd1']; ?>">Odd1</option>
              <option value="<?php echo $e['odd2']; ?>">Odd2</option>
              <option value="<?php echo $e['odd3']; ?>">Odd3</option>
            </select>
            <button type="submit" class="bg-purple-600 text-white px-3 py-1 rounded hover:bg-purple-700">Apostar</button>
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php include __DIR__ . '/../style/footer.php'; ?>
</body>
