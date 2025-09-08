
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
<body class="min-h-screen flex flex-col" style="background-color:#121212;">
<!-- Cabeçalho fixo -->
<header class="fixed top-0 left-0 w-full shadow-xl z-50 flex items-center justify-between px-4 py-3 border-b" style="background-color:#1E1E1E; border-color:#7C4DFF;">
  <div class="flex items-center gap-2">
    <img src="https://img.icons8.com/color/48/000000/coins.png" alt="Logo" class="h-8 w-8" style="filter:drop-shadow(0 0 8px #7C4DFF);">
    <span class="text-2xl font-bold" style="color:#7C4DFF;filter:drop-shadow(0 0 8px #7C4DFF);">LegraBet</span>
    <span class="ml-2 px-2 py-1 rounded text-xs font-bold animate-pulse" style="background-color:#FF1744;color:#FFFFFF;box-shadow:0 0 8px #FF1744;">Promoção: Bônus de boas-vindas!</span>
  </div>
  <div class="flex gap-2">
    <a href="views/user/profile.php" class="px-4 py-2 rounded font-semibold" style="background-color:#2979FF;color:#FFFFFF;box-shadow:0 0 8px #2979FF;">Perfil</a>
    <a href="views/auth/login.php?logout=1" class="px-4 py-2 rounded font-semibold" style="background-color:#616161;color:#FFFFFF;">Sair</a>
  </div>
</header>
<div class="h-16"></div>
<main class="flex flex-col md:flex-row gap-8 flex-1 px-2 md:px-8 py-8">
  <!-- Painel lateral de eventos -->
  <aside class="md:w-1/4 w-full mb-8 md:mb-0">
    <div class="rounded-2xl shadow-2xl p-6 mb-6 border" style="background:linear-gradient(120deg,#1F1F1F 80%,#7C4DFF 100%);border-color:#7C4DFF;">
      <h3 class="text-2xl font-extrabold mb-6 flex items-center gap-2" style="color:#7C4DFF;letter-spacing:1px;text-shadow:0 0 8px #7C4DFF;"><span class="material-icons align-middle">sports_soccer</span>Eventos em Destaque</h3>
      <div class="flex flex-col gap-6">
        <?php
        // Lista de 3 eventos exemplo
        $eventosDestaque = [
          ['esporte'=>'Futebol','descricao'=>'Flamengo vs Palmeiras','odds'=>[1.80,2.10,3.50]],
          ['esporte'=>'Basquete','descricao'=>'Lakers vs Celtics','odds'=>[1.95,2.30]],
          ['esporte'=>'Tênis','descricao'=>'Nadal vs Federer','odds'=>[1.60,2.80]],
        ];
        foreach($eventosDestaque as $evento): ?>
        <div class="rounded-xl p-4 flex flex-col items-center justify-between gap-4 shadow-xl border hover:scale-[1.03] transition-transform duration-200" style="background-color:#121212;border-color:#7C4DFF;">
          <span class="font-bold text-lg mb-2" style="color:#7C4DFF;"><?php echo $evento['esporte']; ?></span>
          <span class="font-bold text-lg mb-2" style="color:#E0E0E0;"><?php echo $evento['descricao']; ?></span>
          <div class="flex gap-2">
            <?php foreach($evento['odds'] as $i=>$odd): ?>
              <span class="px-3 py-2 rounded-xl font-bold text-lg shadow"
                style="background-color:<?php echo $i==0?'#7C4DFF':($i==1?'#FF1744':'#2979FF'); ?>;color:#FFFFFF;box-shadow:0 0 8px <?php echo $i==0?'#7C4DFF':($i==1?'#FF1744':'#2979FF'); ?>;">
                <?php echo $odd; ?>
              </span>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="rounded-xl shadow-xl p-4 border" style="background-color:#1F1F1F;border-color:#7C4DFF;">
      <h3 class="text-lg font-bold mb-2" style="color:#FF1744;">Aposte agora!</h3>
      <a href="views/bet/index.php" class="block w-full font-bold py-3 rounded-xl text-center" style="background-color:#7C4DFF;color:#FFFFFF;box-shadow:0 0 8px #7C4DFF;">Ver todos os eventos</a>
    </div>
  </aside>
  <!-- Conteúdo principal -->
  <section class="flex-1 flex flex-col gap-8">
    <!-- Card de saldo -->
    <div class="rounded-xl shadow-xl p-6 flex flex-col md:flex-row items-center justify-between gap-6 border" style="background:linear-gradient(90deg,#7C4DFF 0%,#1E1E1E 50%,#2979FF 100%);border-color:#7C4DFF;">
      <div>
        <span class="text-lg font-bold mb-2 block" style="color:#E0E0E0;">Saldo Atual</span>
        <span class="text-5xl font-extrabold" style="color:#00E676;filter:drop-shadow(0 0 8px #00E676);">R$ <?php echo number_format($saldo,2,',','.'); ?></span>
      </div>
      <div class="flex gap-3 mt-4 md:mt-0">
  <a href="views/transaction/deposit.php" class="px-6 py-3 rounded-xl font-bold text-lg" style="background-color:#7C4DFF;color:#FFFFFF;box-shadow:0 0 8px #7C4DFF;">Depositar</a>
  <a href="views/transaction/withdraw.php" class="px-6 py-3 rounded-xl font-bold text-lg" style="background-color:#FF1744;color:#FFFFFF;box-shadow:0 0 8px #FF1744;">Sacar</a>
  <a href="views/bet/index.php" class="px-6 py-3 rounded-xl font-bold text-lg" style="background-color:#7C4DFF;color:#FFFFFF;box-shadow:0 0 8px #7C4DFF;">Apostar</a>
      </div>
    </div>
    <!-- Últimas apostas -->
    <div class="rounded-xl shadow-xl p-6 border" style="background-color:#1F1F1F;border-color:#7C4DFF;">
      <h3 class="text-xl font-bold mb-4 flex items-center gap-2" style="color:#7C4DFF;"><span class="material-icons align-middle">sports_esports</span>Últimas Apostas</h3>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <?php foreach($ultimasApostas as $a): ?>
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
    <!-- Histórico de Depósitos/Saques -->
    <div class="rounded-xl shadow-2xl p-8 border" style="background:linear-gradient(120deg,#1F1F1F 80%,#7C4DFF 100%);border-color:#7C4DFF;">
      <h3 class="text-2xl font-extrabold mb-8 text-center" style="color:#FF1744;letter-spacing:1px;text-shadow:0 0 8px #FF1744;"><span class="material-icons align-middle">account_balance_wallet</span> Histórico de Depósitos/Saques</h3>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <?php foreach($ultimasTransacoes as $t): ?>
        <div class="rounded-2xl p-6 flex flex-col gap-3 shadow-xl border hover:scale-[1.03] transition-transform duration-200" style="background-color:#121212;border-color:#7C4DFF;">
          <div class="flex items-center gap-3 mb-2">
            <?php
              $icon = $t['tipo']=='deposito' ? 'arrow_downward' : 'arrow_upward';
              $iconColor = $t['tipo']=='deposito' ? '#00E676' : '#FF1744';
            ?>
            <span class="material-icons text-2xl" style="color:<?php echo $iconColor; ?>;filter:drop-shadow(0 0 8px <?php echo $iconColor; ?>);background-color:#1E1E1E;border-radius:8px;padding:4px;"><?php echo $icon; ?></span>
            <span class="font-bold text-lg" style="color:#E0E0E0;"><?php echo ucfirst($t['tipo']); ?></span>
          </div>
          <div class="flex gap-2 items-center justify-between">
            <span class="px-4 py-2 rounded-xl font-bold text-xl shadow" style="background-color:#2979FF;color:#FFFFFF;box-shadow:0 0 8px #2979FF;">R$ <?php echo number_format($t['valor'],2,',','.'); ?></span>
            <span class="text-xs font-semibold px-2 py-1 rounded" style="background-color:#616161;color:#E0E0E0;"><?php echo $t['data']; ?></span>
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
