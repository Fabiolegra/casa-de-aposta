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
    $msg = '<div style="color:#FFD700;" class="mb-2">Valor inválido.</div>';
  } else {
    $transModel = new Transaction();
    $transModel->deposit($_SESSION['user_id'], $valor);
  echo '<div style="color:#FFD700;" class="mb-2">Depósito realizado com sucesso! Redirecionando...</div>';
    echo '<script>setTimeout(function(){ window.location.href = "../../dashboard.php"; }, 1500);</script>';
    exit;
  }
}
?>
<?php include __DIR__ . '/../style/head.php'; ?>
<body class="min-h-screen flex flex-col" style="background-color:#000000;">
  <main class="flex-1 flex items-center justify-center">
    <div class="w-full max-w-md mx-auto py-8 px-4">
      <h2 class="text-2xl font-bold mb-4 text-center" style="color:#E0E0E0;">Depósito</h2>
      <?php if($msg) echo $msg; ?>
  <form method="POST" action="" class="rounded-xl p-6 flex flex-col gap-4" style="background-color:#1A1A1A;">
  <input type="number" name="valor" min="1" step="0.01" placeholder="Valor do depósito" required class="w-full p-2 rounded-xl border text-lg" style="background-color:#FFD700;color:#000000;border:2px solid #FFD700;">
  <button type="submit" class="w-full font-bold py-2 rounded-xl text-lg hover:bg-[#FFD700]" style="background-color:#FFD700;color:#000000;">Depositar</button>
      </form>
    </div>
  </main>
  <footer class="w-full mt-auto">
    <?php include __DIR__ . '/../style/footer.php'; ?>
  </footer>
</body>
