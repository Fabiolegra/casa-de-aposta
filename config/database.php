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
			self::$instance = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass, $options);
		}
		return self::$instance;
	}
}
