<?php include __DIR__ . '/views/style/head.php'; ?>
<body class="min-h-screen flex flex-col" style="background-color:#000000;">
	<!-- Cabeçalho -->
	<header class="fixed top-0 left-0 w-full z-50 flex items-center justify-between px-4 py-3" style="background-color:#1A1A1A; border-bottom: 2px solid #FFD700;">
		<h1 class="text-2xl font-bold" style="color:#FFD700;">LegraBet</h1>
		<div class="flex gap-2">
			<a href="views/auth/login.php" class="px-4 py-2 rounded font-semibold" style="background-color:#FFD700;color:#000000;">Login</a>
			<a href="views/auth/register.php" class="px-4 py-2 rounded font-semibold" style="background-color:#FFD700;color:#000000;">Cadastrar</a>
		</div>
	</header>

	<!-- Espaço para o cabeçalho fixo -->
	<div class="h-16"></div>

	<!-- Hero Section -->
	<section class="flex-1 flex flex-col items-center justify-center text-center px-4 py-10">
		<h2 class="text-4xl md:text-5xl font-extrabold mb-4" style="color:#FFD700;">Aposte no seu esporte favorito!</h2>
		<p class="text-lg md:text-xl mb-6" style="color:#FFD700;">Ganhe prêmios instantâneos e aproveite as melhores odds do mercado.</p>
		<a href="views/auth/register.php" class="px-8 py-3 rounded-full font-bold text-lg" style="background-color:#FFD700;color:#000000;">Comece a Apostar</a>
	</section>

	<!-- Benefícios -->
	<section class="rounded-xl mx-4 mb-8 p-6 flex flex-col md:flex-row gap-6 items-center justify-center" style="background-color:#1A1A1A;">
		<div class="flex-1 text-center">
			<span class="inline-block text-3xl mb-2">⚡</span>
		<h3 class="font-bold mb-1" style="color:#FFD700;">Aposte em tempo real</h3>
		<p style="color:#FFD700;">Eventos ao vivo e atualizações instantâneas.</p>
		</div>
		<div class="flex-1 text-center">
			<span class="inline-block text-3xl mb-2">💸</span>
		<h3 class="font-bold mb-1" style="color:#FFD700;">Pagamentos instantâneos via Pix</h3>
		<p style="color:#FFD700;">Deposite e saque sem burocracia.</p>
		</div>
		<div class="flex-1 text-center">
			<span class="inline-block text-3xl mb-2">🕑</span>
		<h3 class="font-bold mb-1" style="color:#FFD700;">Suporte 24h</h3>
		<p style="color:#FFD700;">Equipe pronta para te ajudar a qualquer hora.</p>
		</div>
	</section>

	<!-- Eventos Esportivos em Destaque -->
	<section class="mx-4 mb-8">
		<h4 class="text-xl font-bold text-white mb-4">Eventos em Destaque</h4>
		<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
		<?php
		$eventosDestaque = [
			['esporte'=>'Futebol','descricao'=>'Flamengo vs Palmeiras','odds'=>[1.80,2.10,3.50],'hora'=>'Hoje, 21:00'],
			['esporte'=>'Basquete','descricao'=>'Lakers vs Celtics','odds'=>[1.95,2.30],'hora'=>'Hoje, 22:00'],
			['esporte'=>'Tênis','descricao'=>'Nadal vs Federer','odds'=>[1.60,2.80],'hora'=>'Hoje, 20:00'],
		];
		foreach($eventosDestaque as $evento): ?>
	<div class="rounded-2xl p-6 flex flex-col items-center gap-4 border hover:scale-[1.03] transition-transform duration-200" style="background-color:#1A1A1A;border-color:#FFD700;">
			<span class="font-bold text-lg mb-2" style="color:#FFD700;"><?php echo $evento['esporte']; ?></span>
			<span class="font-bold text-lg mb-2" style="color:#FFD700;"><?php echo $evento['descricao']; ?></span>
			<div class="flex gap-2">
				<?php foreach($evento['odds'] as $odd): ?>
					<span class="px-3 py-2 rounded-xl font-bold text-lg" style="background-color:#FFD700;color:#000000;">
						<?php echo $odd; ?>
					</span>
				<?php endforeach; ?>
			</div>
			<span class="text-xs font-semibold px-2 py-1 rounded" style="background-color:#FFD700;color:#000000;"><?php echo $evento['hora']; ?></span>
		</div>
		<?php endforeach; ?>
	</div>
</section>

<?php include __DIR__ . '/views/style/footer.php'; ?>
</body>
</html>