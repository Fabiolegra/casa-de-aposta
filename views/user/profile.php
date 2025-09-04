<?php include __DIR__ . '/../style/head.php'; ?>
<body class="bg-gray-100 min-h-screen">
<div class="container mx-auto py-8">
  <h2 class="text-2xl font-bold mb-4 text-purple-700">Perfil do Usuário</h2>
  <form method="POST" action="edit.php" class="bg-white p-6 rounded shadow-md mb-6 max-w-lg">
    <label class="block mb-2">Nome</label>
    <input type="text" name="nome" value="<?php echo htmlspecialchars($user['nome']); ?>" class="mb-3 w-full p-2 border rounded">
    <label class="block mb-2">Data de Nascimento</label>
    <input type="date" name="data_nascimento" value="<?php echo htmlspecialchars($user['data_nascimento']); ?>" class="mb-3 w-full p-2 border rounded">
    <label class="block mb-2">Nova Senha</label>
    <input type="password" name="senha" placeholder="Nova senha (opcional)" class="mb-3 w-full p-2 border rounded">
    <button type="submit" class="bg-purple-600 text-white py-2 px-4 rounded hover:bg-purple-700">Salvar Alterações</button>
  </form>
  <div class="mb-6">
    <h3 class="text-lg font-bold text-blue-700 mb-2">Saldo disponível</h3>
    <div class="text-2xl font-bold text-green-600">R$ <?php echo number_format($saldo,2,',','.'); ?></div>
  </div>
  <div class="mb-6">
    <h3 class="text-lg font-bold text-pink-700 mb-2">Histórico de Depósitos/Saques</h3>
    <table class="w-full bg-white rounded shadow mb-4">
      <thead><tr><th>Tipo</th><th>Valor</th><th>Data</th></tr></thead>
      <tbody>
        <?php foreach($transacoes as $t): ?>
        <tr><td><?php echo $t['tipo']; ?></td><td>R$ <?php echo number_format($t['valor'],2,',','.'); ?></td><td><?php echo $t['data']; ?></td></tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
  <div>
    <h3 class="text-lg font-bold text-purple-700 mb-2">Histórico de Apostas</h3>
    <table class="w-full bg-white rounded shadow">
      <thead><tr><th>Evento</th><th>Valor</th><th>Odd</th><th>Status</th><th>Data</th></tr></thead>
      <tbody>
        <?php foreach($apostas as $a): ?>
        <tr><td><?php echo $a['descricao']; ?></td><td>R$ <?php echo number_format($a['valor'],2,',','.'); ?></td><td><?php echo $a['odd']; ?></td><td><?php echo $a['status']; ?></td><td><?php echo $a['data']; ?></td></tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php include __DIR__ . '/../style/footer.php'; ?>
</body>
