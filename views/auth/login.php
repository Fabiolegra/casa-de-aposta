
<?php
ob_start(); // Garante que não há saída antes do header
session_start();
require_once __DIR__ . '/../../config/database.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = trim($_POST['email'] ?? '');
  $senha = $_POST['senha'] ?? '';
  $pdo = Database::getInstance();
  $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE email = ?');
  $stmt->execute([$email]);
  $user = $stmt->fetch();
  if ($user && password_verify($senha, $user['senha'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_nome'] = $user['nome'];
  header('Location: ../../dashboard.php');
    exit;
  } else {
    $msg = '<div class="text-red-600 mb-2">E-mail ou senha inválidos.</div>';
  }
}
?>

<?php include __DIR__ . '/../style/head.php'; ?>
<body class="min-h-screen flex items-center justify-center" style="background-color:#121212;">
  <form method="POST" action="" class="rounded-xl shadow-xl w-full max-w-md p-6" style="background-color:#1F1F1F;">
    <h2 class="text-2xl font-bold mb-4" style="color:#7C4DFF;">Login</h2>
    <?php if($msg) echo $msg; ?>
    <input type="email" name="email" placeholder="E-mail" required class="mb-3 w-full p-2 rounded" style="background-color:#1F1F1F;color:#E0E0E0;border:1px solid #7C4DFF;" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
    <input type="password" name="senha" placeholder="Senha" required class="mb-3 w-full p-2 rounded" style="background-color:#1F1F1F;color:#E0E0E0;border:1px solid #7C4DFF;">
    <button type="submit" class="w-full font-bold py-2 rounded" style="background-color:#7C4DFF;color:#FFFFFF;box-shadow:0 0 8px #7C4DFF;">Entrar</button>
    <p class="mt-3 text-sm text-center"><a href="recover.php" style="color:#2979FF;" class="hover:underline">Esqueci minha senha</a></p>
    <p class="mt-3 text-sm text-center"><a href="register.php" style="color:#7C4DFF;" class="hover:underline">Não tenho uma conta</a></p>
  </form>
<?php include __DIR__ . '/../style/footer.php'; ?>
</body>
