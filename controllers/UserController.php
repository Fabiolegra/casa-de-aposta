<?php
session_start();
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Transaction.php';
require_once __DIR__ . '/../models/Bet.php';
class UserController {
	public function profile() {
		if (!isset($_SESSION['user_id'])) { header('Location: /views/auth/login.php'); exit; }
		$userModel = new User();
		$user = $userModel->getById($_SESSION['user_id']);
		$saldo = $userModel->getSaldo($_SESSION['user_id']);
		$transModel = new Transaction();
		$transacoes = $transModel->history($_SESSION['user_id']);
		$betModel = new Bet();
		$apostas = $betModel->history($_SESSION['user_id']);
		include __DIR__ . '/../views/user/profile.php';
	}
	public function edit() {
		// ... lógica de edição ...
	}
}
