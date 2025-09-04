
<?php
require_once __DIR__ . '/../../config/database.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nome = trim($_POST['nome'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $data_nascimento = $_POST['data_nascimento'] ?? '';
  $senha = $_POST['senha'] ?? '';
  $pdo = Database::getInstance();
  // Validação de idade
  $hoje = new DateTime();
  $nasc = DateTime::createFromFormat('Y-m-d', $data_nascimento);
  $idade = $nasc ? $hoje->diff($nasc)->y : 0;
  if ($idade < 18) {
    $msg = '<div class="text-red-600 mb-2">Você precisa ter pelo menos 18 anos.</div>';
  } else {
    // Verifica se e-mail já existe
    $stmt = $pdo->prepare('SELECT id FROM usuarios WHERE email = ?');
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
      $msg = '<div class="text-red-600 mb-2">E-mail já cadastrado.</div>';
    } else {
      // Hash seguro
      $hash = password_hash($senha, PASSWORD_DEFAULT);
      $stmt = $pdo->prepare('INSERT INTO usuarios (nome, email, senha, data_nascimento, data_cadastro) VALUES (?, ?, ?, ?, NOW())');
      try {
        $stmt->execute([$nome, $email, $hash, $data_nascimento]);
        $msg = '<div class="text-green-600 mb-2">Cadastro realizado com sucesso! <a href="login.php" class="underline">Entrar</a></div>';
      } catch (Exception $e) {
        $msg = '<div class="text-red-600 mb-2">Erro ao cadastrar: ' . htmlspecialchars($e->getMessage()) . '</div>';
      }
    }
  }
}
?>
<?php include __DIR__ . '/../style/head.php'; ?>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
  <form method="POST" action="" class="bg-white p-6 rounded shadow-md w-full max-w-md">
  <h2 class="text-2xl font-bold mb-4 text-purple-700">Cadastro</h2>
  <?php if($msg) echo $msg; ?>
  <input type="text" name="nome" placeholder="Nome completo" required class="mb-3 w-full p-2 border rounded" value="<?php echo htmlspecialchars($_POST['nome'] ?? ''); ?>">
  <input type="email" name="email" placeholder="E-mail" required class="mb-3 w-full p-2 border rounded" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
  <input type="date" name="data_nascimento" required class="mb-3 w-full p-2 border rounded" value="<?php echo htmlspecialchars($_POST['data_nascimento'] ?? ''); ?>">
  <input type="password" name="senha" placeholder="Senha" required class="mb-3 w-full p-2 border rounded">
  <button type="submit" class="w-full bg-purple-600 text-white py-2 rounded hover:bg-purple-700 transition">Cadastrar</button>
  <p class="mt-3 text-sm text-center">Já tem conta? <a href="login.php" class="text-purple-600 hover:underline">Entrar</a></p>
  </form>
<?php include __DIR__ . '/../style/footer.php'; ?>
</body>
