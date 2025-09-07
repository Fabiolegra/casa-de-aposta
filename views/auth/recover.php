
<?php
require_once __DIR__ . '/../../config/database.php';
$msg = '';
$showReset = false;
$token = $_GET['token'] ?? '';
$email = $_GET['email'] ?? '';
$pdo = Database::getInstance();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Solicitação de recuperação
    if (isset($_POST['email']) && !$token) {
        $email = trim($_POST['email']);
        $stmt = $pdo->prepare('SELECT id FROM usuarios WHERE email = ?');
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $token = bin2hex(random_bytes(16));
            $stmt = $pdo->prepare('UPDATE usuarios SET reset_token = ?, reset_token_expira = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email = ?');
            $stmt->execute([$token, $email]);
            $msg = '<div class="text-green-600 mb-2">Link de recuperação gerado!<br>Simulação: <a href="recover.php?email=' . urlencode($email) . '&token=' . $token . '" class="underline">Clique aqui para redefinir</a></div>';
        } else {
            $msg = '<div class="text-red-600 mb-2">E-mail não encontrado.</div>';
        }
    }
    // Redefinição de senha
    if (isset($_POST['nova_senha']) && $token && $email) {
        $nova_senha = $_POST['nova_senha'];
        $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE email = ? AND reset_token = ? AND reset_token_expira > NOW()');
        $stmt->execute([$email, $token]);
        if ($stmt->fetch()) {
            $hash = password_hash($nova_senha, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare('UPDATE usuarios SET senha = ?, reset_token = NULL, reset_token_expira = NULL WHERE email = ?');
            $stmt->execute([$hash, $email]);
            $msg = '<div class="text-green-600 mb-2">Senha redefinida com sucesso! <a href="login.php" class="underline">Entrar</a></div>';
            $showReset = false;
        } else {
            $msg = '<div class="text-red-600 mb-2">Token inválido ou expirado.</div>';
        }
    }
}
// Exibe formulário de redefinição se token e email válidos
if ($token && $email) {
    $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE email = ? AND reset_token = ? AND reset_token_expira > NOW()');
    $stmt->execute([$email, $token]);
    if ($stmt->fetch()) {
        $showReset = true;
    }
}
?>

<?php include __DIR__ . '/../style/head.php'; ?>
<body class="min-h-screen flex items-center justify-center" style="background-color:#121212;">
  <div class="w-full max-w-md">
    <?php if($msg) echo $msg; ?>
    <?php if($showReset): ?>
      <form method="POST" action="recover.php?email=<?php echo urlencode($email); ?>&token=<?php echo urlencode($token); ?>" class="rounded-xl shadow-xl p-6" style="background-color:#1F1F1F;">
        <h2 class="text-2xl font-bold mb-4" style="color:#7C4DFF;">Redefinir Senha</h2>
        <input type="password" name="nova_senha" placeholder="Nova senha" required class="mb-3 w-full p-2 rounded" style="background-color:#1F1F1F;color:#E0E0E0;border:1px solid #7C4DFF;">
        <button type="submit" class="w-full font-bold py-2 rounded" style="background-color:#7C4DFF;color:#FFFFFF;box-shadow:0 0 8px #7C4DFF;">Redefinir</button>
      </form>
    <?php else: ?>
      <form method="POST" action="" class="rounded-xl shadow-xl p-6" style="background-color:#1F1F1F;">
        <h2 class="text-2xl font-bold mb-4" style="color:#7C4DFF;">Recuperar Senha</h2>
        <input type="email" name="email" placeholder="E-mail cadastrado" required class="mb-3 w-full p-2 rounded" style="background-color:#1F1F1F;color:#E0E0E0;border:1px solid #7C4DFF;" value="<?php echo htmlspecialchars($email); ?>">
        <button type="submit" class="w-full font-bold py-2 rounded" style="background-color:#7C4DFF;color:#FFFFFF;box-shadow:0 0 8px #7C4DFF;">Enviar link de recuperação</button>
        <p class="mt-3 text-sm text-center"><a href="login.php" style="color:#7C4DFF;" class="hover:underline">Voltar ao login</a></p>
      </form>
    <?php endif; ?>
  </div>
<?php include __DIR__ . '/../style/footer.php'; ?>
</body>
