
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
<body class="bg-gradient-to-br from-blue-600 via-purple-600 to-pink-500 min-h-screen">
<div class="container mx-auto py-8 px-2">
  <h2 class="text-3xl font-extrabold mb-6 text-white drop-shadow">Bem-vindo à LegraBet!</h2>
  <div class="mb-8 flex flex-col md:flex-row gap-6 items-center justify-center">
    <div class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center w-full md:w-1/3">
      <span class="text-lg font-bold text-gray-700 mb-2">Saldo Atual</span>
      <span class="text-4xl font-extrabold text-green-600 mb-2">R$ <?php echo number_format($saldo,2,',','.'); ?></span>
      <a href="views/transaction/deposit.php" class="mt-2 px-4 py-2 rounded bg-green-600 text-white font-semibold hover:bg-green-700">Depositar</a>
      <a href="views/transaction/withdraw.php" class="mt-2 px-4 py-2 rounded bg-pink-600 text-white font-semibold hover:bg-pink-700">Sacar</a>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 w-full md:w-2/3">
      <a href="views/user/profile.php" class="block bg-blue-600 text-white rounded-xl shadow-lg p-6 text-center font-bold hover:bg-blue-700 transition">Perfil</a>
      <a href="views/bet/index.php" class="block bg-purple-600 text-white rounded-xl shadow-lg p-6 text-center font-bold hover:bg-purple-700 transition">Apostar</a>
      <a href="views/auth/login.php?logout=1" class="block bg-gray-400 text-white rounded-xl shadow-lg p-6 text-center font-bold hover:bg-gray-500 transition">Sair</a>
    </div>
  </div>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
    <div class="bg-white rounded-xl shadow-lg p-6">
      <h3 class="text-xl font-bold text-purple-700 mb-4">Últimas Apostas</h3>
      <table class="w-full text-sm">
        <thead><tr><th>Evento</th><th>Valor</th><th>Odd</th><th>Status</th></tr></thead>
        <tbody>
          <?php foreach($ultimasApostas as $a): ?>
          <tr>
            <td><?php echo $a['descricao']; ?></td>
            <td>R$ <?php echo number_format($a['valor'],2,',','.'); ?></td>
            <td><?php echo $a['odd']; ?></td>
            <td><span class="px-2 py-1 rounded <?php echo $a['status']=='ganha'?'bg-green-100 text-green-700':($a['status']=='perdida'?'bg-red-100 text-red-700':'bg-yellow-100 text-yellow-700'); ?>"><?php echo ucfirst($a['status']); ?></span></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <div class="bg-white rounded-xl shadow-lg p-6">
      <h3 class="text-xl font-bold text-pink-700 mb-4">Últimas Transações</h3>
      <table class="w-full text-sm">
        <thead><tr><th>Tipo</th><th>Valor</th><th>Data</th></tr></thead>
        <tbody>
          <?php foreach($ultimasTransacoes as $t): ?>
          <tr>
            <td><?php echo ucfirst($t['tipo']); ?></td>
            <td>R$ <?php echo number_format($t['valor'],2,',','.'); ?></td>
            <td><?php echo $t['data']; ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
  <p class="text-white text-center text-lg mt-8">Escolha uma ação acima para começar a apostar!</p>
</div>
<?php include 'views/style/footer.php'; ?>
</body>
