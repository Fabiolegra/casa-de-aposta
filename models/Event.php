<?php
require_once __DIR__ . '/../config/database.php';
class Event {
    private $pdo;
    public function __construct() {
        $this->pdo = Database::getInstance();
    }
    public function listAll() {
        $stmt = $this->pdo->query('SELECT * FROM eventos ORDER BY data DESC');
        return $stmt->fetchAll();
    }
}
