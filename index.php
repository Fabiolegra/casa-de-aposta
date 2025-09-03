<?php include __DIR__ . '/views/style/head.php'; ?>
<body class="bg-gradient-to-br from-blue-600 via-purple-600 to-pink-500 min-h-screen flex flex-col">
	<!-- Cabeçalho -->
	<header class="fixed top-0 left-0 w-full bg-white/90 shadow z-50 flex items-center justify-between px-4 py-3">
		<h1 class="text-2xl font-bold text-purple-700 tracking-wide">LegraBet</h1>
		<div class="flex gap-2">
			<a href="views/auth/login.php" class="btn-anim px-4 py-2 rounded bg-purple-600 text-white font-semibold hover:bg-purple-700">Login</a>
			<a href="views/auth/register.php" class="btn-anim px-4 py-2 rounded bg-pink-500 text-white font-semibold hover:bg-pink-600">Cadastrar</a>
		</div>
	</header>

	<!-- Espaço para o cabeçalho fixo -->
	<div class="h-16"></div>

	<!-- Hero Section -->
	<section class="flex-1 flex flex-col items-center justify-center text-center px-4 py-10">
		<h2 class="text-4xl md:text-5xl font-extrabold text-white mb-4 drop-shadow">Aposte no seu esporte favorito!</h2>
		<p class="text-lg md:text-xl text-white/90 mb-6">Ganhe prêmios instantâneos e aproveite as melhores odds do mercado.</p>
		<a href="views/auth/register.php" class="btn-anim px-8 py-3 rounded-full bg-yellow-400 text-purple-900 font-bold text-lg shadow-lg hover:bg-yellow-500">Comece a Apostar</a>
	</section>

	<!-- Benefícios -->
	<section class="bg-white/80 rounded-xl mx-4 mb-8 p-6 shadow-lg flex flex-col md:flex-row gap-6 items-center justify-center">
		<div class="flex-1 text-center">
			<span class="inline-block text-3xl mb-2">⚡</span>
			<h3 class="font-bold text-purple-700 mb-1">Aposte em tempo real</h3>
			<p class="text-gray-700">Eventos ao vivo e atualizações instantâneas.</p>
		</div>
		<div class="flex-1 text-center">
			<span class="inline-block text-3xl mb-2">💸</span>
			<h3 class="font-bold text-pink-600 mb-1">Pagamentos instantâneos via Pix</h3>
			<p class="text-gray-700">Deposite e saque sem burocracia.</p>
		</div>
		<div class="flex-1 text-center">
			<span class="inline-block text-3xl mb-2">🕑</span>
			<h3 class="font-bold text-blue-600 mb-1">Suporte 24h</h3>
			<p class="text-gray-700">Equipe pronta para te ajudar a qualquer hora.</p>
		</div>
	</section>

	<!-- Eventos Esportivos em Destaque -->
	<section class="mx-4 mb-8">
		<h4 class="text-xl font-bold text-white mb-4">Eventos em Destaque</h4>
		<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
			<!-- Card 1 -->
			<div class="bg-white rounded-lg shadow-lg p-4 flex flex-col items-center">
				<span class="text-lg font-semibold text-purple-700 mb-2">Futebol - Flamengo vs Palmeiras</span>
				<div class="flex gap-2 mb-2">
					<span class="px-3 py-1 rounded bg-purple-100 text-purple-700 font-bold">1.80</span>
					<span class="px-3 py-1 rounded bg-pink-100 text-pink-700 font-bold">2.10</span>
					<span class="px-3 py-1 rounded bg-blue-100 text-blue-700 font-bold">3.50</span>
				</div>
				<span class="text-xs text-gray-500">Hoje, 21:00</span>
			</div>
			<!-- Card 2 -->
			<div class="bg-white rounded-lg shadow-lg p-4 flex flex-col items-center">
				<span class="text-lg font-semibold text-pink-600 mb-2">Basquete - Lakers vs Celtics</span>
				<div class="flex gap-2 mb-2">
					<span class="px-3 py-1 rounded bg-purple-100 text-purple-700 font-bold">1.95</span>
					<span class="px-3 py-1 rounded bg-pink-100 text-pink-700 font-bold">2.30</span>
				</div>
				<span class="text-xs text-gray-500">Amanhã, 19:30</span>
			</div>
			<!-- Card 3 -->
			<div class="bg-white rounded-lg shadow-lg p-4 flex flex-col items-center">
				<span class="text-lg font-semibold text-blue-600 mb-2">Tênis - Nadal vs Federer</span>
				<div class="flex gap-2 mb-2">
					<span class="px-3 py-1 rounded bg-purple-100 text-purple-700 font-bold">1.60</span>
					<span class="px-3 py-1 rounded bg-pink-100 text-pink-700 font-bold">2.80</span>
				</div>
				<span class="text-xs text-gray-500">Sábado, 16:00</span>
			</div>
		</div>
	</section>

<?php include __DIR__ . '/views/style/footer.php'; ?>
</body>
</html>