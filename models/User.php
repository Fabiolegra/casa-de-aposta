<?php
require_once __DIR__ . '/../config/database.php';

class User {
	private $pdo;
	public function __construct() {
		$this->pdo = Database::getInstance();
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

	public function setResetToken($email, $token) {
		$stmt = $this->pdo->prepare('UPDATE usuarios SET reset_token = ?, reset_token_expira = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email = ?');
		$stmt->execute([$token, $email]);
	}

	public function verifyResetToken($email, $token) {
		$stmt = $this->pdo->prepare('SELECT * FROM usuarios WHERE email = ? AND reset_token = ? AND reset_token_expira > NOW()');
		$stmt->execute([$email, $token]);
		return $stmt->fetch();
	}

	public function updatePassword($email, $senha) {
		$hash = password_hash($senha, PASSWORD_DEFAULT);
		$stmt = $this->pdo->prepare('UPDATE usuarios SET senha = ?, reset_token = NULL, reset_token_expira = NULL WHERE email = ?');
		$stmt->execute([$hash, $email]);
	}

	private function calcularIdade($data_nascimento) {
		$nasc = new DateTime($data_nascimento);
		$hoje = new DateTime();
		$idade = $hoje->diff($nasc)->y;
		return $idade;
	}
}
