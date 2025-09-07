<?php
if (!isset($user) || !isset($saldo) || !isset($transacoes) || !isset($apostas)) {
  session_start();
  require_once __DIR__ . '/../../models/User.php';
  require_once __DIR__ . '/../../models/Transaction.php';
  require_once __DIR__ . '/../../models/Bet.php';
  $userModel = new User();
  $user = $userModel->getById($_SESSION['user_id']);
  $saldo = $userModel->getSaldo($_SESSION['user_id']);
  $transModel = new Transaction();
  $transacoes = $transModel->history($_SESSION['user_id']);
  $betModel = new Bet();
  $apostas = $betModel->history($_SESSION['user_id']);
}
?>
<?php include __DIR__ . '/../style/head.php'; ?>
<body class="min-h-screen" style="background-color:#121212;">
<div class="max-w-3xl mx-auto py-8 px-2">
  <h2 class="text-3xl font-bold mb-6" style="color:#7C4DFF;">Perfil do Usuário</h2>
  <form method="POST" action="edit.php" class="rounded-xl shadow-xl mb-6 p-6" style="background-color:#1F1F1F;">
    <label class="block mb-2" style="color:#E0E0E0;">Nome</label>
    <input type="text" name="nome" value="<?php echo htmlspecialchars($user['nome']); ?>" class="mb-3 w-full p-2 rounded" style="background-color:#1F1F1F;color:#E0E0E0;border:1px solid #7C4DFF;">
    <label class="block mb-2" style="color:#E0E0E0;">Data de Nascimento</label>
    <input type="date" name="data_nascimento" value="<?php echo htmlspecialchars($user['data_nascimento']); ?>" class="mb-3 w-full p-2 rounded" style="background-color:#1F1F1F;color:#E0E0E0;border:1px solid #7C4DFF;">
    <label class="block mb-2" style="color:#E0E0E0;">Nova Senha</label>
    <input type="password" name="senha" placeholder="Nova senha (opcional)" class="mb-3 w-full p-2 rounded" style="background-color:#1F1F1F;color:#E0E0E0;border:1px solid #7C4DFF;">
    <button type="submit" class="font-bold py-2 px-4 rounded" style="background-color:#7C4DFF;color:#FFFFFF;box-shadow:0 0 8px #7C4DFF;">Salvar Alterações</button>
  </form>
  <div class="mb-6">
    <h3 class="text-lg font-bold mb-2" style="color:#00E676;">Saldo disponível</h3>
    <div class="text-2xl font-bold" style="color:#00E676;filter:drop-shadow(0 0 8px #00E676);">R$ <?php echo number_format($saldo,2,',','.'); ?></div>
  </div>
  <div class="mb-6">
    <h3 class="text-lg font-bold mb-2" style="color:#2979FF;">Histórico de Depósitos/Saques</h3>
    <table class="w-full rounded-xl shadow-xl mb-4" style="background-color:#1F1F1F;">
      <thead>
        <tr style="color:#7C4DFF;background-color:#1E1E1E;">
          <th>Tipo</th><th>Valor</th><th>Data</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($transacoes as $t): ?>
        <tr style="color:#E0E0E0;">
          <td><?php echo $t['tipo']; ?></td>
          <td>R$ <?php echo number_format($t['valor'],2,',','.'); ?></td>
          <td><?php echo $t['data']; ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <div>
    <h3 class="text-lg font-bold mb-2" style="color:#FF1744;">Histórico de Apostas</h3>
    <table class="w-full rounded-xl shadow-xl" style="background-color:#1F1F1F;">
      <thead>
        <tr style="color:#7C4DFF;background-color:#1E1E1E;">
          <th>Evento</th><th>Valor</th><th>Odd</th><th>Status</th><th>Data</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($apostas as $a): ?>
        <tr style="color:#E0E0E0;">
          <td><?php echo $a['descricao']; ?></td>
          <td>R$ <?php echo number_format($a['valor'],2,',','.'); ?></td>
          <td><?php echo $a['odd']; ?></td>
          <td><?php echo $a['status']; ?></td>
          <td><?php echo $a['data']; ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php include __DIR__ . '/../style/footer.php'; ?>
</body>
