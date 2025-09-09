
<?php
session_start();
if (!isset($_SESSION['user_id'])) { header('Location: views/auth/login.php'); exit; }
require_once __DIR__ . '/models/User.php';
require_once __DIR__ . '/models/Bet.php';
require_once __DIR__ . '/models/Transaction.php';
$userModel = new User();
$betModel = new Bet();
$transModel = new Transaction();
$saldo = $userModel->getSaldo($_SESSION['user_id']);
$apostas = $betModel->history($_SESSION['user_id']);
$ultimasApostas = array_slice($apostas, 0, 3);
$transacoes = $transModel->history($_SESSION['user_id']);
$ultimasTransacoes = array_slice($transacoes, 0, 9);
?>



<?php include 'views/style/head.php'; ?>
<body class="min-h-screen flex flex-col" style="background-color:#000000;font-family:'Segoe UI',Arial,sans-serif;color:#FFD700;">
<!-- Cabeçalho fixo -->
<header class="fixed top-0 left-0 w-full z-50 flex items-center justify-between px-4 py-3 border-b" style="background-color:#1A1A1A; border-color:#FFD700;">
  <div class="flex items-center gap-2">
    <img src="https://img.icons8.com/color/48/000000/coins.png" alt="Logo" class="h-8 w-8" style="filter:drop-shadow(0 0 8px #7C4DFF);">
  <span class="text-2xl font-extrabold tracking-wide" style="color:#FFD700;letter-spacing:1px;">LegraBet</span>
  <span class="ml-2 px-2 py-1 rounded text-xs font-bold animate-pulse" style="background-color:#FFD700;color:#121212;">Promoção: Bônus de boas-vindas!</span>
  </div>
  <div class="flex gap-2">
  <a href="views/user/profile.php" class="px-4 py-2 rounded-xl font-bold" style="background-color:#FFD700;color:#121212;">Perfil</a>
  <a href="views/auth/login.php?logout=1" class="px-4 py-2 rounded-xl font-bold" style="background-color:#FFD700;color:#121212;">Sair</a>
  </div>
</header>
<div class="h-16"></div>
<main class="flex flex-col md:flex-row gap-8 flex-1 px-2 md:px-8 py-8">
  <!-- Painel lateral de eventos -->
  <aside class="md:w-1/4 w-full mb-8 md:mb-0">
  <div class="rounded-2xl p-6 mb-6 border" style="background-color:#1A1A1A;border-color:#FFD700;">
  <h3 class="text-2xl font-extrabold mb-6 flex items-center gap-2" style="color:#FFD700;letter-spacing:1px;"><span class="material-icons align-middle" style="color:#FFD700;">sports_soccer</span>Eventos em Destaque</h3>
      <div class="flex flex-col gap-6">
        <?php
        // Lista de 3 eventos exemplo
        $eventosDestaque = [
          ['esporte'=>'Futebol','descricao'=>'Flamengo vs Palmeiras','odds'=>[1.80,2.10,3.50]],
          ['esporte'=>'Basquete','descricao'=>'Lakers vs Celtics','odds'=>[1.95,2.30]],
          ['esporte'=>'Tênis','descricao'=>'Nadal vs Federer','odds'=>[1.60,2.80]],
        ];
        foreach($eventosDestaque as $evento): ?>
  <div class="rounded-xl p-4 flex flex-col items-center justify-between gap-4 border hover:scale-[1.03] transition-transform duration-200" style="background-color:#1A1A1A;border-color:#FFD700;">
          <span class="font-bold text-lg mb-2" style="color:#FFD700;"><?php echo $evento['esporte']; ?></span>
          <span class="font-bold text-lg mb-2" style="color:#FFD700;"><?php echo $evento['descricao']; ?></span>
          <div class="flex gap-2">
            <?php foreach($evento['odds'] as $odd): ?>
              <span class="px-3 py-2 rounded-xl font-bold text-lg" style="background-color:#FFEB3B;color:#000000;">
                <?php echo $odd; ?>
              </span>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  <div class="rounded-xl p-4 border" style="background-color:#1A1A1A;border-color:#FFD700;">
  <h3 class="text-lg font-bold mb-2" style="color:#FFD700;">Aposte agora!</h3>
  <a href="views/bet/index.php" class="block w-full font-bold py-3 rounded-xl text-center hover:bg-[#FFC107]" style="background-color:#FFD700;color:#000000;">Ver todos os eventos</a>
    </div>
  </aside>
  <!-- Conteúdo principal -->
  <section class="flex-1 flex flex-col gap-8">
    <!-- Card de saldo -->
  <div class="rounded-xl p-6 flex flex-col md:flex-row items-center justify-between gap-6 border" style="background-color:#1A1A1A;border-color:#FFD700;">
      <div>
  <span class="text-lg font-bold mb-2 block" style="color:#FFC107;">Saldo Atual</span>
  <span class="text-5xl font-extrabold" style="color:#FFEB3B;">R$ <?php echo number_format($saldo,2,',','.'); ?></span>
      </div>
      <div class="flex gap-3 mt-4 md:mt-0">
  <a href="views/transaction/deposit.php" class="px-6 py-3 rounded-xl font-bold text-lg hover:bg-[#FFC107]" style="background-color:#FFD700;color:#000000;">Depositar</a>
  <a href="views/transaction/withdraw.php" class="px-6 py-3 rounded-xl font-bold text-lg hover:bg-[#FFC107]" style="background-color:#FFD700;color:#000000;">Sacar</a>
  <a href="views/bet/index.php" class="px-4 py-2 rounded-xl font-bold text-base" style="background-color:#00E676;color:#000000;border:2px solid #00E676;">Apostar</a>
      </div>
    </div>
    <!-- Últimas apostas -->
  <div class="rounded-xl p-6 border" style="background-color:#1A1A1A;border-color:#FFD700;">
  <h3 class="text-xl font-bold mb-4 flex items-center gap-2" style="color:#FFD700;"><span class="material-icons align-middle" style="color:#FFD700;">sports_esports</span>Últimas Apostas</h3>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <?php foreach($ultimasApostas as $a): ?>
  <div class="rounded-3xl p-7 flex flex-col gap-4 border-2 hover:scale-[1.04] transition-transform duration-200" style="background-color:#1A1A1A;border-color:#FFD700;">
          <div class="flex items-center gap-4 mb-3">
            <span class="font-bold text-lg" style="color:#FFC107;"><?php echo $a['descricao']; ?></span>
            <?php if(isset($a['placar'])): ?>
              <span class="text-xs font-bold px-2 py-1 rounded" style="background-color:#FFC107;color:#000000;">Placar: <?php echo $a['placar']; ?></span>
            <?php endif; ?>
          </div>
          <div class="flex gap-2 items-center justify-between">
            <span class="px-4 py-2 rounded-xl font-bold text-xl" style="background-color:#FFEB3B;color:#000000;">Odd: <?php echo $a['odd']; ?></span>
            <span class="px-4 py-2 rounded-xl font-bold text-xl" style="background-color:#FFEB3B;color:#000000;">R$ <?php echo number_format($a['valor'],2,',','.'); ?></span>
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
                  echo 'Derrota (-R$ '.number_format($a['valor'],2,',','.') .')';
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
    <!-- Histórico de Transações -->
  <div class="rounded-xl p-8 border" style="background-color:#1A1A1A;border-color:#FFD700;">
  <h3 class="text-2xl font-extrabold mb-8 text-center" style="color:#FFD700;letter-spacing:1px;"><span class="material-icons align-middle" style="color:#FFD700;">account_balance_wallet</span> Histórico de Transações</h3>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <?php foreach($ultimasTransacoes as $t): ?>
  <div class="rounded-xl p-6 flex flex-col gap-3 border hover:scale-[1.02] transition-transform duration-200" style="background-color:#1A1A1A;border-color:#FFD700;">
          <div class="flex items-center gap-2 mb-2">
            <?php
              if ($t['tipo'] == 'deposito') {
                $icon = 'arrow_downward';
                $iconColor = '#00E676';
                $tipoLabel = 'Depósito';
              } elseif ($t['tipo'] == 'saque') {
                $icon = 'arrow_upward';
                $iconColor = '#FF1744';
                $tipoLabel = 'Saque';
              } elseif ($t['tipo'] == 'aposta') {
                $icon = 'sports_esports';
                $iconColor = '#FFD700'; // amarelo
                $tipoLabel = 'Aposta';
              } elseif ($t['tipo'] == 'ganho') {
                $icon = 'emoji_events';
                $iconColor = '#00E676'; // verde
                $tipoLabel = 'Ganho';
              } elseif ($t['tipo'] == 'derrota') {
                $icon = 'cancel';
                $iconColor = '#FF1744'; // vermelho
                $tipoLabel = 'Derrota';
              } else {
                $icon = 'help_outline';
                $iconColor = '#616161';
                $tipoLabel = ucfirst($t['tipo']);
              }
            ?>
            <span class="material-icons text-2xl" style="color:<?php echo $iconColor; ?>;background-color:transparent;border-radius:8px;padding:2px;"><?php echo $icon; ?></span>
            <span class="font-bold text-lg" style="color:#FFD700;"><?php echo $tipoLabel; ?></span>
          </div>
          <div class="flex gap-2 items-center justify-between">
            <span class="px-4 py-2 rounded-xl font-bold text-xl" style="background-color:#FFD700;color:#000000;">R$ <?php echo number_format($t['valor'],2,',','.'); ?></span>
            <span class="text-xs font-semibold px-2 py-1 rounded" style="background-color:#FFD700;color:#000000;"><?php echo date('d/m/Y H:i', strtotime($t['data'])); ?></span>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
</main>
<p class="text-[#616161] text-center text-lg mt-8">Escolha uma ação acima para começar a apostar!</p>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<?php include 'views/style/footer.php'; ?>
</body>
