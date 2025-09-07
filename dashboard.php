
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
$ultimasTransacoes = array_slice($transacoes, 0, 3);
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
    <div class="rounded-xl shadow-xl p-4 mb-6 border" style="background-color:#1F1F1F;border-color:#7C4DFF;">
      <h3 class="text-lg font-bold mb-2 flex items-center gap-2" style="color:#7C4DFF;"><span class="material-icons align-middle">sports_soccer</span>Eventos em Destaque</h3>
      <div class="flex flex-col gap-3">
        <div class="flex items-center gap-2 rounded p-2 border" style="background-color:#121212;border-color:#7C4DFF;">
          <span class="font-bold" style="color:#7C4DFF;">Futebol</span>
          <span style="color:#E0E0E0;">Flamengo vs Palmeiras</span>
          <span class="px-2 py-1 rounded font-bold" style="background-color:#7C4DFF;color:#FFFFFF;box-shadow:0 0 8px #7C4DFF;">1.80</span>
          <span class="px-2 py-1 rounded font-bold" style="background-color:#FF1744;color:#FFFFFF;box-shadow:0 0 8px #FF1744;">2.10</span>
          <span class="px-2 py-1 rounded font-bold" style="background-color:#2979FF;color:#FFFFFF;box-shadow:0 0 8px #2979FF;">3.50</span>
        </div>
        <div class="flex items-center gap-2 rounded p-2 border" style="background-color:#121212;border-color:#7C4DFF;">
          <span class="font-bold" style="color:#7C4DFF;">Basquete</span>
          <span style="color:#E0E0E0;">Lakers vs Celtics</span>
          <span class="px-2 py-1 rounded font-bold" style="background-color:#7C4DFF;color:#FFFFFF;box-shadow:0 0 8px #7C4DFF;">1.95</span>
          <span class="px-2 py-1 rounded font-bold" style="background-color:#FF1744;color:#FFFFFF;box-shadow:0 0 8px #FF1744;">2.30</span>
        </div>
        <div class="flex items-center gap-2 rounded p-2 border" style="background-color:#121212;border-color:#7C4DFF;">
          <span class="font-bold" style="color:#7C4DFF;">Tênis</span>
          <span style="color:#E0E0E0;">Nadal vs Federer</span>
          <span class="px-2 py-1 rounded font-bold" style="background-color:#7C4DFF;color:#FFFFFF;box-shadow:0 0 8px #7C4DFF;">1.60</span>
          <span class="px-2 py-1 rounded font-bold" style="background-color:#FF1744;color:#FFFFFF;box-shadow:0 0 8px #FF1744;">2.80</span>
        </div>
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
    <a href="views/bet/brasileirao.php" class="px-6 py-3 rounded-xl font-bold text-lg" style="background-color:#00E676;color:#121212;box-shadow:0 0 8px #00E676;">Brasileirão</a>
    <a href="views/user/profile.php" class="px-6 py-3 rounded-xl font-bold text-lg" style="background-color:#2979FF;color:#FFFFFF;box-shadow:0 0 8px #2979FF;">Perfil</a>
      </div>
    </div>
    <!-- Últimas apostas -->
    <div class="rounded-xl shadow-xl p-6 border" style="background-color:#1F1F1F;border-color:#7C4DFF;">
      <h3 class="text-xl font-bold mb-4 flex items-center gap-2" style="color:#7C4DFF;"><span class="material-icons align-middle">sports_esports</span>Últimas Apostas</h3>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <?php foreach($ultimasApostas as $a): ?>
        <div class="rounded-lg p-4 flex flex-col gap-2 shadow-md border" style="background-color:#121212;border-color:#7C4DFF;">
          <div class="flex items-center gap-2">
            <span class="material-icons" style="color:#7C4DFF;">sports_soccer</span>
            <span class="font-bold" style="color:#E0E0E0;"><?php echo $a['descricao']; ?></span>
          </div>
          <div class="flex gap-2 text-lg">
            <span class="px-2 py-1 rounded font-bold" style="background-color:#7C4DFF;color:#FFFFFF;box-shadow:0 0 8px #7C4DFF;">Odd: <?php echo $a['odd']; ?></span>
            <span class="px-2 py-1 rounded font-bold" style="background-color:#00E676;color:#121212;box-shadow:0 0 8px #00E676;">R$ <?php echo number_format($a['valor'],2,',','.'); ?></span>
          </div>
          <div>
            <?php
              $status = $a['status'];
              $statusIcon = $status=='ganha' ? 'emoji_events' : ($status=='perdida' ? 'cancel' : 'hourglass_empty');
              $statusColor = $status=='ganha' ? '#00E676' : ($status=='perdida' ? '#FF1744' : '#616161');
              $statusText = $status=='ganha' ? '#121212' : '#FFFFFF';
            ?>
            <span class="inline-flex items-center gap-1 px-2 py-1 rounded font-bold" style="background-color:<?php echo $statusColor; ?>;color:<?php echo $statusText; ?>;box-shadow:0 0 8px <?php echo $statusColor; ?>;">
              <span class="material-icons text-base align-middle"><?php echo $statusIcon; ?></span>
              <?php echo ucfirst($status); ?>
            </span>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <!-- Últimas transações -->
    <div class="rounded-xl shadow-xl p-6 border" style="background-color:#1F1F1F;border-color:#7C4DFF;">
      <h3 class="text-xl font-bold mb-4 flex items-center gap-2" style="color:#FF1744;"><span class="material-icons align-middle">account_balance_wallet</span>Últimas Transações</h3>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <?php foreach($ultimasTransacoes as $t): ?>
        <div class="rounded-lg p-4 flex flex-col gap-2 shadow-md border" style="background-color:#121212;border-color:#7C4DFF;">
          <div class="flex items-center gap-2">
            <?php
              $icon = $t['tipo']=='deposito' ? 'arrow_downward' : 'arrow_upward';
              $iconColor = $t['tipo']=='deposito' ? '#00E676' : '#FF1744';
            ?>
            <span class="material-icons" style="color:<?php echo $iconColor; ?>;filter:drop-shadow(0 0 8px <?php echo $iconColor; ?>);"><?php echo $icon; ?></span>
            <span class="font-bold" style="color:#E0E0E0;"><?php echo ucfirst($t['tipo']); ?></span>
          </div>
          <div class="flex gap-2 text-lg">
            <span class="px-2 py-1 rounded font-bold" style="background-color:#2979FF;color:#FFFFFF;box-shadow:0 0 8px #2979FF;">R$ <?php echo number_format($t['valor'],2,',','.'); ?></span>
            <span class="text-xs" style="color:#616161;"><?php echo $t['data']; ?></span>
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
