<?php
include __DIR__ . '/../style/head.php';
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
        $msg = '<div class="text-red-600 mb-2">Valor inválido.</div>';
  } else {
    $transModel = new Transaction();
    $transModel->deposit($_SESSION['user_id'], $valor);
    $msg = '<div class="text-green-600 mb-2">Depósito realizado com sucesso! Redirecionando...</div>';
    echo $msg;
    echo '<script>setTimeout(function(){ window.location.href = "../../dashboard.php"; }, 1500);</script>';
    exit;
  }
}
?>
<body class="bg-gray-100 min-h-screen">
<div class="container mx-auto py-8">
  <h2 class="text-2xl font-bold mb-4 text-green-700">Depósito</h2>
  <?php if($msg) echo $msg; ?>
  <form method="POST" action="" class="bg-white p-6 rounded shadow-md max-w-md mx-auto">
    <input type="number" name="valor" min="1" step="0.01" placeholder="Valor do depósito" required class="mb-3 w-full p-2 border rounded">
    <button type="submit" class="w-full bg-green-600 text-white py-2 rounded hover:bg-green-700 transition">Depositar</button>
  </form>
</div>
<?php include __DIR__ . '/../style/footer.php'; ?>
</body>
