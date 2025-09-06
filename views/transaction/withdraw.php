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
<body class="bg-gray-100 min-h-screen">
<div class="container mx-auto py-8">
  <h2 class="text-2xl font-bold mb-4 text-pink-700">Saque</h2>
  <?php if($msg) echo $msg; ?>
  <form method="POST" action="" class="bg-white p-6 rounded shadow-md max-w-md mx-auto">
  <input type="number" name="valor" min="1" step="0.01" placeholder="Valor do saque" required class="mb-3 w-full p-2 border rounded">
  <button type="submit" class="w-full bg-pink-600 text-white py-2 rounded hover:bg-pink-700 transition">Sacar</button>
  </form>
</div>
<?php include __DIR__ . '/../style/footer.php'; ?>
</body>
