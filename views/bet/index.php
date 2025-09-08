
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
<div class="max-w-5xl mx-auto py-8 px-2">
  <h2 class="text-3xl font-extrabold mb-8 text-center" style="color:#7C4DFF;letter-spacing:1px;text-shadow:0 0 8px #7C4DFF;">Aposte nos Jogos do Brasileirão</h2>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    <?php foreach($events as $e): ?>
    <div class="rounded-2xl shadow-2xl p-6 flex flex-col gap-4 border hover:scale-[1.03] transition-transform duration-200" style="background:linear-gradient(120deg,#1F1F1F 80%,#7C4DFF 100%);border-color:#7C4DFF;">
      <div class="flex items-center gap-3 mb-2">
        <span class="font-bold text-lg" style="color:#E0E0E0;"><?php echo $e['descricao']; ?></span>
      </div>
      <div class="flex gap-4 items-center">
        <span class="text-sm font-bold px-2 py-1 rounded" style="background-color:#616161;color:#E0E0E0;">Data: <?php echo $e['data']; ?></span>
      </div>
      <div class="flex gap-2 justify-center mb-2">
        <span class="px-3 py-2 rounded-xl font-bold text-lg shadow" style="background-color:#7C4DFF;color:#FFFFFF;box-shadow:0 0 8px #7C4DFF;">Mandante: <?php echo $e['odd_home']; ?></span>
        <span class="px-3 py-2 rounded-xl font-bold text-lg shadow" style="background-color:#616161;color:#FFFFFF;">Empate: <?php echo $e['odd_draw']; ?></span>
        <span class="px-3 py-2 rounded-xl font-bold text-lg shadow" style="background-color:#2979FF;color:#FFFFFF;box-shadow:0 0 8px #2979FF;">Visitante: <?php echo $e['odd_away']; ?></span>
      </div>
      <form method="POST" action="place.php" class="flex flex-col gap-2 items-center">
        <input type="hidden" name="evento_id" value="<?php echo $e['id']; ?>">
        <input type="hidden" name="resultado" value="<?php echo $e['resultado']; ?>">
        <div class="flex gap-2 w-full">
          <input type="number" name="valor" min="1" step="0.01" placeholder="Valor da aposta" class="w-1/2 p-2 rounded text-lg" style="background-color:#1F1F1F;color:#E0E0E0;border:1px solid #7C4DFF;">
          <select name="aposta" class="w-1/2 p-2 rounded text-lg" style="background-color:#1F1F1F;color:#E0E0E0;border:1px solid #7C4DFF;">
            <option value="home">Mandante</option>
            <option value="draw">Empate</option>
            <option value="away">Visitante</option>
          </select>
        </div>
        <button type="submit" class="w-full font-bold py-3 rounded-xl mt-2 text-lg shadow-lg" style="background-color:#00E676;color:#121212;box-shadow:0 0 8px #00E676;">Apostar</button>
      </form>
    </div>
    <?php endforeach; ?>
  </div>
</div>
<?php
// Exemplo de histórico de apostas (substitua por dados reais do usuário)
$historicoApostas = [
  [
    'descricao' => 'Palmeiras x Goiás',
    'placar' => '3 x 0',
    'odd' => 1.45,
    'valor' => 50.00,
    'status' => 'ganha',
  ],
  [
    'descricao' => 'Flamengo x Bahia',
    'placar' => '2 x 1',
    'odd' => 1.70,
    'valor' => 30.00,
    'status' => 'perdida',
  ],
  [
    'descricao' => 'Corinthians x Internacional',
    'placar' => '1 x 1',
    'odd' => 3.20,
    'valor' => 20.00,
    'status' => 'pendente',
  ],
];
?>

<div class="mt-16">
  <h2 class="text-3xl font-extrabold mb-6 text-center" style="color:#7C4DFF;text-shadow:0 0 8px #7C4DFF;">Histórico de Apostas</h2>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    <?php foreach($historicoApostas as $a): ?>
    <div class="rounded-2xl p-6 flex flex-col gap-3 shadow-xl border hover:scale-[1.03] transition-transform duration-200" style="background-color:#121212;border-color:#7C4DFF;">
      <div class="flex items-center gap-3 mb-2">
        <span class="font-bold text-lg" style="color:#E0E0E0;"><?php echo $a['descricao']; ?></span>
        <?php if(isset($a['placar'])): ?>
          <span class="text-xs font-bold px-2 py-1 rounded" style="background-color:#121212;color:#7C4DFF;">Placar: <?php echo $a['placar']; ?></span>
        <?php endif; ?>
      </div>
      <div class="flex gap-2 items-center justify-between">
        <span class="px-4 py-2 rounded-xl font-bold text-xl shadow" style="background-color:#7C4DFF;color:#FFFFFF;box-shadow:0 0 8px #7C4DFF;">Odd: <?php echo $a['odd']; ?></span>
        <span class="px-4 py-2 rounded-xl font-bold text-xl shadow" style="background-color:#00E676;color:#121212;box-shadow:0 0 8px #00E676;">R$ <?php echo number_format($a['valor'],2,',','.'); ?></span>
      </div>
      <div>
        <?php
          $status = $a['status'];
          $statusIcon = $status=='ganha' ? 'emoji_events' : ($status=='perdida' ? 'cancel' : 'hourglass_empty');
          $statusColor = $status=='ganha' ? '#00E676' : ($status=='perdida' ? '#FF1744' : '#616161');
          $statusText = $status=='ganha' ? '#121212' : '#FFFFFF';
          $valorPremio = $status=='ganha' ? $a['valor']*$a['odd'] : 0;
        ?>
        <span class="inline-flex items-center gap-1 px-2 py-1 rounded font-bold" style="background-color:<?php echo $statusColor; ?>;color:<?php echo $statusText; ?>;box-shadow:0 0 8px <?php echo $statusColor; ?>;">
          <span class="material-icons text-base align-middle"><?php echo $statusIcon; ?></span>
          <?php
            if ($status == 'ganha') {
              echo 'Vitória (+R$ '.number_format($valorPremio,2,',','.') .')';
            } elseif ($status == 'perdida') {
              echo 'Perda (-R$ '.number_format($a['valor'],2,',','.') .')';
            } else {
              echo 'Pendente';
            }
          ?>
        </span>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>

<?php include __DIR__ . '/../style/footer.php'; ?>
</body>
