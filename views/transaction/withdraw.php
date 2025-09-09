<?php
include __DIR__ . '/../style/head.php';
session_start();
require_once __DIR__ . '/../../models/Transaction.php';
require_once __DIR__ . '/../../models/User.php';
$msg = '';
if (!isset($_SESSION['user_id'])) {
  header('Location: ../auth/login.php');
  exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $valor = floatval($_POST['valor'] ?? 0);
  $userModel = new User();
  $saldo = $userModel->getSaldo($_SESSION['user_id']);
  if ($valor <= 0) {
    $msg = '<div class="text-red-600 mb-2">Valor inválido.</div>';
  } elseif ($valor > $saldo) {
    $msg = '<div class="text-red-600 mb-2">Saldo insuficiente.</div>';
  } else {
    $transModel = new Transaction();
    $transModel->withdraw($_SESSION['user_id'], $valor);
    $msg = '<div class="text-green-600 mb-2">Saque realizado com sucesso! Redirecionando...</div>';
    echo $msg;
    echo '<script>setTimeout(function(){ window.location.href = "../../dashboard.php"; }, 1500);</script>';
    exit;
  }
}
?>
<body class="min-h-screen flex flex-col" style="background-color:#000000;">
  <main class="flex-1 flex items-center justify-center">
    <div class="w-full max-w-md mx-auto py-8 px-4">
      <h2 class="text-2xl font-bold mb-4 text-center" style="color:#E0E0E0;">Saque</h2>
      <?php if($msg) echo $msg; ?>
  <form method="POST" action="" class="rounded-xl p-6 flex flex-col gap-6 border-2" style="background-color:#1A1A1A;border-color:#FFD700;">
    <label for="valor" class="font-bold mb-2" style="color:#FFD700;">Valor do saque</label>
    <input type="number" name="valor" id="valor" min="1" step="0.01" placeholder="Digite o valor" required class="w-full p-3 rounded-xl border-2 text-lg" style="background-color:#FFD700;color:#000000;border-color:#FFD700;">
    <button type="submit" class="w-full font-bold py-3 rounded-xl text-lg" style="background-color:#FFD700;color:#000000;">Sacar</button>
  </form>
    </div>
  </main>
  <footer class="w-full mt-auto">
    <?php include __DIR__ . '/../style/footer.php'; ?>
  </footer>
</body>
</body>
