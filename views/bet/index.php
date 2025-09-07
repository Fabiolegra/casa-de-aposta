
<?php
if (!isset($events)) {
  require_once __DIR__ . '/../../models/Event.php';
  $eventModel = new Event();
  $events = $eventModel->listAll();
}
include __DIR__ . '/../style/head.php';
?>
<body class="min-h-screen" style="background-color:#121212;">
<div class="max-w-4xl mx-auto py-8 px-2">
  <h2 class="text-3xl font-bold mb-6" style="color:#7C4DFF;">Apostar em Eventos</h2>
  <table class="w-full rounded-xl shadow-xl mb-8" style="background-color:#1F1F1F;">
    <thead>
      <tr style="color:#7C4DFF;background-color:#1E1E1E;">
        <th class="py-2">Esporte</th>
        <th>Descrição</th>
        <th>Data</th>
        <th>Odds</th>
        <th>Apostar</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($events as $e): ?>
      <tr style="color:#E0E0E0;">
        <td><?php echo $e['esporte']; ?></td>
        <td><?php echo $e['descricao']; ?></td>
        <td><?php echo $e['data']; ?></td>
        <td>
          <span class="px-2 py-1 rounded font-bold" style="background-color:#7C4DFF;color:#FFFFFF;box-shadow:0 0 8px #7C4DFF;">Odd1: <?php echo $e['odd1']; ?></span>
          <span class="px-2 py-1 rounded font-bold" style="background-color:#FF1744;color:#FFFFFF;box-shadow:0 0 8px #FF1744;">Odd2: <?php echo $e['odd2']; ?></span>
          <span class="px-2 py-1 rounded font-bold" style="background-color:#2979FF;color:#FFFFFF;box-shadow:0 0 8px #2979FF;">Odd3: <?php echo $e['odd3']; ?></span>
        </td>
        <td>
          <form method="POST" action="place.php" class="flex flex-col gap-2">
            <input type="hidden" name="evento_id" value="<?php echo $e['id']; ?>">
            <input type="number" name="valor" min="1" step="0.01" placeholder="Valor" class="w-20 p-1 rounded mb-1" style="background-color:#1F1F1F;color:#E0E0E0;border:1px solid #7C4DFF;">
            <select name="odd" class="p-1 rounded mb-1" style="background-color:#1F1F1F;color:#E0E0E0;border:1px solid #7C4DFF;">
              <option value="<?php echo $e['odd1']; ?>">Odd1</option>
              <option value="<?php echo $e['odd2']; ?>">Odd2</option>
              <option value="<?php echo $e['odd3']; ?>">Odd3</option>
            </select>
            <button type="submit" class="font-bold px-3 py-1 rounded" style="background-color:#7C4DFF;color:#FFFFFF;box-shadow:0 0 8px #7C4DFF;">Apostar</button>
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php include __DIR__ . '/../style/footer.php'; ?>
</body>
