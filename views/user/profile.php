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
<body class="min-h-screen" style="background-color:#000000;">
<div class="max-w-3xl mx-auto py-10 px-4">
  <h2 class="text-4xl font-extrabold mb-8 text-center" style="color:#FFD700;letter-spacing:1px;">Perfil do Usuário</h2>
  <form method="POST" action="edit.php" class="rounded-2xl mb-8 p-8 flex flex-col gap-6 border" style="background-color:#1A1A1A;border-color:#FFD700;">
    <div class="flex flex-col md:flex-row gap-6">
      <div class="flex-1">
  <label class="block mb-2 font-bold text-lg" style="color:#FFD700;">Nome</label>
  <input type="text" name="nome" value="<?php echo htmlspecialchars($user['nome']); ?>" class="mb-3 w-full p-3 rounded-xl text-lg" style="background-color:#FFEB3B;color:#000000;border:2px solid #FFD700;">
      </div>
      <div class="flex-1">
  <label class="block mb-2 font-bold text-lg" style="color:#FFD700;">Data de Nascimento</label>
  <input type="date" name="data_nascimento" value="<?php echo htmlspecialchars($user['data_nascimento']); ?>" class="mb-3 w-full p-3 rounded-xl text-lg" style="background-color:#FFEB3B;color:#000000;border:2px solid #FFD700;">
      </div>
    </div>
    <div>
  <label class="block mb-2 font-bold text-lg" style="color:#FFD700;">Nova Senha</label>
  <input type="password" name="senha" placeholder="Nova senha (opcional)" class="mb-3 w-full p-3 rounded-xl text-lg" style="background-color:#FFEB3B;color:#000000;border:2px solid #FFD700;">
    </div>
  <button type="submit" class="font-bold py-3 px-6 rounded-xl text-lg" style="background-color:#FFD700;color:#000000;">Salvar Alterações</button>
  </form>
  <div class="mb-8 rounded-2xl p-6 border flex flex-col items-center" style="background-color:#1A1A1A;border-color:#FFD700;">
  <h3 class="text-xl font-bold mb-2" style="color:#FFD700;">Saldo disponível</h3>
  <div class="text-4xl font-extrabold mb-2" style="color:#FFD700;">R$ <?php echo number_format($saldo,2,',','.'); ?></div>
  </div>
  <div class="mb-8">
  <h3 class="text-xl font-bold mb-4" style="color:#FFD700;">Histórico de Depósitos/Saques</h3>
  <table class="w-full rounded-2xl mb-4 text-center" style="background-color:#1A1A1A;">
      <thead>
  <tr style="color:#FFD700;background-color:#1A1A1A;">
          <th class="py-2">Tipo</th><th class="py-2">Valor</th><th class="py-2">Data</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($transacoes as $t): ?>
  <tr style="color:#FFD700;">
          <td class="py-2"><?php echo $t['tipo']; ?></td>
          <td class="py-2">R$ <?php echo number_format($t['valor'],2,',','.'); ?></td>
          <td class="py-2"><?php echo $t['data']; ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <div class="mb-8">
  <h3 class="text-xl font-bold mb-4" style="color:#FFD700;">Histórico de Apostas</h3>
  <table class="w-full rounded-2xl text-center" style="background-color:#1A1A1A;">
      <thead>
  <tr style="color:#FFD700;background-color:#1A1A1A;">
          <th class="py-2">Evento</th><th class="py-2">Valor</th><th class="py-2">Odd</th><th class="py-2">Status</th><th class="py-2">Data</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($apostas as $a): ?>
  <tr style="color:#FFD700;">
          <td class="py-2"><?php echo $a['descricao']; ?></td>
          <td class="py-2">R$ <?php echo number_format($a['valor'],2,',','.'); ?></td>
          <td class="py-2"><?php echo $a['odd']; ?></td>
          <td class="py-2"><?php echo $a['status']; ?></td>
          <td class="py-2"><?php echo $a['data']; ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php include __DIR__ . '/../style/footer.php'; ?>
</body>
