<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>LegraBet - Sua Casa de Apostas</title>
	<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<style>
	.header-fixed {
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		z-index: 50;
		background: #1E1E1E;
		border-bottom: 2px solid #FFD700;
		
	}
	.header-btn {
		background: #FFD700;
		color: #1E1E1E;
		border-radius: 8px;
		padding: 8px 18px;
		font-weight: bold;
		
		transition: background 0.2s;
	}
	.header-btn:hover {
		background: #FFD700;
	}
</style>
</head>
<?php
$isDashboard = strpos($_SERVER['PHP_SELF'], 'dashboard.php') !== false;
if (!$isDashboard) {
	echo '<header class="header-fixed flex items-center justify-between px-4 py-3">
		<span class="text-xl font-bold" style="color:#FFD700;">LegraBet</span>
		<a href="../../dashboard.php" class="header-btn">Voltar</a>
	</header>
	<div style="height:56px;"></div>';
}
?>