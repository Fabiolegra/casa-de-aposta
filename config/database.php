<?php
class Database {
	private static $instance = null;
	public static function getInstance() {
		if (!self::$instance) {
			$host = 'localhost';
			$dbname = 'legra_bet';
			$user = 'root';
			$pass = '';
			$options = [
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
			];
			try {
				self::$instance = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass, $options);
			} catch (PDOException $e) {
				die('Erro ao conectar ao banco de dados MySQL. Verifique se o XAMPP está rodando, se o banco "legra_bet" existe e se o usuário/senha estão corretos.<br>Detalhe: ' . $e->getMessage());
			}
		}
		return self::$instance;
	}
}
