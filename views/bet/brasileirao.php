<?php
// Dados estáticos da 4ª rodada do Brasileirão 2023
$jogos = [
  [
    'dateEvent' => '2023-05-06',
    'strHomeTeam' => 'Palmeiras',
    'intHomeScore' => 3,
    'strAwayTeam' => 'Goiás',
    'intAwayScore' => 0,
    'odds' => ['home' => 1.45, 'draw' => 3.80, 'away' => 6.50]
  ],
  [
    'dateEvent' => '2023-05-06',
    'strHomeTeam' => 'Flamengo',
    'intHomeScore' => 2,
    'strAwayTeam' => 'Bahia',
    'intAwayScore' => 1,
    'odds' => ['home' => 1.70, 'draw' => 3.60, 'away' => 5.00]
  ],
  [
    'dateEvent' => '2023-05-07',
    'strHomeTeam' => 'Corinthians',
    'intHomeScore' => 1,
    'strAwayTeam' => 'Internacional',
    'intAwayScore' => 1,
    'odds' => ['home' => 2.10, 'draw' => 3.20, 'away' => 3.10]
  ],
  [
    'dateEvent' => '2023-05-07',
    'strHomeTeam' => 'Grêmio',
    'intHomeScore' => 2,
    'strAwayTeam' => 'Santos',
    'intAwayScore' => 0,
    'odds' => ['home' => 1.95, 'draw' => 3.40, 'away' => 4.20]
  ],
  [
    'dateEvent' => '2023-05-07',
    'strHomeTeam' => 'Atlético-MG',
    'intHomeScore' => 1,
    'strAwayTeam' => 'Botafogo',
    'intAwayScore' => 2,
    'odds' => ['home' => 2.30, 'draw' => 3.10, 'away' => 2.90]
  ],
];

$classificacao = [
  ['intRank'=>1,'name'=>'Palmeiras','intPoints'=>10,'intWin'=>3,'intDraw'=>1,'intLoss'=>0,'intGoalsFor'=>8,'intGoalsAgainst'=>2],
  ['intRank'=>2,'name'=>'Botafogo','intPoints'=>9,'intWin'=>3,'intDraw'=>0,'intLoss'=>1,'intGoalsFor'=>7,'intGoalsAgainst'=>4],
  ['intRank'=>3,'name'=>'Grêmio','intPoints'=>8,'intWin'=>2,'intDraw'=>2,'intLoss'=>0,'intGoalsFor'=>6,'intGoalsAgainst'=>3],
  ['intRank'=>4,'name'=>'Flamengo','intPoints'=>7,'intWin'=>2,'intDraw'=>1,'intLoss'=>1,'intGoalsFor'=>5,'intGoalsAgainst'=>4],
  ['intRank'=>5,'name'=>'Corinthians','intPoints'=>6,'intWin'=>1,'intDraw'=>3,'intLoss'=>0,'intGoalsFor'=>4,'intGoalsAgainst'=>3],
  ['intRank'=>6,'name'=>'Internacional','intPoints'=>5,'intWin'=>1,'intDraw'=>2,'intLoss'=>1,'intGoalsFor'=>3,'intGoalsAgainst'=>3],
  ['intRank'=>7,'name'=>'Bahia','intPoints'=>4,'intWin'=>1,'intDraw'=>1,'intLoss'=>2,'intGoalsFor'=>3,'intGoalsAgainst'=>5],
  ['intRank'=>8,'name'=>'Atlético-MG','intPoints'=>3,'intWin'=>1,'intDraw'=>0,'intLoss'=>3,'intGoalsFor'=>2,'intGoalsAgainst'=>6],
  ['intRank'=>9,'name'=>'Goiás','intPoints'=>2,'intWin'=>0,'intDraw'=>2,'intLoss'=>2,'intGoalsFor'=>2,'intGoalsAgainst'=>6],
  ['intRank'=>10,'name'=>'Santos','intPoints'=>1,'intWin'=>0,'intDraw'=>1,'intLoss'=>3,'intGoalsFor'=>1,'intGoalsAgainst'=>7],
];
?>
<?php include __DIR__ . '/../style/head.php'; ?>
<body class="min-h-screen" style="background-color:#121212;">
<div class="max-w-5xl mx-auto py-8 px-2">
  <h2 class="text-3xl font-bold mb-6" style="color:#7C4DFF;">Brasileirão Série A - 4ª Rodada (2025)</h2>
  <h3 class="text-xl font-bold mb-4" style="color:#2979FF;">Jogos e Resultados</h3>
  <table class="w-full rounded-xl shadow-xl mb-8" style="background-color:#1F1F1F;">
    <thead>
      <tr style="color:#7C4DFF;background-color:#1E1E1E;">
        <th>Data</th><th>Mandante</th><th>Placar</th><th>Visitante</th><th>Odds</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($jogos as $jogo): ?>
      <tr style="color:#E0E0E0;">
        <td><?php echo $jogo['dateEvent']; ?></td>
        <td><?php echo $jogo['strHomeTeam']; ?></td>
        <td><?php echo $jogo['intHomeScore'] . ' x ' . $jogo['intAwayScore']; ?></td>
        <td><?php echo $jogo['strAwayTeam']; ?></td>
        <td>
          <span class="px-2 py-1 rounded font-bold" style="background-color:#7C4DFF;color:#FFFFFF;box-shadow:0 0 8px #7C4DFF;">Mandante: <?php echo number_format($jogo['odds']['home'],2); ?></span>
          <span class="px-2 py-1 rounded font-bold" style="background-color:#616161;color:#FFFFFF;">Empate: <?php echo number_format($jogo['odds']['draw'],2); ?></span>
          <span class="px-2 py-1 rounded font-bold" style="background-color:#2979FF;color:#FFFFFF;box-shadow:0 0 8px #2979FF;">Visitante: <?php echo number_format($jogo['odds']['away'],2); ?></span>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <h3 class="text-xl font-bold mb-4" style="color:#00E676;">Classificação Atual</h3>
  <table class="w-full rounded-xl shadow-xl mb-8" style="background-color:#1F1F1F;">
    <thead>
      <tr style="color:#7C4DFF;background-color:#1E1E1E;">
        <th>Pos</th><th>Time</th><th>Pontos</th><th>Vitórias</th><th>Empates</th><th>Derrotas</th><th>Gols Pró</th><th>Gols Contra</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($classificacao as $time): ?>
      <tr style="color:#E0E0E0;">
        <td><?php echo $time['intRank']; ?></td>
        <td><?php echo $time['name']; ?></td>
        <td><?php echo $time['intPoints']; ?></td>
        <td><?php echo $time['intWin']; ?></td>
        <td><?php echo $time['intDraw']; ?></td>
        <td><?php echo $time['intLoss']; ?></td>
        <td><?php echo $time['intGoalsFor']; ?></td>
        <td><?php echo $time['intGoalsAgainst']; ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php include __DIR__ . '/../style/footer.php'; ?>
</body>
