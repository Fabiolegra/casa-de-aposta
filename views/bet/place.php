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
    $odds_map = [
        1 => ['home'=>1.45,'draw'=>3.80,'away'=>6.50,'resultado'=>'home'],
        2 => ['home'=>1.70,'draw'=>3.60,'away'=>5.00,'resultado'=>'home'],
        3 => ['home'=>2.10,'draw'=>3.20,'away'=>3.10,'resultado'=>'draw'],
        4 => ['home'=>1.95,'draw'=>3.40,'away'=>4.20,'resultado'=>'home'],
        5 => ['home'=>2.30,'draw'=>3.10,'away'=>2.90,'resultado'=>'away'],
    ];
    $userModel = new User();
    $saldo = $userModel->getSaldo($_SESSION['user_id']);
    $betModel = new Bet();
    $transModel = new Transaction();

    // Múltiplas apostas combinadas
    if (isset($_POST['selecionados']) && is_array($_POST['selecionados']) && isset($_POST['valor_combinada'])) {
        $selecionados = $_POST['selecionados'];
        $apostas = $_POST['aposta'] ?? [];
        $valor = floatval($_POST['valor_combinada']);
        $odds = [];
        $acertouTudo = true;
        foreach ($selecionados as $evento_id) {
            $evento_id = intval($evento_id);
            $tipo_aposta = $apostas[$evento_id] ?? '';
            if (!isset($odds_map[$evento_id][$tipo_aposta])) {
                $msg = '<div class="text-red-600 mb-2">Dados inválidos para aposta.</div>';
                break;
            }
            $odds[] = $odds_map[$evento_id][$tipo_aposta];
            // Verifica se acertou cada aposta
            if ($tipo_aposta !== $odds_map[$evento_id]['resultado']) {
                $acertouTudo = false;
            }
        }
        if (count($odds) !== count($selecionados) || $valor <= 0) {
            $msg = '<div class="text-red-600 mb-2">Dados inválidos para aposta.</div>';
        } elseif ($valor > $saldo) {
            $msg = '<div class="text-red-600 mb-2">Saldo insuficiente para apostar.</div>';
        } else {
            // Odd combinada = produto das odds
            $odd_combinada = array_product($odds);
            // Registra cada aposta individualmente
            foreach ($selecionados as $evento_id) {
                $tipo_aposta = $apostas[$evento_id] ?? '';
                $odd = $odds_map[$evento_id][$tipo_aposta];
                $betModel->place($_SESSION['user_id'], $evento_id, $valor/count($selecionados), $odd);
                $aposta_id = $betModel->pdo->lastInsertId();
                $betModel->updateStatus($aposta_id, $tipo_aposta === $odds_map[$evento_id]['resultado'] ? 'ganha' : 'perdida');
            }
            $transModel->withdraw($_SESSION['user_id'], $valor, 'aposta');
            if ($acertouTudo) {
                $premio = $valor * $odd_combinada;
                $transModel->ganho($_SESSION['user_id'], $premio);
                $msg = '<div class="text-green-600 mb-2">Parabéns! Você acertou todas e ganhou R$ '.number_format($premio,2,',','.').'. Redirecionando...</div>';
            } else {
                $transModel->perca($_SESSION['user_id'], $valor);
                $msg = '<div class="text-red-600 mb-2">Você errou uma ou mais apostas. Tente novamente! Redirecionando...</div>';
            }
            echo $msg;
            echo '<script>setTimeout(function(){ window.location.href = "../../dashboard.php"; }, 2000);</script>';
            exit;
        }
    } else {
        // Aposta simples (original)
        $evento_id = intval($_POST['evento_id'] ?? 0);
        $valor = floatval($_POST['valor'] ?? 0);
        $aposta = $_POST['aposta'] ?? '';
        $resultado = $_POST['resultado'] ?? '';
        $odd = 0;
        if (isset($odds_map[$evento_id][$aposta])) {
            $odd = $odds_map[$evento_id][$aposta];
        }
        if ($evento_id <= 0 || $valor <= 0 || $odd <= 0 || !in_array($aposta,['home','draw','away'])) {
            $msg = '<div class="text-red-600 mb-2">Dados inválidos para aposta.</div>';
        } elseif ($valor > $saldo) {
            $msg = '<div class="text-red-600 mb-2">Saldo insuficiente para apostar.</div>';
        } else {
            $betModel->place($_SESSION['user_id'], $evento_id, $valor, $odd);
            $aposta_id = $betModel->pdo->lastInsertId();
            $transModel->withdraw($_SESSION['user_id'], $valor, 'aposta');
            if ($aposta === $resultado) {
                $premio = $valor * $odd;
                $transModel->ganho($_SESSION['user_id'], $premio);
                $betModel->updateStatus($aposta_id, 'ganha');
                $msg = '<div class="text-green-600 mb-2">Parabéns! Você acertou e ganhou R$ '.number_format($premio,2,',','.').'. Redirecionando...</div>';
            } else {
                $betModel->updateStatus($aposta_id, 'perdida');
                $transModel->perca($_SESSION['user_id'], $valor);
                $msg = '<div class="text-red-600 mb-2">Você errou o resultado. Tente novamente! Redirecionando...</div>';
            }
            echo $msg;
            echo '<script>setTimeout(function(){ window.location.href = "../../dashboard.php"; }, 2000);</script>';
            exit;
        }
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
