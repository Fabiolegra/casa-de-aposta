
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
<body class="min-h-screen" style="background-color:#000000;">
<div class="max-w-5xl mx-auto py-8 px-2">
  <h2 class="text-3xl font-extrabold mb-8 text-center" style="color:#FFD700;letter-spacing:1px;">Aposte nos Jogos do Brasileirão</h2>
  <form method="POST" action="place.php" id="form-combinada">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      <?php foreach($events as $e): ?>
  <div class="rounded-2xl p-6 flex flex-col gap-4 border hover:scale-[1.03] transition-transform duration-200" style="background-color:#1A1A1A;border-color:#FFD700;">
        <div class="flex items-center gap-3 mb-2">
          <span class="font-bold text-lg" style="color:#FFD700;"><?php echo $e['descricao']; ?></span>
        </div>
        <div class="flex gap-4 items-center">
          <span class="text-sm font-bold px-2 py-1 rounded" style="background-color:#FFD700;color:#000000;">Data: <?php echo $e['data']; ?></span>
        </div>
        <div class="flex gap-2 justify-center mb-2">
          <label class="flex flex-col items-center">
            <input type="checkbox" name="selecionados[]" value="<?php echo $e['id']; ?>" class="form-checkbox h-5 w-5 text-[#7C4DFF]" onchange="toggleAposta(this, <?php echo $e['id']; ?>)">
            <span class="text-xs mt-1" style="color:#FFD700;">Selecionar</span>
          </label>
          <span class="px-3 py-2 rounded-xl font-bold text-lg" style="background-color:#FFD700;color:#000000;">Mandante: <?php echo $e['odd_home']; ?></span>
          <span class="px-3 py-2 rounded-xl font-bold text-lg" style="background-color:#FFD700;color:#000000;">Empate: <?php echo $e['odd_draw']; ?></span>
          <span class="px-3 py-2 rounded-xl font-bold text-lg" style="background-color:#FFD700;color:#000000;">Visitante: <?php echo $e['odd_away']; ?></span>
        </div>
        <div class="flex gap-2 w-full" id="aposta-<?php echo $e['id']; ?>" style="display:none;">
          <select name="aposta[<?php echo $e['id']; ?>]" class="w-1/2 p-2 rounded text-lg" style="background-color:#FFEB3B;color:#000000;border:1px solid #FFD700;">
            <option value="home">Mandante</option>
            <option value="draw">Empate</option>
            <option value="away">Visitante</option>
          </select>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <div class="mt-8 flex flex-col items-center gap-4">
  <input type="number" name="valor_combinada" min="1" step="0.01" placeholder="Valor total da aposta combinada" class="w-1/2 p-3 rounded-xl text-lg" style="background-color:#FFEB3B;color:#000000;border:2px solid #FFD700;">
  <button type="submit" class="w-full font-bold py-3 rounded-xl text-lg" style="background-color:#FFD700;color:#000000;">Apostar Combinada</button>
    </div>
  </form>
  <script>
    function toggleAposta(checkbox, id) {
      var el = document.getElementById('aposta-' + id);
      el.style.display = checkbox.checked ? 'flex' : 'none';
    }
  </script>
</div>
<?php
require_once __DIR__ . '/../../models/Bet.php';
session_start();
$betModel = new Bet();
$historicoApostas = $betModel->history($_SESSION['user_id']);
?>
<div class="mt-16">
  <h2 class="text-3xl font-extrabold mb-6 text-center" style="color:#FFD700;">Histórico de Apostas</h2>
  <div class="flex justify-center gap-8 mb-8">
    <div class="flex items-center gap-2">
      <span class="material-icons text-[#7C4DFF] text-2xl">sports_esports</span>
  <span class="font-semibold text-lg" style="color:#FFD700;">Aposta</span>
    </div>
    <div class="flex items-center gap-2">
      <span class="material-icons text-[#FFD700] text-2xl">emoji_events</span>
  <span class="font-semibold text-lg" style="color:#FFD700;">Ganho</span>
    </div>
    <div class="flex items-center gap-2">
      <span class="material-icons text-[#616161] text-2xl">cancel</span>
  <span class="font-semibold text-lg" style="color:#FFD700;">Perda</span>
    </div>
  </div>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    <?php foreach($historicoApostas as $a): ?>
  <div class="rounded-xl p-6 flex flex-col gap-3 border hover:scale-[1.02] transition-transform duration-200" style="background-color:#1A1A1A;border-color:#FFD700;">
      <div class="flex items-center gap-2 mb-2">
  <span class="font-bold text-lg" style="color:#FFD700;"><?php echo $a['descricao']; ?></span>
        <?php if(isset($a['placar'])): ?>
          <span class="text-xs font-bold px-2 py-1 rounded" style="background-color:#FFD700;color:#000000;">Placar: <?php echo $a['placar']; ?></span>
        <?php endif; ?>
      </div>
      <div class="flex gap-2 items-center justify-between">
  <span class="px-4 py-2 rounded-xl font-bold text-xl" style="background-color:#FFD700;color:#000000;">Odd: <?php echo $a['odd']; ?></span>
  <span class="px-4 py-2 rounded-xl font-bold text-xl" style="background-color:#FFD700;color:#000000;">R$ <?php echo number_format($a['valor'],2,',','.'); ?></span>
      </div>
      <div>
        <?php
          $status = $a['status'];
          $statusIcon = $status=='ganha' ? 'emoji_events' : ($status=='perdida' ? 'cancel' : 'hourglass_empty');
          $statusColor = $status=='ganha' ? '#00E676' : ($status=='perdida' ? '#FF1744' : '#616161');
          $statusText = $status=='ganha' ? '#121212' : '#FFFFFF';
          $valorPremio = $status=='ganha' ? $a['valor']*$a['odd'] : 0;
        ?>
  <span class="inline-flex items-center gap-1 px-2 py-1 rounded font-bold" style="background-color:<?php echo $statusColor; ?>;color:<?php echo $statusText; ?>;">
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
