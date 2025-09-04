<?php
require_once __DIR__ . '/../config/database.php';
class Transaction {
    private $pdo;
    public function __construct() {
        $this->pdo = Database::getInstance();
    }
    public function deposit($usuario_id, $valor) {
        $stmt = $this->pdo->prepare('INSERT INTO transacoes (usuario_id, tipo, valor, data) VALUES (?, "deposito", ?, NOW())');
        $stmt->execute([$usuario_id, $valor]);
        $this->updateSaldo($usuario_id, $valor);
    }
    public function withdraw($usuario_id, $valor) {
        $stmt = $this->pdo->prepare('INSERT INTO transacoes (usuario_id, tipo, valor, data) VALUES (?, "saque", ?, NOW())');
        $stmt->execute([$usuario_id, $valor]);
        $this->updateSaldo($usuario_id, -$valor);
    }
    public function history($usuario_id) {
        $stmt = $this->pdo->prepare('SELECT * FROM transacoes WHERE usuario_id = ? ORDER BY data DESC');
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll();
    }
    private function updateSaldo($usuario_id, $valor) {
        $stmt = $this->pdo->prepare('UPDATE usuarios SET saldo = saldo + ? WHERE id = ?');
        $stmt->execute([$valor, $usuario_id]);
    }
}
