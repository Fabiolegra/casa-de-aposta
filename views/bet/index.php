
<?php
// Jogos da 4ª rodada do Brasileirão 2023
$events = [
  [
    'id' => 1,
    'esporte' => 'Futebol',
    'descricao' => 'Palmeiras x Goiás',
    'data' => '2023-05-06',
    'home' => 'Palmeiras',
    'away' => 'Goiás',
    'placar' => '3 x 0',
    'odd_home' => 1.45,
    'odd_draw' => 3.80,
    'odd_away' => 6.50,
    'resultado' => 'home'
  ],
  [
    'id' => 2,
    'esporte' => 'Futebol',
    'descricao' => 'Flamengo x Bahia',
    'data' => '2023-05-06',
    'home' => 'Flamengo',
    'away' => 'Bahia',
    'placar' => '2 x 1',
    'odd_home' => 1.70,
    'odd_draw' => 3.60,
    'odd_away' => 5.00,
    'resultado' => 'home'
  ],
  [
    'id' => 3,
    'esporte' => 'Futebol',
    'descricao' => 'Corinthians x Internacional',
    'data' => '2023-05-07',
    'home' => 'Corinthians',
    'away' => 'Internacional',
    'placar' => '1 x 1',
    'odd_home' => 2.10,
    'odd_draw' => 3.20,
    'odd_away' => 3.10,
    'resultado' => 'draw'
  ],
  [
    'id' => 4,
    'esporte' => 'Futebol',
    'descricao' => 'Grêmio x Santos',
    'data' => '2023-05-07',
    'home' => 'Grêmio',
    'away' => 'Santos',
    'placar' => '2 x 0',
    'odd_home' => 1.95,
    'odd_draw' => 3.40,
    'odd_away' => 4.20,
    'resultado' => 'home'
  ],
  [
    'id' => 5,
    'esporte' => 'Futebol',
    'descricao' => 'Atlético-MG x Botafogo',
    'data' => '2023-05-07',
    'home' => 'Atlético-MG',
    'away' => 'Botafogo',
    'placar' => '1 x 2',
    'odd_home' => 2.30,
    'odd_draw' => 3.10,
    'odd_away' => 2.90,
    'resultado' => 'away'
  ],
];
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
        <td><?php echo $e['descricao']; ?> <br><span style="color:#616161;">Placar: <?php echo $e['placar']; ?></span></td>
        <td><?php echo $e['data']; ?></td>
        <td>
          <span class="px-2 py-1 rounded font-bold" style="background-color:#7C4DFF;color:#FFFFFF;box-shadow:0 0 8px #7C4DFF;">Mandante: <?php echo $e['odd_home']; ?></span>
          <span class="px-2 py-1 rounded font-bold" style="background-color:#616161;color:#FFFFFF;">Empate: <?php echo $e['odd_draw']; ?></span>
          <span class="px-2 py-1 rounded font-bold" style="background-color:#2979FF;color:#FFFFFF;box-shadow:0 0 8px #2979FF;">Visitante: <?php echo $e['odd_away']; ?></span>
        </td>
        <td>
          <form method="POST" action="place.php" class="flex flex-col gap-2">
            <input type="hidden" name="evento_id" value="<?php echo $e['id']; ?>">
            <input type="hidden" name="resultado" value="<?php echo $e['resultado']; ?>">
            <input type="number" name="valor" min="1" step="0.01" placeholder="Valor" class="w-20 p-1 rounded mb-1" style="background-color:#1F1F1F;color:#E0E0E0;border:1px solid #7C4DFF;">
            <select name="aposta" class="p-1 rounded mb-1" style="background-color:#1F1F1F;color:#E0E0E0;border:1px solid #7C4DFF;">
              <option value="home">Mandante</option>
              <option value="draw">Empate</option>
              <option value="away">Visitante</option>
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
