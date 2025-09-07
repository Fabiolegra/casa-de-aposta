<?php
include __DIR__ . '/../style/head.php';
session_start();
require_once __DIR__ . '/../../models/Bet.php';
require_once __DIR__ . '/../../models/User.php';
require_once __DIR__ . '/../../models/Transaction.php';
$msg = '';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $evento_id = intval($_POST['evento_id'] ?? 0);
    $valor = floatval($_POST['valor'] ?? 0);
    $odd = floatval($_POST['odd'] ?? 0);
    $userModel = new User();
    $saldo = $userModel->getSaldo($_SESSION['user_id']);
    if ($evento_id <= 0 || $valor <= 0 || $odd <= 0) {
        $msg = '<div class="text-red-600 mb-2">Dados inválidos para aposta.</div>';
    } elseif ($valor > $saldo) {
        $msg = '<div class="text-red-600 mb-2">Saldo insuficiente para apostar.</div>';
    } else {
        $betModel = new Bet();
        $betModel->place($_SESSION['user_id'], $evento_id, $valor, $odd);
        // Desconta saldo e registra transação
        $transModel = new Transaction();
        $transModel->withdraw($_SESSION['user_id'], $valor);
        $msg = '<div class="text-green-600 mb-2">Aposta realizada com sucesso! Redirecionando...</div>';
        echo $msg;
        echo '<script>setTimeout(function(){ window.location.href = "../../dashboard.php"; }, 1500);</script>';
        exit;
    }
}
?>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <div class="container mx-auto py-8">
    <h2 class="text-2xl font-bold mb-4 text-purple-700">Apostar</h2>
    <?php if($msg) echo $msg; ?>
    <a href="index.php" class="text-purple-600 underline">Voltar</a>
  </div>
<?php include __DIR__ . '/../style/footer.php'; ?>
</body>
