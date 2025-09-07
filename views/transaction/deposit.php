<?php
session_start();
require_once __DIR__ . '/../../models/Transaction.php';
$msg = '';
if (!isset($_SESSION['user_id'])) {
  header('Location: ../auth/login.php');
  exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $valor = floatval($_POST['valor'] ?? 0);
  if ($valor <= 0) {
    $msg = '<div style="color:#FF1744;" class="mb-2">Valor inválido.</div>';
  } else {
    $transModel = new Transaction();
    $transModel->deposit($_SESSION['user_id'], $valor);
    echo '<div style="color:#00E676;" class="mb-2">Depósito realizado com sucesso! Redirecionando...</div>';
    echo '<script>setTimeout(function(){ window.location.href = "../../dashboard.php"; }, 1500);</script>';
    exit;
  }
}
?>
<?php include __DIR__ . '/../style/head.php'; ?>
<body class="min-h-screen" style="background-color:#121212;">
<div class="max-w-md mx-auto py-8 px-2">
  <h2 class="text-2xl font-bold mb-4" style="color:#7C4DFF;">Depósito</h2>
  <?php if($msg) echo $msg; ?>
  <form method="POST" action="" class="rounded-xl shadow-xl p-6" style="background-color:#1F1F1F;">
    <input type="number" name="valor" min="1" step="0.01" placeholder="Valor do depósito" required class="mb-3 w-full p-2 rounded" style="background-color:#1F1F1F;color:#E0E0E0;border:1px solid #7C4DFF;">
    <button type="submit" class="w-full font-bold py-2 rounded" style="background-color:#7C4DFF;color:#FFFFFF;box-shadow:0 0 8px #7C4DFF;">Depositar</button>
  </form>
</div>
<?php include __DIR__ . '/../style/footer.php'; ?>
</body>
