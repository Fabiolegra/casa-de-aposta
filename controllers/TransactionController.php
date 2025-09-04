<?php
session_start();
require_once __DIR__ . '/../models/Transaction.php';
class TransactionController {
    public function deposit() {
        if (!isset($_SESSION['user_id'])) { header('Location: /views/auth/login.php'); exit; }
        // ... lógica de depósito ...
    }
    public function withdraw() {
        if (!isset($_SESSION['user_id'])) { header('Location: /views/auth/login.php'); exit; }
        // ... lógica de saque ...
    }
}
