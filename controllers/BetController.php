<?php
session_start();
require_once __DIR__ . '/../models/Bet.php';
require_once __DIR__ . '/../models/Event.php';
class BetController {
    public function index() {
        if (!isset($_SESSION['user_id'])) { header('Location: /views/auth/login.php'); exit; }
        $eventModel = new Event();
        $events = $eventModel->listAll();
        include __DIR__ . '/../views/bet/index.php';
    }
    public function place() {
        // ... lógica de aposta ...
    }
}
