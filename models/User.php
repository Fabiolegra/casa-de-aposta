
<?php
require_once __DIR__ . '/../config/database.php';

class User {
	private $pdo;
	public function __construct() {
		$this->pdo = Database::getInstance();
	}

	public function getById($id) {
		$stmt = $this->pdo->prepare('SELECT * FROM usuarios WHERE id = ?');
		$stmt->execute([$id]);
		return $stmt->fetch();
	}

	public function update($id, $nome, $senha, $data_nascimento) {
		$params = [$nome, $data_nascimento, $id];
		$sql = 'UPDATE usuarios SET nome = ?, data_nascimento = ?';
		if ($senha) {
			$sql .= ', senha = ?';
			$params = [$nome, $data_nascimento, password_hash($senha, PASSWORD_DEFAULT), $id];
		}
		$sql .= ' WHERE id = ?';
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute($params);
	}

	public function getSaldo($id) {
		$stmt = $this->pdo->prepare('SELECT saldo FROM usuarios WHERE id = ?');
		$stmt->execute([$id]);
		$row = $stmt->fetch();
		return $row ? $row['saldo'] : 0.00;
	}

	public function create($nome, $email, $senha, $data_nascimento) {
		// Verifica idade
		$idade = $this->calcularIdade($data_nascimento);
		if ($idade < 18) {
			return ['success' => false, 'message' => 'É necessário ter pelo menos 18 anos.'];
		}
		// Verifica se email já existe
		$stmt = $this->pdo->prepare('SELECT id FROM usuarios WHERE email = ?');
		$stmt->execute([$email]);
		if ($stmt->fetch()) {
			return ['success' => false, 'message' => 'E-mail já cadastrado.'];
		}
		$hash = password_hash($senha, PASSWORD_DEFAULT);
		$stmt = $this->pdo->prepare('INSERT INTO usuarios (nome, email, senha, data_nascimento, data_cadastro) VALUES (?, ?, ?, ?, NOW())');
		$stmt->execute([$nome, $email, $hash, $data_nascimento]);
		return ['success' => true];
	}

	public function authenticate($email, $senha) {
		$stmt = $this->pdo->prepare('SELECT * FROM usuarios WHERE email = ?');
		$stmt->execute([$email]);
		$user = $stmt->fetch();
		if ($user && password_verify($senha, $user['senha'])) {
			return $user;
		}
		return false;
	}

	public function findByEmail($email) {
		$stmt = $this->pdo->prepare('SELECT * FROM usuarios WHERE email = ?');
		$stmt->execute([$email]);
		return $stmt->fetch();
	}
	// Calcula idade a partir da data de nascimento (Y-m-d)
	public function calcularIdade($data_nascimento) {
		$hoje = new DateTime();
		$nasc = DateTime::createFromFormat('Y-m-d', $data_nascimento);
		if (!$nasc) return 0;
		$idade = $hoje->diff($nasc)->y;
		return $idade;
	}
}