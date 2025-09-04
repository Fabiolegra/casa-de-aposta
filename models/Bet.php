<?php
require_once __DIR__ . '/../config/database.php';
class Bet {
    private $pdo;
    public function __construct() {
        $this->pdo = Database::getInstance();
    }
    public function place($usuario_id, $evento_id, $valor, $odd) {
        $stmt = $this->pdo->prepare('INSERT INTO apostas (usuario_id, evento_id, valor, odd, status, data) VALUES (?, ?, ?, ?, "pendente", NOW())');
        $stmt->execute([$usuario_id, $evento_id, $valor, $odd]);
    }
    public function history($usuario_id) {
        $stmt = $this->pdo->prepare('SELECT a.*, e.descricao, e.esporte FROM apostas a JOIN eventos e ON a.evento_id = e.id WHERE a.usuario_id = ? ORDER BY a.data DESC');
        $stmt->execute([$usuario_id]);
        return $stmt->fetchAll();
    }
}
