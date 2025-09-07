<?php
include __DIR__ . '/../style/head.php';
session_start();
require_once __DIR__ . '/../../models/User.php';
$msg = '';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}
$userModel = new User();
$user = $userModel->getById($_SESSION['user_id']);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nome = trim($_POST['nome'] ?? $user['nome']);
  $data_nascimento = $_POST['data_nascimento'] ?? $user['data_nascimento'];
  $senha = $_POST['senha'] ?? '';
  $userModel->update($_SESSION['user_id'], $nome, $senha, $data_nascimento);
  $msg = '<div class="text-green-600 mb-2">Dados atualizados com sucesso! Redirecionando...</div>';
  echo $msg;
  echo '<script>setTimeout(function(){ window.location.href = "../../dashboard.php"; }, 1500);</script>';
  exit;
}
?>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
  <div class="container mx-auto py-8">
    <h2 class="text-2xl font-bold mb-4 text-purple-700">Editar Perfil</h2>
    <?php if($msg) echo $msg; ?>
    <form method="POST" action="" class="bg-white p-6 rounded shadow-md max-w-lg">
      <label class="block mb-2">Nome</label>
      <input type="text" name="nome" value="<?php echo htmlspecialchars($user['nome']); ?>" class="mb-3 w-full p-2 border rounded">
      <label class="block mb-2">Data de Nascimento</label>
      <input type="date" name="data_nascimento" value="<?php echo htmlspecialchars($user['data_nascimento']); ?>" class="mb-3 w-full p-2 border rounded">
      <label class="block mb-2">Nova Senha</label>
      <input type="password" name="senha" placeholder="Nova senha (opcional)" class="mb-3 w-full p-2 border rounded">
      <button type="submit" class="bg-purple-600 text-white py-2 px-4 rounded hover:bg-purple-700">Salvar Alterações</button>
    </form>
    <a href="profile.php" class="text-purple-600 underline mt-4 inline-block">Voltar ao perfil</a>
  </div>
<?php include __DIR__ . '/../style/footer.php'; ?>
</body>
